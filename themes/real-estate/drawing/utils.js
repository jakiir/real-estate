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
  var sData = JSON.parse(localStorage.getItem('dbc_'+appName));
  setup(sData.width,sData.height);
  // fillColor=sData.fill;
  // strokeColor=sData.stroke;
  // currentTool=sData.tool;
  layers=sData.data;
  reDraw();
}
function gen_uuid(){
  return 'ob_'+Date.now().toString();
}
