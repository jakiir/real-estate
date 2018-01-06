tools.arrow = {
  name:"Arrow",
  icon:"fa-arrow-right",
  execute:function(ctx,attrs){
    //draw line as sample
    ctx.beginPath();
    var headlen = 10;   // length of head in pixels
    var angle = Math.atan2(attrs.endY-attrs.startY,attrs.endX-attrs.startX);
    ctx.moveTo(attrs.startX, attrs.startY);
    ctx.lineTo(attrs.endX, attrs.endY);
    ctx.lineTo(attrs.endX-headlen*Math.cos(angle-Math.PI/6),attrs.endY-headlen*Math.sin(angle-Math.PI/6));
    ctx.moveTo(attrs.endX, attrs.endY);
    ctx.lineTo(attrs.endX-headlen*Math.cos(angle+Math.PI/6),attrs.endY-headlen*Math.sin(angle+Math.PI/6));
    ctx.closePath();
    ctx.stroke();
  }
}
