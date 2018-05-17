angular.module('formbuilder',['ngDrag','ui.tinymce'])
  .config(function($sceProvider){
    $sceProvider.enabled(false);
  })
  .controller('mainCtrl',function($scope,$sce){
    $scope.tools = formControls;
    $scope.currentControl=null;
    $scope.internalDrag=false;
    $scope.externalDrag=false;
	$scope.reasonList=[];
    $scope.tinymceOptions = {
    inline: false,
    plugins : 'advlist autolink link image lists charmap print preview code',
    skin: 'lightgray',
    theme : 'modern',
	toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fontsizeselect,addMedia annotateImage surveyDrawing',
	setup: function (editor) {
    editor.addButton('addMedia', {
      text: 'Add Media',
      icon: 'image',
      onclick: function () {
		editor.windowManager.open( {
			title: 'Insert Media',
			body: [
				{
					type: 'textbox',
					name: 'img_url',
					label: 'Image',
					value: '',
					classes: 'media_input_image',
				},
				{
					type: 'textbox',
					name: 'image_width',
					label: 'Width',
					value: '100px',
					classes: 'media_image_width',
				},
				{
					type: 'textbox',
					name: 'image_height',
					label: 'Height',
					value: '100px',
					classes: 'media_image_height',
				},
				{
					type: 'button',
					name: 'media_upload_button_tem',
					label: '',
					text: 'Upload image',
					classes: 'media_upload_button_tem',
				},
			],
			onsubmit: function( e ) {
				if(e.data.img_url == ''){
					$('.mce-media_input_image').after('<div class="requird_msg">Requird field</div>');
					$('.requird_msg').delay(1000).fadeOut();
					return false;
				}
				if(e.data.image_width == ''){
					$('.mce-media_image_width').after('<div class="requird_msg">Requird field</div>');
					$('.requird_msg').delay(1000).fadeOut();
					return false;
				}
				if(e.data.image_height == ''){
					$('.mce-media_image_height').after('<div class="requird_msg">Requird field</div>');
					$('.requird_msg').delay(1000).fadeOut();
					return false;
				}
				editor.insertContent( '<img width="' + e.data.image_width + '" height="' + e.data.image_height + '" src="' + e.data.img_url + '" data-mce-src="' + e.data.img_url + '" style="width:' + e.data.image_width + '" alt="upload image" />');
			}
		});
		}
	}),
	editor.addButton('annotateImage', {
      text: 'Annotate Image',
      icon: 'image',
      onclick: function () {
		editor.windowManager.open( {
			title: 'Insert Annotate Media',
			body: [
				{
					type: 'textbox',
					name: 'img_url',
					label: 'Image',
					value: '',
					classes: 'media_input_image',
				},
				{
					type: 'textbox',
					name: 'image_width',
					label: 'Width',
					value: '100px',
					classes: 'media_image_width',
				},
				{
					type: 'textbox',
					name: 'image_height',
					label: 'Height',
					value: '100px',
					classes: 'media_image_height',
				},
				{
					type: 'button',
					name: 'annotate_upload_button_tem',
					label: '',
					text: 'Upload image',
					classes: 'annotate_upload_button_tem',
				},
			],
			onsubmit: function( e ) {
				editor.insertContent( '<img width="' + e.data.image_width + '" height="' + e.data.image_height + '" src="' + e.data.img_url + '" data-mce-src="' + e.data.img_url + '" style="width:' + e.data.image_width + '" alt="upload image" />');
			}
		});
		}
	}),
	editor.addButton('surveyDrawing', {
      text: 'Survey Drawing',
      icon: 'image',
      onclick: function () {
		editor.windowManager.open( {
			title: 'Insert Survey Media',
			body: [
				{
					type: 'textbox',
					name: 'img_url',
					label: 'Image',
					value: '',
					classes: 'media_input_image',
				},
				{
					type: 'textbox',
					name: 'image_width',
					label: 'Width',
					value: '100px',
					classes: 'media_image_width',
				},
				{
					type: 'textbox',
					name: 'image_height',
					label: 'Height',
					value: '100px',
					classes: 'media_image_height',
				},
				{
					type: 'button',
					name: 'survey_upload_button_tem',
					label: '',
					text: 'Upload image',
					classes: 'survey_upload_button_tem',
				},
			],
			onsubmit: function( e ) {
				editor.insertContent( '<img width="' + e.data.image_width + '" height="' + e.data.image_height + '" src="' + e.data.img_url + '" data-mce-src="' + e.data.img_url + '" style="width:' + e.data.image_width + '" alt="upload image" />');
			}
		});
		}
	})
	}
  };
    $scope.data={
      name:"Untitled Form 1",
      report_title:"",
      company_address:"",
      prepared_by:"",
      prepared_for:"",
      prepared_date:"",
      logo:null,
      tree:[]
    }
    //Auto Save feature
	var setAccessSession = '';
    function autoSave(){
      localStorage.setItem('formbuilder_cache_data',JSON.stringify($scope.data));
	  setAccessSession = setTimeout(autoSave, 2000);
	  //console.log(localStorage.formbuilder_cache_data);
      //console.log("Auto Save Performed");
    }
	setAccessSession = setTimeout(autoSave, 2000);
    $scope.dragCleanup=function(){
      $scope.externalDrag=false;
      $('.droparea').removeClass('hassomething');
      autoSave();
    }
    function freshen(dt){
      var output = JSON.parse(dt);
      delete output.icon;
      if(output.htmlName){
        output.htmlName=output.htmlName+Math.round(Math.random()*(Date.now()/1000));
      }
      output.hash=Date.now();
      return output;
    }
    //Drop events
    $scope.startDrag = function(e,control){
      var ct = JSON.stringify(control);
      $scope.externalDrag=true;
      e.dataTransfer.setData('control',ct);
    }
    function flatten(tree){
      var data = [];
      for(i1=0;i1<tree.length;i1++){
        for(i2=0;i2<tree[i1].length;i2++){
          for(i3=0;i3<tree[i1][i2].length;i3++){
            data.push(tree[i1][i2][i3]);
          }
        }
      }
      return data;
    }
    $scope.conditionalEval = function(){
      var els = flatten($scope.data.tree);
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

    $scope.unShiftToChild=function(e,index){
      var dt = e.dataTransfer.getData('control');
      var sData = freshen(dt);
      if(sData.single) return false;
      $scope.data.tree[index].unshift([]);
      $scope.data.tree[index][0].push(sData);
      $scope.currentControl=$scope.data.tree[index][0][$scope.data.tree[index][0].length-1];
    }
    $scope.pushToChild=function(e,index){
      var dt = e.dataTransfer.getData('control');
      var sData = freshen(dt);
      if(sData.single) return false;
      $scope.data.tree[index].push([]);
      $scope.data.tree[index][$scope.data.tree[index].length-1].push(sData);
      $scope.currentControl=$scope.data.tree[index][$scope.data.tree[index].length-1][$scope.data.tree[index][$scope.data.tree[index].length-1].length-1];
    }
    $scope.addBottom=function(e,parent,index){
      var dt = e.dataTransfer.getData('control');
      var sData = freshen(dt);
      if(sData.single) return false;
      $scope.data.tree[parent][index].push(sData);
      $scope.currentControl = $scope.data.tree[parent][index][$scope.data.tree[parent][index].length-1];
    }
    $scope.addNewRow=function(e){
      var dt = e.dataTransfer.getData('control');
      var sData = freshen(dt);
      $scope.data.tree.push([]);
      $scope.data.tree[$scope.data.tree.length-1].push([]);
      $scope.data.tree[$scope.data.tree.length-1][0].push(sData);
      $scope.currentControl=$scope.data.tree[$scope.data.tree.length-1][0][$scope.data.tree[$scope.data.tree.length-1][0].length-1];
    }
    $scope.imageDrop = function(e,sindex,parent,index){
      e.preventDefault();
      var f = e.dataTransfer.files[0];
      readFile(f,function(fl){
        //console.log(fl);
        if(fl){
          $scope.data.tree[sindex][parent][index].url=fl;
          $scope.$apply();
        }
      })
    }
    $scope.fileBrowse = function(){
      var fi = document.querySelector('.fileinp');
      console.log(fi.files);
      readFile(fi.files[0],function(res){
        if(res){
          $scope.currentControl.url=res;
          $scope.$apply();
        }
      })
    }

	$scope.fileUploader = function(control){

	var file_frame; // variable for the wp.media file_frame
	//event.preventDefault();
	// if the file_frame has already been created, just reuse it
	if ( file_frame ) {
		file_frame.open();
		return;
	}

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
		if(control == 'editor'){
			if(ress){
				return ress;
			}
		} else {
			if(ress){
				control.url=ress;
				$scope.$apply();
			}
		}
	});
	file_frame.open();
  }

    //Remove item
    $scope.removeControl = function(superidx,parent,index,e){
      e.stopPropagation();
      if($scope.currentControl && $scope.currentControl.hash==$scope.data.tree[superidx][parent][index].hash){
        $scope.currentControl=null;
      }
      $scope.data.tree[superidx][parent].splice(index,1);
      if(!$scope.data.tree[superidx][parent].length){
        $scope.data.tree[superidx].splice(parent,1);
      }
      if(!$scope.data.tree[superidx].length){
        $scope.data.tree.splice(superidx,1);
      }
      autoSave();
    }
    $scope.deselectControl=function(){
      $scope.currentControl=null;
      autoSave();
    }
    //Select and manipulate
    $scope.selectControl = function(superidx,parent,index){
      autoSave();
      $scope.currentControl=$scope.data.tree[superidx][parent][index];
      if($scope.currentControl.type=='conditional'){
        $scope.reasonList = flatten($scope.data.tree)
        .filter(function(el){
          return el.type=='reason';
        })
        .map(function(el){
          return {
            title:el.title,
            htmlName:el.htmlName
          }
        })
      }
    }

	if(field_text_html){
      $scope.data = JSON.parse(JSON.stringify(field_text_html));
    } else if(localStorage.getItem('formbuilder_cache_data')){
      $scope.data = JSON.parse(localStorage.getItem('formbuilder_cache_data'));
    } else {
		$scope.data = '';
	}

    //Internal Rearrangement
    $scope.internalDragStart = function(e,path){
      e.dataTransfer.setData('path',path.join(","));
      console.log("Drag Started");
      $scope.internalDrag=true;
    }
    $scope.internalDragEnd = function(){
      $scope.internalDrag=false;
      console.log("Drag Ended");
      $scope.dragCleanup();
    }
    $scope.rearrange = function(e,master,par,idx){
      $scope.internalDrag=false;
      var path = e.dataTransfer.getData('path');
      path = path.split(",");
      if($scope.data.tree[path[0]][path[1]][path[2]].single) return false;
      var source = JSON.stringify($scope.data.tree[path[0]][path[1]][path[2]]);
      $scope.data.tree[path[0]][path[1]].splice(path[2],1);
      $scope.data.tree[master][par].splice(idx,0,JSON.parse(source));
      if(!$scope.data.tree[path[0]][path[1]].length){
        $scope.data.tree[path[0]].splice([path[1]],1);
      }
      if(!$scope.data.tree[path[0]].length){
        $scope.data.tree.splice(path[0],1);
      }
    }
	$scope.changeCompanyLogo = function(){
      var fi = document.querySelector('.fiimg');
      console.log(fi.files);
      if(!fi.files.length) return false;
      readFile(fi.files[0],function(res){
        if(res){
          $scope.data.logo = res;
          $scope.$apply();
          autoSave();
        }
      })
    }
  })
  .directive('cOnChange', function() {
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
		window.open(site_url+'/canvas-drawing/?report=14&item=2&hash=1518713455636&saved=1&editor=yes#target=http://localhost/mehedi/real-estate/wp-content/uploads/2018/04/1524674598.png', '_blank', 'location=yes,height=1000,width=1000,scrollbars=yes,status=yes');
	});
	$(document).on('click', '.mce-survey_upload_button_tem',function(e){
		e.preventDefault();
		window.open(site_url+'/design-draw/?report=14&item=2&hash=1518713455636&saved=1&editor=yes', '_blank', 'location=yes,height=1000,width=1000,scrollbars=yes,status=yes');
	});
});
