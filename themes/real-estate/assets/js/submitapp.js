angular.module('submitForm',['ui.tinymce'])
.config(function($sceProvider){
  $sceProvider.enabled(false);
})
.controller('submissonForm',function($scope,$sce){
  $scope.tinymceOptions = {
    inline: false,
    plugins : 'advlist autolink link image lists charmap print preview',
    skin: 'lightgray',
    theme : 'modern'
  };

  $scope.formBlueprint=formBlueprint;
  $scope.form = transform(formBlueprint);
  $scope.formInfo = formInfo[0];
  $scope.formInfo.header_html=$sce.trustAsHtml($scope.formInfo.header_html);
  function transform(formBlueprint){
    var tree = formBlueprint.tree;
    console.log(tree);
    var form = [];
    for(i=0;i<tree.length;i++){
      //console.log(i);
      if(tree[i][0][0].type=='section'){
        form.push({
          section:tree[i][0][0],
          children:[],
          expanded:false
        });
        continue;
      }
      else{
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
  $scope.submitData = function(){
    console.log("Data Submisson");
    var fd = new FormData(document.forms.mainform);
	fd.append('action', 'save_form_data');
	fd.append('template_id', template_id);
	fd.append('this_form_name', this_form_name);	
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
});
