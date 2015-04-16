function DrawEllipse(style, from, to) {
    this.tag = "DrawEllipse";
    this.from = from;
    this.to = to;
    this.style = style;
}

DrawEllipse.prototype.draw = function (canvas) {
    var w = Math.abs(this.from.x - this.to.x);
    var h = Math.abs(this.from.y - this.to.y);

    var fx = this.from.x;
    var fy = this.from.y;
    var tx = this.to.x;
    var ty = this.to.y;

    var x = (fx > tx) ? tx : fx;
    var y = (fy > ty) ? ty : fy;

    var kappa = 0.5522848,
            ox = (w / 2) * kappa,
            oy = (h / 2) * kappa,
            xe = x + w,
            ye = y + h,
            xm = x + w / 2,
            ym = y + h / 2;

    canvas.beginPath();
    canvas.moveTo(x, ym);


    canvas.bezierCurveTo(x, ym - oy, xm - ox, y, xm, y);
    canvas.bezierCurveTo(xm + ox, y, xe, ym - oy, xe, ym);
    canvas.bezierCurveTo(xe, ym + oy, xm + ox, ye, xm, ye);
    canvas.bezierCurveTo(xm - ox, ye, x, ym + oy, x, ym);

    canvas.setStyle(this.style);

    canvas.stroke();
};