function DrawEllipse(style, from, to) {
    this.tag = "DrawEllipse";
    this.from = from;
    this.to = to;

    this.style = style;
    this.offset = new Point(0, 0);

    this.selected = false;
}

DrawEllipse.prototype.move = function (point) {
    this.from.x += point.x;
    this.from.y += point.y;
    this.to.x += point.x;
    this.to.y += point.y;
}

DrawEllipse.prototype.resize = function (point) {
    this.to.x += point.x;
    this.to.y += point.y;
}


DrawEllipse.prototype.draw = function (canvas) {
    var xoff = this.offset.x;
    var yoff = this.offset.y;
    var w = Math.abs(this.from.x - this.to.x);
    var h = Math.abs(this.from.y - this.to.y);

    var fx = this.from.x + xoff;
    var fy = this.from.y + yoff;
    var tx = this.to.x + xoff;
    var ty = this.to.y + yoff;

    var x = (fx > tx) ? tx : fx;
    var y = (fy > ty) ? ty : fy;



    // canvas.translate(400, 200);
    // canvas.rotate(this.rotate * Math.PI / 180);
    // canvas.translate(-400, -200);

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
    if (this.selected) {
        var color = "red";
        if (this.style.color==="red") {
            color = "green";
        }
        canvas.setLineDash([10]);
        canvas.setStyle(new Style(color, this.style.lineWidth));
    } else {
        canvas.setStyle(this.style);
    }

    canvas.stroke();

    /*    canvas.moveTo(this.aFrom1);
     
     canvas.lineTo(this.aFrom2);
     canvas.lineTo(this.aTo1);
     canvas.lineTo(this.aTo2);
     canvas.lineTo(this.aFrom1);
     var style = new Style("gray", "1");
     canvas.setStyle(style);
     
     canvas.stroke();*/
    //canvas.translate(400, 200);
    //canvas.rotate(-this.rotate * Math.PI / 180);
    //canvas.translate(-400, -200);
            canvas.setLineDash([]);
};

DrawEllipse.prototype.select = function (selected) {
    this.selected = selected;
}

DrawEllipse.prototype.checkClick = function (point) {
    var xoff = this.offset.x;
    var yoff = this.offset.y;

    var fx = this.from.x + xoff;
    var fy = this.from.y + yoff;
    var tx = this.to.x + xoff;
    var ty = this.to.y + yoff;
    var tmp;
    if (fx > tx) {
        tmp = fx;
        fx = tx;
        tx = tmp;
    }

    if (fy > ty) {
        tmp = fy;
        fy = ty;
        ty = tmp;
    }


    if (point.x >= fx && point.x < tx && point.y >= fy && point.y < ty) {
        if (Math.sqrt((point.x - tx) * (point.x - tx) + (point.y - ty) * (point.y - ty)) < 40) {
            return 2;
        }
        return 1;
    }
    return false;
}