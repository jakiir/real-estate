angular.module('formbuilder',['ngDrag'])
  .controller('mainCtrl',function($scope){
    $scope.tools = formControls;
    $scope.currentControl=null;
    $scope.internalDrag=false;
    $scope.externalDrag=false;
    $scope.data={
      name:"Untitled Form 1",
      logo:null,
      tree:[]
    }
    //Auto Save feature
	var setAccessSession = '';
    function autoSave(){
      localStorage.setItem('formbuilder_cache_data',JSON.stringify($scope.data));
	  setAccessSession = setTimeout(autoSave, 10000);
      console.log("Auto Save Performed");
    }
	setAccessSession = setTimeout(autoSave, 10000);
	
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
    
	if(field_text_html){
      $scope.data = JSON.parse(field_text_html);
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
