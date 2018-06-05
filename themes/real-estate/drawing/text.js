tools.text={
  name:"Text",
  icon:"fa-font",
  ghost:true,
  boomerang:true,
  execute:function(ctx,attrs,fab){
    var dt = (attrs.data)?attrs.data:{};
    var mText = new fabric.Text(attrs.text?attrs.text:'Click to change',{
      left:attrs.startX?attrs.startX:attrs.endX,
      top:attrs.startY?attrs.startY:attrs.endY,
      fill:(dt.stroke)?dt.stroke:strokeColor,
      fontSize:22,
      textAlign:'left',
      angle:attrs.angle
    });
    if(attrs.uuid){
      mText.uuid = attrs.uuid;
    }
    fab.add(mText);
  }
}
