angular.module('submitForm',['ui.tinymce'])
.controller('submissonForm',function($scope,$sce){
  $scope.formBlueprint=formBlueprint;
  $scope.formInfo = formInfo[0];
  $scope.formInfo.header_html=$sce.trustAsHtml($scope.formInfo.header_html);
  // -- disabled for development
  // //check if the file is called from preview (will have cache data)
  if(localStorage.getItem('formbuilder_cache_data')){
    $scope.formBlueprint = JSON.parse(localStorage.getItem('formbuilder_cache_data'));
  }
  $scope.submitData = function(){
    console.log("Data Submisson");	
    var fd = new FormData(document.forms.mainform);
	fd.append('action', 'save_form_data');
	fd.append('template_id', template_id);
	$.ajax({          
      url: ajax_url,
      type: 'post',
      contentType: false,
      processData: false,
      data: fd,          
      success: function (data) {
        var parsedJson = $.parseJSON(data);
        console.log(parsedJson);
        if(parsedJson.success == true){
          alert(parsedJson.mess);
          //window.location.href = "<?php echo home_url('/form-builder/?item='); ?>"+template_id;
        } else {
        alert(parsedJson.mess);
        }
      },
      error: function (errorThrown) {
        alert(errorThrown);
      }
    });	
    //ToDo: Run AJAX submit for fd
  }
});
