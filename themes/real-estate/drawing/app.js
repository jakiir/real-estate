angular.module('drawing',[])
.controller('toolsController',function($scope){
  $scope.tools=tools;
  $scope.currentTool=currentTool;
  canvasResolve();
  $scope.grid="10";
  $scope.backupList=[];
  $scope.strokeWidth=1;
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
  $scope.changeStrokeWidth=function(){
    globalStrokeWidth=+$scope.strokeWidth;
    //console.log(globalStrokeWidth)
  }
  $scope.heightInPx=function(initVal){
    return initVal+"px";
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
	/*var form_data = new FormData();
	form_data.append('action', 'cache_drwing_save');
	form_data.append('template_id', template_id);
	form_data.append('user_id', user_id);
	var jsonString = JSON.stringify(localStorage);
	form_data.append('template_html', jsonString);	
	$.ajax({
		  dataType : "json",
		  url: ajax_url,
		  type: 'post',
		  contentType: false,
		  processData: false,
		  data: form_data,          
		  success: function (data) {
			var parsedJson = data;        
			if(parsedJson.success == true){
				console.log(parsedJson.mess);
			} else {
				console.log(parsedJson.mess);
			}
		  },
		  error: function (errorThrown) {
			//$('.msg_show').html('<font style="color:red">'+errorThrown+'</span>');
		  }
		});*/
	
    //console.log(localStorage);
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
