angular.module('formbuilder',['ngDrag'])
  .controller('mainCtrl',function($scope){
    $scope.tools = formControls;
    $scope.currentControl=null;
    $scope.data={
      name:"Untitled Form 1",
      logo:null,
      tree:[]
    }
    //Auto Save feature
    function autoSave(){
      localStorage.setItem('formbuilder_cache_data',JSON.stringify($scope.data));
      console.log("Auto Save Performed");
    }
    function dragCleanup(){
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
      e.dataTransfer.setData('control',ct);
    }
    $scope.unShiftToChild=function(e,index){
      var dt = e.dataTransfer.getData('control');
      var sData = freshen(dt);
      if(sData.single) return dragCleanup();
      $scope.data.tree[index].unshift([]);
      $scope.data.tree[index][0].push(sData);
      $scope.currentControl=$scope.data.tree[index][0][$scope.data.tree[index][0].length-1];
      dragCleanup();
    }
    $scope.pushToChild=function(e,index){
      var dt = e.dataTransfer.getData('control');
      var sData = freshen(dt);
      if(sData.single) return dragCleanup();
      $scope.data.tree[index].push([]);
      $scope.data.tree[index][$scope.data.tree[index].length-1].push(sData);
      $scope.currentControl=$scope.data.tree[index][$scope.data.tree[index].length-1][$scope.data.tree[index][$scope.data.tree[index].length-1].length-1];
      dragCleanup();
    }
    $scope.addBottom=function(e,parent,index){
      var dt = e.dataTransfer.getData('control');
      var sData = freshen(dt);
      if(sData.single) return dragCleanup();
      $scope.data.tree[parent][index].push(sData);
      $scope.currentControl = $scope.data.tree[parent][index][$scope.data.tree[parent][index].length-1];
      dragCleanup();
    }
    $scope.addNewRow=function(e){
      var dt = e.dataTransfer.getData('control');
      var sData = freshen(dt);
      $scope.data.tree.push([]);
      $scope.data.tree[$scope.data.tree.length-1].push([]);
      $scope.data.tree[$scope.data.tree.length-1][0].push(sData);
      $scope.currentControl=$scope.data.tree[$scope.data.tree.length-1][0][$scope.data.tree[$scope.data.tree.length-1][0].length-1];
      dragCleanup();
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
    }
    if(localStorage.getItem('formbuilder_cache_data')){
      $scope.data = JSON.parse(localStorage.getItem('formbuilder_cache_data'));
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
