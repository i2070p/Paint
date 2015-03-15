function DrawAnyShape(style, points) {
    this.points = points;
    this.style = style;
}

DrawAnyShape.prototype.draw = function (canvas) {
    canvas.beginPath();

    var point = this.points[0];
    canvas.moveTo(point);

    for (var i = 1; i < this.points.length; i++) {
        canvas.lineTo(this.points[i]);
    }

    canvas.setStyle(this.style);

    canvas.stroke();
};