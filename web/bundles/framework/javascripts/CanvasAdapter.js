function CanvasAdapter(canvas) {
    this.canvas = canvas;
}

CanvasAdapter.prototype.clear = function () {
    this.canvas.setTransform(1, 0, 0, 1, 0, 0);
    this.canvas.clearRect(0, 0, this.canvas.canvas.width, this.canvas.canvas.height);
};

CanvasAdapter.prototype.beginPath = function () {
    this.canvas.beginPath();
};

CanvasAdapter.prototype.closePath = function () {
    this.canvas.closePath();
};

CanvasAdapter.prototype.moveTo = function () {
    if (arguments.length === 1) {
        var point = arguments[0];
        this.canvas.moveTo(point.x, point.y);
    } else if (arguments.length === 2) {
        this.canvas.moveTo(arguments[0], arguments[1]);
    }
};

CanvasAdapter.prototype.lineTo = function () {
    if (arguments.length === 1) {
        var point = arguments[0];
        this.canvas.lineTo(point.x, point.y);
    } else if (arguments.length === 2) {
        this.canvas.lineTo(arguments[0], arguments[1]);
    }
};

CanvasAdapter.prototype.setStyle = function (style) {
    this.canvas.lineWidth = style.lineWidth;
    this.canvas.strokeStyle = style.color;
};

CanvasAdapter.prototype.stroke = function () {
    this.canvas.stroke();
};

CanvasAdapter.prototype.bezierCurveTo = function (cp1x, cp1y, cp2x, cp2y, x, y) {
    this.canvas.bezierCurveTo(cp1x, cp1y, cp2x, cp2y, x, y);
};