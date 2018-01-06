angular.module('drawing',[])
.controller('toolsController',function($scope){
  $scope.tools=tools;
  $scope.currentTool=currentTool;
  canvasResolve();
  $scope.grid="10";
  $scope.backupList=[];
  $scope.currentStrokeColor=strokeColor;
  $scope.colors = [
    "#000000",
    "#2c3e50",
    "#7f8c8d",
    "#2980b9",
    "#c0392b",
    "#27ae60"
  ];
  $scope.drawingCreds = {
    dname:"Drawing_"+Date.now(),
    dw:1000,
    dh:1000
  }
  $scope.toolAlter=function(dtool){
    //console.log("Change tool");
    clearEffect();
    currentTool=dtool;
    $scope.currentTool=currentTool;
    //console.log(tools[currentTool]);
    canvasResolve();
  }
  $scope.changeGridSize = function(){
    globalGridSize = +$scope.grid;
    createGrid(globalGridSize);
  }
  $scope.changeColor = function(color){
    strokeColor = color;
    $scope.currentStrokeColor=strokeColor;
  }
  function listBackups(){
    for(item in localStorage){
      if(item.match(/^dbc_/)){
        $scope.backupList.push(item);
      }
    }
    //console.log($scope.backupList);
  }
  function canvasResolve(){
    if(tools[currentTool].noAction){
      document.querySelector('canvas#effect').style.zIndex='auto';
    }
    else{
      document.querySelector('canvas#effect').style.zIndex='400';
    }
  }
  $scope.loadBackup=function(bname){
    autoRestore(bname);
  }
  $scope.createNew = function(){
    var dWidth = parseInt($scope.drawingCreds.dw);
    var dHeight = parseInt($scope.drawingCreds.dh);
    if(dWidth && dHeight && $scope.drawingCreds.dname){
      appName = $scope.drawingCreds.dname;
      setup(dWidth,dHeight);
    }
  }
  $scope.saveToServer=function(){
    /*
    ToDo: For Jakir Bhai
    */
    var rawImage = drawingFab.toDataURL({
      format:'png'
    });
    var editingData = layers;
    var dataToSend = {
      drawingName:appName,
      drawingData:editingData,
      rawImage:rawImage
    }
    $http.send('<path to Wordpress Server to save to media library and store the editing data>',dataToSend)
    .then(function(success){
      Alert("Data Saved");
    },function(error){
      alert("Data Save Error");
    })
  }
  $scope.undo = undo;
  $scope.cancelUndo = cancelUndo;
  $scope.clear = clear;
  //Initializations
  listBackups();
});
