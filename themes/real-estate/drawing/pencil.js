tools.pencil = {
  name:"Pencil",
  icon:"fa-pencil",
  freeHand:true,
  noSnap:true,
  execute:function(ctx,attrs,fab){
    var dt = (attrs.data)?attrs.data:{};
    //draw line as sample
    var ln = new fabric.Line([attrs.startX,attrs.startY,attrs.endX,attrs.endY],{
      left:attrs.startX,
      top:attrs.startY,
      stroke:(dt.stroke)?dt.stroke:strokeColor,
      strokeWidth:dt.strokeWidth||globalStrokeWidth
    });
    if(attrs.uuid){
      ln.uuid = attrs.uuid;
    }
    fab.add(ln);
  }
}
