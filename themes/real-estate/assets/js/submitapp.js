angular.module('submitForm',['ui.tinymce'])
.config(function($sceProvider){
  $sceProvider.enabled(false);
})
.controller('submissonForm',function($scope,$sce){
  $scope.tinymceOptions = {
    inline: false,
    plugins : 'advlist autolink link image lists charmap print preview code',
    skin: 'lightgray',
    theme : 'modern',
	toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fontsizeselect,addMedia annotateImage surveyDrawing',
	setup: function (editor) {
    editor.addButton('addMedia', {
      text: 'Add Image',
      icon: 'image',
      onclick: function () {
		  wp.media.controller.Library.prototype.defaults.contentUserSetting=false;
			var custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Select Image',
				button: {
					text: 'Add Image'
				},
				multiple: false
			});
			custom_uploader.on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				
				editor.insertContent( '<img width="32%" height="auto" src="' + attachment.url + '" data-mce-src="' + attachment.url + '" style="width:32%;" alt="upload image" />');
			});
			custom_uploader.open();
		}
	}),
	editor.addButton('annotateImage', {
      text: 'Annotate Image',
      icon: 'image',
      onclick: function (e) {
      	//console.log("Annotate button clicked")
		  var thisItemId = e.target.parentNode.parentNode.id;
		  var selectedImage = $('#'+thisItemId).parents('.mce-container-body').find(".mce-edit-area").find("iframe").contents().find('.mce-content-body').find("[data-mce-selected='1']").attr('src');
		  
		  var defaultImageUrl = site_url + '/wp-content/uploads/2018/05/download.png';
		  if( typeof selectedImage !== 'undefined'){
				defaultImageUrl = selectedImage;
			}
		  window.open(site_url+'/canvas-drawing/?report=14&item=2&hash=1518713455636&saved=1&editor=yes#target='+defaultImageUrl, '_blank', 'location=yes,height=1000,width=1000,scrollbars=yes,status=yes');
		  window.insertAnnotateImage = function(imageUrl){
			  editor.insertContent( '<img class="add_annotate_image" width="32%" height="auto" src="' + imageUrl + '" data-mce-src="' + imageUrl + '" style="width:32%;" alt="upload image" />');
		  }
		}
	}),
	editor.addButton('surveyDrawing', {
      text: 'Survey Drawing',
      icon: 'image',
      onclick: function () {
      	//console.log("SUEVEY button clicked")
			window.open(site_url+'/design-draw/?report=14&item=2&hash=1518713455636&saved=1&editor=yes', '_blank', 'location=yes,height=1000,width=1000,scrollbars=yes,status=yes');
		
			window.insertSurveyDrawing = function(imageUrl){
			  editor.insertContent( '<img class="add_annotate_image" width="32%" height="auto" src="' + imageUrl + '" data-mce-src="' + imageUrl + '" style="width:32%;" alt="upload image" />');
			}
		}
	})
	}
  };
 //$scope.tinymceOptions = {}
  $scope.formBlueprint=formBlueprint;
  //console.log($scope.formBlueprint);
  $scope.form = transform(formBlueprint);
  //console.log($scope.form);
  $scope.formInfo = formInfo[0];
  $scope.formInfo.header_html=$sce.trustAsHtml($scope.formInfo.header_html);
  function transform(formBlueprint){
	if(!formBlueprint) return [];
    var tree = formBlueprint.tree;
    //console.log(tree);
    var form = [];
	var sectionEle = 0;
    for(i=0;i<tree.length;i++){
      //console.log(tree[i][0][0]);
	  if(tree[i][0][0].type=='section'){
		var sectionEle = 1;
		form.push({
          section:tree[i][0][0],
          children:[],
          expanded:false, //false
		  display:''
        });
        continue;
      }
      if(tree[i][0][0].type=='subsection'){
		var sectionEle = 1;
		form[form.length-1].children.push({
          subsection:tree[i][0],
          children:[],
          expanded:false, //false
		  display:''
        });
        continue;
      }
      else{		  
		  if(sectionEle == 0){
			form.push({
			  section:[],
			  children:[],
			  expanded:true,
			  display:'display-none'
			});	
			form[form.length-1].children.push(tree[i]);
		  } else {
			form[form.length-1].children[form[form.length-1].children.length-1].children.push(tree[i]);
		  }
      }
    }
    return form;
  }
  
  var setAccessSession = '';
    function autoSave(){
      localStorage.setItem('formbuilder_cache_data'+template_id,JSON.stringify($scope.formBlueprint));
	  setAccessSession = setTimeout(autoSave, 5000);
	  //console.log(localStorage.formbuilder_cache_data);
      //console.log("Auto Save Performed");
    }
	setAccessSession = setTimeout(autoSave, 5000);
  autoSave();
  // -- disabled for development
  // //check if the file is called from preview (will have cache data)
  if(localStorage.getItem('formbuilder_cache_data'+template_id) && !$scope.form.length){
    $scope.formBlueprint = JSON.parse(localStorage.getItem('formbuilder_cache_data'+template_id));
    $scope.form = transform($scope.formBlueprint);
    console.log($scope.form);
  }
  var temp_dt = new Date();
  $scope.formBlueprint.prepared_date = temp_dt.toString();
  var setSubmitData = '';
  savedIdForItem = saved;
  $scope.submitData = function(thisItem=3,goToUrl='',targetUrl=''){
	  
	  var pathArray = window.location.pathname.split( '/' );
		var segment_1 = pathArray[1];
		if(segment_1 !='form-viewer'){
			return false;
		}
	  
	  setSubmitData = setTimeout($scope.submitData, 15000);
    var saveToDb=false;
    //var fd = new FormData(document.forms.mainform);
	//var data = $scope.formBlueprint;
	//fd.append('action', 'save_form_data');
	//fd.append('template_id', template_id);
	//fd.append('this_form_name', this_form_name);
	$('.saveChanges').find('.fa').removeClass('fa-floppy-o');
	$('.saveChanges').find('.fa').addClass('fa-refresh fa-spin');
	var form_data = new FormData();
	var formCacheData = localStorage.getItem('formbuilder_cache_data'+template_id);
    var formJsonData = formCacheData;
    form_data.append('action', 'saveDynamicFormReport');
    form_data.append('template_id', template_id);
	form_data.append('inspection_id', inspection_id);
	if(thisItem==3){
		form_data.append('saved', savedIdForItem);
	} else {
		form_data.append('saved', saved);
	}
	
    form_data.append('formJsonData', formJsonData);
	$.ajax({
	  dataType : "json",
      url: ajax_url,
      type: 'post',
      contentType: false,
      processData: false,
      data: form_data,          
      success: function (data) {		
        var parsedJson = data;
		saveToDb = parsedJson.success;        
        if(parsedJson.success == true){
			$('.msg_show').show().html('<font class="font_icon success_icon">'+parsedJson.mess+'</span>');
			if(thisItem==1){
				window.location.href = site_url+"/form-viewer/?item="+template_id+'&report='+inspection_id+'&saved='+parsedJson.report_detail_id;
			}
			if(thisItem==2){
				window.location.href = goToUrl+'&saved='+parsedJson.report_detail_id+targetUrl;
			}
			if(thisItem==3){
				var newUrlAddress = site_url+"/form-viewer/?item="+template_id+'&report='+inspection_id+'&saved='+parsedJson.report_detail_id;
				window.history.pushState("object or string", "Title", newUrlAddress);
				savedIdForItem = parsedJson.report_detail_id;
			}
        } else {
        $('.msg_show').show().html('<font style="color:red">'+parsedJson.mess+'</span>');
        }
		$('.saveChanges').find('.fa').removeClass('fa-refresh fa-spin');
		$('.saveChanges').find('.fa').addClass('fa-floppy-o');
      },
      error: function (errorThrown) {
		$('.msg_show').show().html('<font style="color:red">'+errorThrown+'</span>');
      }
    });	
	return saveToDb;
    //ToDo: Run AJAX submit for fd
  }
  setSubmitData = setTimeout($scope.submitData, 15000);
  $scope.submitData(3,'','');
  $scope.fileBrowse = function(control){
    var fi = document.querySelector('.fileinp-new');
    console.log(fi.files);
    readFile(fi.files[0],function(res){
      if(res){
        control.url=res;
        $scope.$apply();
      }
    })
  }
  $scope.uplodFile = function(control,hash_id,att_url){
	  //var updatedUrl = document.querySelector('.updatedUrl');
	  //console.log(att_url);
	  var ress = att_url;
      if(ress && control.hash==hash_id){
        control.url=ress;
        //$scope.$apply();
      }
  }
  
  $scope.commentListIsClb = function(control,thisItem){
		if(control){
		  returnType = false;
		} else {
			returnType = true;
		}
		setTimeout(function() { 
			var atLeastOneIsChecked = $(thisItem.target).parents('.sub_section_agent').find('input.repair-print-false').length;
			if(atLeastOneIsChecked > 0){
				$(thisItem.target).parents('.sub_section_agent').addClass('repair-print-active');
			} else {
				$(thisItem.target).parents('.sub_section_agent').removeClass('repair-print-active');
			}
		}, 1000);
		
			  
	}
  
  $scope.mediaUploderClb = function(control){
	  
	var file_frame; // variable for the wp.media file_frame
	event.preventDefault();
	// if the file_frame has already been created, just reuse it
	if ( file_frame ) {
		file_frame.open();
		return;
	}
wp.media.controller.Library.prototype.defaults.contentUserSetting=false;
	file_frame = wp.media.frames.file_frame = wp.media({
		title: $( this ).data( 'uploader_title' ),
		button: {
			text: $( this ).data( 'uploader_button_text' ),
		},
		multiple: false // set this to true for multiple file selection
	});

	file_frame.on( 'select', function() {
		attachment = file_frame.state().get('selection').first().toJSON();
		// do something with the file here
		//$( '.frontend-button' ).hide();
		//$( '.imggap' ).attr('src', attachment.url);
		var ress = attachment.url;
		if(ress){
			control.url=ress;
			$scope.$apply();
		}
	});
	file_frame.open();
  }
  
  function flatten(tree){
    var data = [];
    for(i0=0;i0<tree.length;i0++){
      for(i1=0;i1<tree[i0].children.length;i1++){
        for(i2=0;i2<tree[i0].children[i1].length;i2++){
          for(i3=0;i3<tree[i0].children[i1][i2].length;i3++){
            data.push(tree[i0].children[i1][i2][i3]);
          }
        }
      }
    }
    return data;
  }
  
  $scope.goToDrawing = function(thisItem){
		var saveToDb = $scope.submitData(2,thisItem.target.attributes.dataurl.value,thisItem.target.attributes.targetUrl.value);
		if(thisItem.target.attributes.dataurl.value && saveToDb==true){
			window.location = thisItem.target.attributes.dataurl.value;
		}
	}
  
  $scope.imageFileMess = true;
  $scope.showImageFileMess = function (event) {
	  $scope.imageFileMess = false;
  }
  $scope.commentListIsVisible = true;
  $scope.editbuttonIsVisible = true;
  $scope.commentListShowHide = function (event) {
	  if(event.target.checked){
		  $scope.commentListIsVisible = false;
		  $scope.editbuttonIsVisible = false;
		  $scope.commentEditIsVisible = false;
	  } else {
		  $scope.commentListIsVisible = true;
		  $scope.editbuttonIsVisible = true;
		  $scope.commentEditIsVisible = false;
	  }
  }
  
  $scope.commentEditIsVisible = false;
  $scope.commentEditShowHide = function () {
	  $scope.commentEditIsVisible = $scope.commentEditIsVisible ? false : true;
	  $scope.editbuttonIsVisible = $scope.editbuttonIsVisible ? false : true;
	  $scope.commentListIsVisible = $scope.commentListIsVisible ? false : true;
  }
  
  $scope.conditionalEval = function(){
    console.log("Conditional Evaluation");
    var els = flatten($scope.form);
    var reasons = {};
    els.forEach(function(e){
      if(e.type=="reason"){
        reasons[e.htmlName]=e;
        reasons[e.htmlName].reason="";
      }
    });
    els.forEach(function(e){
      if(e.type=="conditional" && e.checked){
        //console.log(e);
        reasons[e.target].reason += e.message;
      }
    });
  }
}).directive('cOnChange', function() {
  'use strict';

  return {
      restrict: "A",
      scope : {
          cOnChange: '&'
      },
      link: function (scope, element) {
          element.on('change', function () {
            scope.cOnChange();
      });
      }
  };
});
jQuery(document).ready(function($){
    $(document).on('click', '.mce-media_upload_button_tem', template_builder_image_tinymce);

    function template_builder_image_tinymce(e) {
        e.preventDefault();
        var $input_field = $('.mce-media_input_image');
		wp.media.controller.Library.prototype.defaults.contentUserSetting=false;
        var custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Add Image',
            button: {
                text: 'Add Image'
            },
            multiple: false
        });
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $input_field.val(attachment.url);
        });
        custom_uploader.open();
    }
	
	$(document).on('click', '.mce-annotate_upload_button_tem',function(e){
		e.preventDefault();
		window.open(site_url+'/canvas-drawing/?report=14&item=2&hash=1518713455636&saved=1&editor=yes#target='+site_url+'/wp-content/uploads/2018/05/download.png', '_blank', 'location=yes,height=1000,width=1000,scrollbars=yes,status=yes');
	});
	$(document).on('click', '.mce-survey_upload_button_tem',function(e){
		e.preventDefault();
		window.open(site_url+'/design-draw/?report=14&item=2&hash=1518713455636&saved=1&editor=yes', '_blank', 'location=yes,height=1000,width=1000,scrollbars=yes,status=yes');
	});
	
	
});