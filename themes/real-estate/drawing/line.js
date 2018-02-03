tools.line = {
  name:"Line",
  icon:"fa-expand",
  execute:function(ctx,attrs,fab){
    //console.log(attrs);
    var rectWidth = attrs.endX-attrs.startX;
    var rectHeight = attrs.endY-attrs.startY;
    var dt = (attrs.data)?attrs.data:{};
    var dLine = new fabric.Line([attrs.startX,attrs.startY,attrs.endX,attrs.endY],{
      stroke:(dt.stroke)?dt.stroke:strokeColor,
      strokeWidth:7,
      left:0,
      top:0
    });
    var dRect = new fabric.Rect({
      width:rectWidth,
      height:rectHeight,
      originX:0,
      originY:0,
      fill:null
    });
    var sqGrp = new fabric.Group([dRect,dLine],{
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
