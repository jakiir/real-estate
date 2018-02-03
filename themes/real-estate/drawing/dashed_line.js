tools.dashed = {
  name:"Dashed",
  icon:"fa-expand",
  execute:function(ctx,attrs,fab){
    var fCoords = xySort(attrs.startX,attrs.startY,attrs.endX,attrs.endY);
    attrs.nstartX=fCoords.x1;
    attrs.nstartY=fCoords.y1;
    attrs.nendX=fCoords.x2;
    attrs.nendY=fCoords.y2;
    var rectWidth = attrs.nendX-attrs.nstartX;
    var rectHeight = attrs.nendY-attrs.nstartY;
    var dt = (attrs.data)?attrs.data:{};
    var dLine = new fabric.Line([attrs.startX,attrs.startY,attrs.endX,attrs.endY],{
      originX:'left',
      originY:'left',
      stroke:(dt.stroke)?dt.stroke:strokeColor,
      strokeWidth:dt.strokeWidth||globalStrokeWidth,
      strokeDashArray: [10, 7],
    });
    //Distance calculation
    var dist = Math.round(Math.sqrt(Math.pow(attrs.nstartX-attrs.nendX,2)+Math.pow(attrs.nstartY-attrs.nendY,2))/globalGridSize);
    // var lText = new fabric.Text(dist.toString(),{
    //   originX:'left',
    //   originY:'left',
    //   left:0,
    //   top:0,
    //   fill:(dt.stroke)?dt.stroke:strokeColor,
    //   fontSize:12,
    //   textAlign:'center',
    //   textBackgroundColor:'#fff'
    // });
    var sqGrp = new fabric.Group([dLine],{
      left:attrs.nstartX,
      top:attrs.nstartY,
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
