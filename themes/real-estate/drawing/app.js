angular.module('drawing',[])
.controller('toolsController',function($scope){
  $scope.tools=tools;
  $scope.currentTool=currentTool;
  canvasResolve();
  $scope.grid="10";
  $scope.strokeWidth=globalStrokeWidth;
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
  window.changeTool = function(tool){
    $scope.toolAlter(tool);
    try{
      $scope.$apply()
    }
    catch(e){
      console.log(e);
    }
  }
  $scope.changeGridSize = function(){
    globalGridSize = +$scope.grid;
    createGrid(globalGridSize);
  }
  $scope.changeColor = function(color){
    strokeColor = color;
    $scope.currentStrokeColor=strokeColor;
  }
  $scope.changeStrokeWidth=function(){
    globalStrokeWidth=+$scope.strokeWidth;
    //console.log(globalStrokeWidth)
  }
  $scope.heightInPx=function(initVal){
    return initVal+"px";
  }
  function listBackups(){
    for(item in localStorage){
      if(item.match(/^dbc_/)){
        //$scope.backupList.push(item);
		//console.log($scope.backupList);
      }
    }
	if(!window.location.hash){
		var drawing_type = 'survey';
	} else {
		var drawing_type = 'annotate';
	}
	var form_data = new FormData();
	form_data.append('action', 'get_save_as_draft');
	form_data.append('template_id', template_id);
	form_data.append('hash', hash);
	form_data.append('user_id', user_id);
	form_data.append('drawing_type', drawing_type);
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
				var itemDraw = 'dbc_'+parsedJson.drawingName;
				if(itemDraw.match(/^dbc_/)){					
					$scope.backupList.push(itemDraw);
					$('.unfinished-title').removeClass('ng-hide').addClass('ng-show');
					var htmlEle = '<p class="backupname" onClick=loadBackupCus("'+itemDraw+'")>'+itemDraw+'</p>';
					$('.unfinished').prepend(htmlEle);
				}
				//console.log($scope.backupList);
			} else {
				if(drawing_type == 'annotate'){
					setAccessSession = setTimeout(saveToServer, 5000);
					loadDoc();
				}				
			}
		  },
		  error: function (errorThrown) {
			//$('.msg_show').html('<font style="color:red">'+errorThrown+'</span>');
		  }
		});
	
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
	setAccessSession = setTimeout(saveToServer, 5000);
    var dWidth = parseInt($scope.drawingCreds.dw);
    var dHeight = parseInt($scope.drawingCreds.dh);
    if(dWidth && dHeight && $scope.drawingCreds.dname){
      appName = $scope.drawingCreds.dname;
      setup(dWidth,dHeight);
    }
  }  
  $scope.undo = undo;
  $scope.cancelUndo = cancelUndo;
  $scope.clear = clear;
  //Initializations
  listBackups();
});

function loadBackupCus(bname){
	setAccessSession = setTimeout(saveToServer, 5000);
	autoRestore(bname);
}

function loadDocCus(){
	setAccessSession = setTimeout(saveToServer, 5000);
    //console.log("Document load");
    var imageEl = document.querySelector('#theimage');
    var iWidth = imageEl.width;
    var iHeight = imageEl.height;
    if(iWidth>1000){
      iHeight = (iHeight/iWidth)*1000;
      iWidth = 1000;
    }
    //console.log(iWidth,iHeight);
    setup(iWidth,iHeight,imageEl);
  }

function saveToServer(){
	  setAccessSession = setTimeout(saveToServer, 5000);
	  $('.saveasdrave').find('.fa').removeClass('fa-floppy-o');
	  $('.saveasdrave').find('.fa').addClass('fa-refresh fa-spin');
	  $('.ajax_mess').html('');
    /*
    ToDo: For Jakir Bhai
    */
    /*var rawImage = drawingFab.toDataURL({
      format:'png'
    });
    var editingData = layers;
    var dataToSend = {
      drawingName:appName,
      drawingData:editingData,
      rawImage:rawImage
    }*/
	
	var storeData = {
		data:layers,
		width:globalWidth,
		height:globalHeight
	  }
	
	if(!window.location.hash){
		var drawing_type = 'survey';
	} else {
		var drawing_type = 'annotate';
	}
	var form_data = new FormData();
	form_data.append('action', 'save_as_draft');
	form_data.append('template_id', template_id);
	form_data.append('hash', hash);
	form_data.append('user_id', user_id);	
	form_data.append('drawingName', appName);
	var jsonString = JSON.stringify(storeData);
	form_data.append('drawingData', jsonString);
	form_data.append('drawing_type', drawing_type);
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
				$('.saveasdrave').find('.fa').removeClass('fa-refresh fa-spin');
				$('.saveasdrave').find('.fa').addClass('fa-floppy-o');
				$('.ajax_mess').html(parsedJson.mess);
			} else {
				alert(parsedJson.mess);
			}
		  },
		  error: function (errorThrown) {
			//$('.msg_show').html('<font style="color:red">'+errorThrown+'</span>');
		  }
		});
    /*$http.send(ajax_url+'?action=cache_drwing_save',dataToSend)
    .then(function(success){
      Alert("Data Saved");
    },function(error){
      alert("Data Save Error");
    })*/
  }
