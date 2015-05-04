function DrawAnyShape(style, points) {
    this.tag = "DrawAnyShape";
    this.points = points;
    this.style = style;
    this.offset = new Point(0, 0);
    this.selected = false;
}

DrawAnyShape.prototype.draw = function (canvas) {
    canvas.beginPath();

    var point = this.points[0];
    canvas.moveTo(new Point(point.x + this.offset.x, point.y + this.offset.y));

    for (var i = 1; i < this.points.length; i++) {
        canvas.lineTo(new Point(this.points[i].x + this.offset.x, this.points[i].y + this.offset.y));
    }

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

DrawAnyShape.prototype.move = function (point) {
    for (var i = 0; i < this.points.length; i++) {
        this.points[i].x += point.x;
        this.points[i].y += point.y;
    }
}

DrawAnyShape.prototype.resize = function (point) {

}


DrawAnyShape.prototype.select = function (selected) {
    this.selected = selected;
}

DrawAnyShape.prototype.checkClick = function (pt) {

    var up = this.points[0].y;
    var down = this.points[0].y;
    var left = this.points[0].x;
    var right = this.points[0].x;

    for (var i = 1; i < this.points.length; i++) {
        var point = this.points[i];
        if (point.y < up) {
            up = point.y;
        }
        if (point.y > down) {
            down = point.y;
        }
        if (point.x < left) {
            left = point.x;
        }
        if (point.x > right) {
            right = point.x;
        }
    }

    var from = new Point(left, up);
    var to = new Point(right, down);

    var xoff = this.offset.x;
    var yoff = this.offset.y;

    var fx = from.x + xoff;
    var fy = from.y + yoff;
    var tx = to.x + xoff;
    var ty = to.y + yoff;

    if (pt.x >= fx && pt.x < tx && pt.y >= fy && pt.y < ty) {
        return 1;
    }
    return false;
}