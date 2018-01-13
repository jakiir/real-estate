angular.module('submitForm',['ui.tinymce'])
.config(function($sceProvider){
  $sceProvider.enabled(false);
})
.controller('submissonForm',function($scope,$sce){
  $scope.tinymceOptions = {
    inline: false,
    plugins : 'advlist autolink link image lists charmap print preview code',
    skin: 'lightgray',
    theme : 'modern'
  };

  $scope.formBlueprint=formBlueprint;
  $scope.form = transform(formBlueprint);
  $scope.formInfo = formInfo[0];
  $scope.formInfo.header_html=$sce.trustAsHtml($scope.formInfo.header_html);
  function transform(formBlueprint){
	if(!formBlueprint) return [];
    var tree = formBlueprint.tree;
    //console.log(tree);
    var form = [];
	var sectionEle = 0;
    for(i=0;i<tree.length;i++){
      //console.log(i);
      if(tree[i][0][0].type=='section'){
		var sectionEle = 1;
        form.push({
          section:tree[i][0][0],
          children:[],
          expanded:false,
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
		  }
        form[form.length-1].children.push(tree[i]);
      }
    }
    return form;
  }
  // -- disabled for development
  // //check if the file is called from preview (will have cache data)
  if(localStorage.getItem('formbuilder_cache_data') && !$scope.form.length){
    $scope.formBlueprint = JSON.parse(localStorage.getItem('formbuilder_cache_data'));
    $scope.form = transform($scope.formBlueprint);
    //console.log($scope.form);
  }
  var temp_dt = new Date();
  $scope.formBlueprint.prepared_date = temp_dt.toString();
  $scope.submitData = function(){
    console.log("Data Submisson");
    //var fd = new FormData(document.forms.mainform);
	var data = $scope.formBlueprint;
	fd.append('action', 'save_form_data');
	fd.append('template_id', template_id);
	fd.append('this_form_name', this_form_name);	
	$.ajax({          
      url: ajax_url,
      type: 'post',
      contentType: false,
      processData: false,
      data: data,          
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
  $scope.fileBrowse = function(control){
    var fi = document.querySelector('.fileinp');
    console.log(fi.files);
    readFile(fi.files[0],function(res){
      if(res){
        control.url=res;
        $scope.$apply();
      }
    })
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
