//Snapping to Grid
function getNearestGrid(x,y){
  var xOffset = Math.round(x/globalGridSize)*globalGridSize;
  var yOffset = Math.round(y/globalGridSize)*globalGridSize;
  return {
    x:xOffset,
    y:yOffset
  }
}
//Clear Effect Layer
function clearEffect(){
  //reset effect layer
  // effectCvs.width=globalWidth;
  // effectCvs.height=globalHeight;
  // effectCtx.fillStyle=fillColor;
  // effectCtx.strokeStyle=strokeColor;
  effectFab.clear();
  //console.log('effectfab cleared');
}
function resetDrawing(){
  // drawingCvs.width=globalWidth;
  // drawingCvs.height=globalHeight;
  // drawingCtx.fillStyle=fillColor;
  // drawingCtx.strokeStyle=strokeColor;
  drawingFab.clear();
}
function saveInstruction(toolName,startX,startY,endX,endY,uuid,data){
  // reset redo
  redo=[];
  //blank fill data
  if(!data) data={};
  //save current fill and stroke colors
  //data.fill=fillColor;
  data.stroke=strokeColor;
  layers.push({
    tool:toolName,
    startX:startX,
    startY:startY,
    endX:endX,
    endY:endY,
    angle:0,
    uuid:uuid,
    data:data
  });
}

//Undo Redo
function undo(){
  if(!layers.length) return false;
  redoList.push(layers.pop());
  reDraw();
}
function cancelUndo(){
  if(!redoList.length) return false;
  layers.push(redoList.pop());
  reDraw();
}
function clear(){
  layers=[];
  redoList=[];
  localStorage.removeItem(appName+'_drawing_backup');
  setup(globalWidth,globalHeight);
}
//Autosave Drawing
function autoSave(){
  var storeData = {
    data:layers,
    width:globalWidth,
    height:globalHeight
  }
  localStorage.setItem('dbc_'+appName,JSON.stringify(storeData));
}
function autoRestore(bckname){
  appName=bckname.slice(4);
  if(!localStorage.getItem('dbc_'+appName)){
    return false;
  }
  //var sData = JSON.parse(localStorage.getItem('dbc_'+appName));
  //console.log(sData);
  //setup(sData.width,sData.height);
  // fillColor=sData.fill;
  // strokeColor=sData.stroke;
  // currentTool=sData.tool;
  //layers=sData.data;
  //reDraw();
  
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
			var itemDraw = parsedJson.drawingData;
			var res = itemDraw.replace(/\\/g,"");
			// preserve newlines, etc - use valid JSON
			//var b = JSON.parse(JSON.stringify(itemDraw));
			//var obj = JSON.parse(itemDraw);			
			var sData = JSON.parse(res);
			  //console.log(sData);
			  setup(sData.width,sData.height);
			  // fillColor=sData.fill;
			  // strokeColor=sData.stroke;
			  // currentTool=sData.tool;
			  layers=sData.data;
			  reDraw();
			
		} else {
			alert(parsedJson.mess);
		}
	  },
	  error: function (errorThrown) {
		//$('.msg_show').html('<font style="color:red">'+errorThrown+'</span>');
	  }
	});
  
}
function gen_uuid(){
  return 'ob_'+Date.now().toString();
}
