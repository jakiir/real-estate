tools.rect={
  name:"Rectangle",
  icon:"fa-square-o",
  execute:function(ctx,attrs,fab){
    var fCoords = xySort(attrs.startX,attrs.startY,attrs.endX,attrs.endY);
    attrs.startX=fCoords.x1;
    attrs.startY=fCoords.y1;
    attrs.endX=fCoords.x2;
    attrs.endY=fCoords.y2;
    var rectWidth = attrs.endX-attrs.startX;
    var rectHeight = attrs.endY-attrs.startY;
    var dt = (attrs.data)?attrs.data:{};
    if(rectWidth<1 || rectHeight<1) return false;
    var rectData = {
      width:rectWidth,
      height:rectHeight,
      fill:fillColor,
      originX:'center',
      originY:'center',
      strokeWidth:dt.strokeWidth||globalStrokeWidth
    }
    if(dt.fill){
      rectData.fill = dt.fill;
    }
    else{
      rectData.fill=null;
    }
    rectData.stroke = (dt.stroke)?dt.stroke:strokeColor;
    var drect = new fabric.Rect(rectData);
    //distance calculation
    var hDist = Math.abs(attrs.endX-attrs.startX)/globalGridSize;
    var vDist = Math.abs(attrs.startY-attrs.endY)/globalGridSize;
    var lText = new fabric.Text(vDist.toString(),{
      top:0,
      left:-rectWidth/2,
      fill:(dt.stroke)?dt.stroke:strokeColor,
      fontSize:12,
      textAlign:'center',
      angle:-90
    });
    var bText = new fabric.Text(hDist.toString(),{
      top:(rectHeight/2)-14,
      left:0,
      fill:(dt.stroke)?dt.stroke:strokeColor,
      fontSize:12,
      textAlign:'center'
    });
    var sqGrp = new fabric.Group([drect,lText,bText],{
      left:attrs.startX,
      top:attrs.startY,
      width:rectWidth,
      height:rectHeight,
      angle:attrs.angle
    });
    if(attrs.uuid){
      sqGrp.uuid = attrs.uuid;
    }
    fab.add(sqGrp);
  }
}
