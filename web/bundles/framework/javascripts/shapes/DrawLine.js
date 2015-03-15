function DrawLine(style, from, to) {
    this.from = from;
    this.to = to;
    this.style = style;
}

DrawLine.prototype.draw = function (canvas) {
    canvas.beginPath();
    canvas.moveTo(this.from);
    canvas.lineTo(this.to);
    canvas.closePath();

    canvas.setStyle(this.style);
    
    canvas.stroke();
};