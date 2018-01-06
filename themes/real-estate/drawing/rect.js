tools.rect={
  name:"Rectangle",
  icon:"fa-square-o",
  execute:function(ctx,attrs,fab){
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
      strokeWidth:7
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
    var sqGrp = new fabric.Group([drect],{
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
