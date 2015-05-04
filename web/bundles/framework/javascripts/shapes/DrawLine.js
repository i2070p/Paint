function DrawLine(style, from, to) {
    this.tag = "DrawLine";
    this.from = from;
    this.to = to;
    this.style = style;
    this.offset = new Point(0, 0);
    this.selected = false;
}

DrawLine.prototype.draw = function (canvas) {
    canvas.beginPath();
    canvas.moveTo(new Point(this.from.x + this.offset.x, this.from.y + this.offset.y));
    canvas.lineTo(new Point(this.to.x + this.offset.x, this.to.y + this.offset.y));
    canvas.closePath();

    if (this.selected) {
        var color = "red";
        if (this.style.color === "red") {
            color = "green";
        }
        canvas.setLineDash([10]);
        canvas.setStyle(new Style(color, this.style.lineWidth));
    } else {
        canvas.setStyle(this.style);
    }
    canvas.stroke();
    canvas.setLineDash([]);
};

DrawLine.prototype.move = function (point) {
    this.from.x += point.x;
    this.from.y += point.y;
    this.to.x += point.x;
    this.to.y += point.y;
}

DrawLine.prototype.resize = function (point) {
    this.to.x += point.x;
    this.to.y += point.y;
}

DrawLine.prototype.select = function (selected) {
    this.selected = selected;
}

DrawLine.prototype.checkClick = function (point) {
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