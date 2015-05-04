function DrawImage(style, from, to, content) {
    this.tag = "DrawImage";
    this.from = from;
    this.to = to;
    this.content = content;
    this.style = style;
    this.offset = new Point(0, 0);
}

DrawImage.prototype.draw = function (canvas) {
    var image = new Image();
    image.src = this.content;
    var fx = this.from.x;
    var fy = this.from.y;
    var ox = this.offset.x;
    var oy = this.offset.y;
    var w = Math.abs(this.from.x - this.to.x);
    var h = Math.abs(this.from.y - this.to.y);
    image.onload = function () {
        canvas.drawImage(image, fx + ox, fy + oy, w, h);
    }
};