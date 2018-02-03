function reDraw(final){ //use final before export
  document.querySelector('.prefeditor').style.display='none';
  if(final){
    ctx = originCtx;
  }
  else{
    ctx = drawingCtx;
  }
  //reset Drawing Layer
  if(!final) resetDrawing();
  //redraw from layers
  var bgi = new fabric.Image(background,{
    width:globalWidth,
    height:globalHeight,
    left:0,
    top:0,
    selectable:false
  });
  drawingFab.add(bgi);
  layers.forEach(function(l){
    ctx.fillStyle=(l.data.fillColor || fillColor);
    ctx.strokeStyle = (l.data.strokeColor || strokeColor);
    tools[l.tool].execute(drawingCtx,l,drawingFab);
  });
  //reset fill and stroke colors
  ctx.fillStyle=fillColor;
  ctx.strokeStyle=strokeColor;
  //Auto save
  autoSave();
}
