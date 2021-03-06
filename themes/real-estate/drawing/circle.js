tools.circle={
  name:"Circle",
  icon:"fa-circle-thin",
  execute:function(ctx,attrs,fab){
    var fCoords = xySort(attrs.startX,attrs.startY,attrs.endX,attrs.endY);
    attrs.startX=fCoords.x1;
    attrs.startY=fCoords.y1;
    attrs.endX=fCoords.x2;
    attrs.endY=fCoords.y2;
    var centerX = attrs.startX+((attrs.endX-attrs.startX)/2);
    var centerY = attrs.startY+((attrs.endY-attrs.startY)/2);
    var rectWidth = attrs.endX-attrs.startX;
    var rectHeight = attrs.endY-attrs.startY;
    var radius = (rectWidth>rectHeight)?rectHeight/2:rectWidth/2;
    var dt = (attrs.data)?attrs.data:{};
    if(centerX<1 || centerY<1 || radius<1) return false;
    var circleData = {
      radius:radius,
      originX:'center',
      originY:'center',
      strokeWidth:dt.strokeWidth||globalStrokeWidth
    }
    if(dt.fill){
      circleData.fill = dt.fill;
    }
    else{
      circleData.fill=null;
    }
    circleData.stroke = (dt.stroke)?dt.stroke:strokeColor;
    var dCircle = new fabric.Circle(circleData);
    var sqGrp = new fabric.Group([dCircle],{
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
