tools.curve = {
  name:"Curve",
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
    // var dLine = new fabric.Line([attrs.startX,attrs.startY,attrs.endX,attrs.endY],{
    //   originX:'left',
    //   originY:'left',
    //   stroke:(dt.stroke)?dt.stroke:strokeColor,
    //   strokeWidth:dt.strokeWidth||globalStrokeWidth
    // });
    var distPx = Math.round(Math.sqrt(Math.pow(attrs.nstartX-attrs.nendX,2)+Math.pow(attrs.nstartY-attrs.nendY,2)));
    var factor = Math.round(distPx/3);
    var centX = (attrs.nstartX+attrs.nendX)/2;
    var centY = (attrs.nstartY+attrs.nendY)/2;
    var finalCX = centX;
    var finalCY = centY;
    var xCurve = (attrs.startX-attrs.endX>attrs.startY-attrs.endY);
    if(!xCurve){
      if(attrs.startX>attrs.nendX){
        finalCY = finalCY-factor;
      }
      else{
        finalCY = finalCY+factor;
      }
    }
    if(xCurve){
      if(attrs.startY>attrs.endY){
        finalCX = finalCX-factor;
      }
      else{
        finalCX = finalCX+factor;
      }
    }
    console.log(centX,centY,factor);
    var pathPoints = "M"+[attrs.startX,attrs.startY].join(" ");
    pathPoints+=" Q "+[finalCX,finalCY].join(" ");
    pathPoints+=" "+[attrs.endX,attrs.endY].join(" ");
    var dLine = new fabric.Path(pathPoints,{
      originX:'left',
      originY:'left',
      fill:null,
      stroke:(dt.stroke)?dt.stroke:strokeColor,
      strokeWidth:dt.strokeWidth||globalStrokeWidth
    });
    //Distance calculation
    var dist = Math.round(distPx/globalGridSize);
    var lText = new fabric.Text(dist.toString(),{
      originX:'left',
      originY:'left',
      left:0,
      top:0,
      fill:(dt.stroke)?dt.stroke:strokeColor,
      fontSize:12,
      textAlign:'center',
      textBackgroundColor:'#fff'
    });
    var sqGrp = new fabric.Group([dLine,lText],{
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
