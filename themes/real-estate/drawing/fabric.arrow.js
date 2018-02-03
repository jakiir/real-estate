(function($){
  $.Arrow = $.util.createClass($.Line, $.Observable, {
    initialize: function(e,t) {
      this.callSuper("initialize", e, t)
      this.set({type:'arrow'});
    },
    _render: function(e) {
      e.beginPath();
      var r = this.calcLinePoints();
      var headlen = 8;   // length of head in pixels
      var angle = Math.atan2(r.y2-r.y1,r.x2-r.x1);
      e.moveTo(r.x1, r.y1);
      e.lineTo(r.x2, r.y2);
      e.lineTo(r.x2-headlen*Math.cos(angle-Math.PI/6),r.y2-headlen*Math.sin(angle-Math.PI/6));
      e.moveTo(r.x2, r.y2);
      e.lineTo(r.x2-headlen*Math.cos(angle+Math.PI/6),r.y2-headlen*Math.sin(angle+Math.PI/6));

      e.lineWidth = this.strokeWidth;
      var s = e.strokeStyle;
      e.strokeStyle = this.stroke || e.fillStyle, this.stroke && this._renderStroke(e), e.strokeStyle = s
    },
    complexity: function() {
      return 2
    }
  });
  $.Arrow.fromObject = function(e) {
    var n = [e.x1, e.y1, e.x2, e.y2];
    return new $.Arrow(n, e)
  }
})(fabric);
