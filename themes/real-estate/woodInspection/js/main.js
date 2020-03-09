var allConnectedB = [];
function thisConnectB(thisItem){
	if(thisItem.checked){
		allConnectedB.push(thisItem.value);
		if(thisItem.value == 'Other (C)')
		$('.include-specify').show();
	} else {
		allConnectedB.remove(thisItem.value);
		if(thisItem.value == 'Other (C)')
		$('.include-specify').hide();
	}
	var commaSepConnected = allConnectedB.join(', ');
	var wood_destroying_yes = $('#wood_destroying_yes').val();
	if ($('input#wood_destroying_yes').is(':checked')) {
		$('#specifyReason').html(commaSepConnected);
	}	
}
function thisConnect6B(thisItem){
	if(thisItem.checked){
		$('.inaccessible-specify').show();
	} else {
		$('.inaccessible-specify').hide();
	}
}
Array.prototype.remove = function(x) { 
	var i;
	for(i in this){
		if(this[i].toString() == x.toString()){
			this.splice(i,1)
		}
	}
}
var cssUrl = "/wp-content/themes/real-estate/woodInspection/css/main-template.css";
function printTemplateBtn(){
	//e.preventDefault();
	//$('.ng-not-empty').parent('.commentprompt').parent().removeClass('not_required_true');
	//$('.ng-empty').parent('.commentprompt').parent().addClass('not_required_true');
	var thisItem = $(".printTemplateBtn");
	thisItem.find('.fa').removeClass('fa-print').addClass('fa-refresh fa-spin');
	$("#templateViewer").print({
			//Use Global styles
			globalStyles : false,
			//Add link with attrbute media=print
			mediaPrint : false,
			//Custom stylesheet
			stylesheet : cssUrl,
			//Print in a hidden iframe
			iframe : false,
			//Don't print this
			noPrintSelector : ".avoid-this",
			//Add this at top
			prepend : null,
			//Add this on bottom
			append : null,
			manuallyCopyFormValues: true,
			title: "Wood Inspection Template",
			timeout: 750,
			//Log to console when printing is done via a deffered callback
			deferred: $.Deferred().done(function() { //console.log('Printing done', arguments); 
			})
		});
	setTimeout(function(){
		thisItem.find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-print');
	},1000);
}
$(document).ready(function () {
	$('.hovereffect').on("click", function (e) {
		$('.documentHides').toggle();
	});
	setTimeout(function(){
		//printTemplateBtn();
	},5000);
	
	
	$( '.mediaUploderClb' ).on( 'click', function( e ) {
		var $el = $( this );
		var file_frame;
		e.preventDefault();

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		wp.media.controller.Library.prototype.defaults.contentUserSetting=false;
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Add to Gallery',
			button: {
				text: 'Select'
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
				$('#woodImgItem').attr('src',ress);
				$('#woodImgItemInput').val(ress);
			}
		});

		// Finally, open the modal.
		file_frame.open();

	});
	
	$(document).on('click', '.annotate_upload_button_tem',function(e){
		e.preventDefault();
		var dataurl = $(this).attr("dataurl");
		window.open(dataurl, '_blank', 'location=yes,height=1000,width=1000,scrollbars=yes,status=yes');
	});
	$(document).on('click', '.survey_upload_button_tem',function(e){		
		e.preventDefault();
		var dataurl = $(this).attr("dataurl");
		window.open(dataurl, '_blank', 'location=yes,height=1000,width=1000,scrollbars=yes,status=yes');
	});
	
	tinymce.init({
		selector: '.tinymceWoodIns',
		inline: false,
		plugins : 'advlist autolink link image lists charmap print preview code',
		skin: 'lightgray',
		theme : 'modern',
		toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fontsizeselect,addMedia annotateImage surveyDrawing',
		setup: function (editor) {
		editor.on("change", function(e){
            $('#previewContent,#footer_html_area').html(tinymce.activeEditor.getContent());
        }),
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
	}); 
	
	
});
function previewContent(editorObject){
     var content = editorObject.getContent();
     document.getElementById("previewContent").innerHTML = content;
}

var woodInspectionSave = function woodInspectionSave(thisItem=''){
	$('.saveChanges').find('.fa').removeClass('fa-floppy-o');
	$('.saveChanges').find('.fa').addClass('fa-refresh fa-spin');
	var arraylen=$(':checkbox:checked').length;
	var datasets = {};
	$(':checkbox:checked, :text, #footer_html_area, textarea').each(function(i){
		var fieldName = this.name;
        datasets[fieldName] = [];
	});
	$(':checkbox:checked, :text, #footer_html_area, textarea').each(function(i){
		var fieldName = this.name;
		var fieldVal = this.value;
        datasets[fieldName].push(fieldVal);
	});
	//console.log(datasets);
	//return false;
	//var other_wood_destroying_text = $('textarea#other_wood_destroying_text').val();
	//datasets['other_wood_destroying_text'] = other_wood_destroying_text;
	//var previous_treatment_text = $('textarea#previous_treatment_text').val();
	//datasets['previous_treatment_text'] = previous_treatment_text;
	var formJsonData = JSON.stringify(datasets);
	var form_data = new FormData();
    form_data.append('action', 'saveDynamicFormReport');
    form_data.append('template_id', template_id);
	form_data.append('inspection_id', inspection_id);
	form_data.append('saved', saved);
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
			$('.msg_show').show().html('<font style="color:green">'+parsedJson.mess+'</span>');
        } else {
			$('.msg_show').show().html('<font style="color:red">'+parsedJson.mess+'</span>');
        }
		$('.saveChanges').find('.fa').removeClass('fa-refresh fa-spin');
		$('.saveChanges').find('.fa').addClass('fa-floppy-o');
      },
      error: function (errorThrown) {
		//$('.msg_show').show().html('<font style="color:red">'+errorThrown+'</span>');
      }
    });
	//console.log(datasets);
	setTimeout(woodInspectionSave, 10000);
}
//woodInspectionSave();

window.setTimeout(function(){
	$('#incipitContent').css({'display':'none','opacity':'0'});
}, 3000);