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
	console.log(fd);
    //ToDo: Run AJAX submit for fd
  }
});
