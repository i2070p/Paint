function Drawer(wrapper) {
    this.wrapper = wrapper;
    this.history = new Array();
}

Drawer.prototype.redrawImage = function () {
    this.wrapper.clear();
    for (var i = 0; i < this.history.length; i++) {
        this.history[i].draw(this.wrapper);
    }
};

Drawer.prototype.clear = function () {
    this.wrapper.clear();
};


Drawer.prototype.storeAndDraw = function (shape) {
    this.history.push(shape);
    shape.draw(this.wrapper);
};

Drawer.prototype.getJSONImage = function () {
    return JSON.stringify(this.history);
};

Drawer.prototype.parseJSONImage = function (image) {
    var parsed = JSON.parse(image);
    this.history.length = 0;
    for (var command in parsed) {

        var obj = parsed[command];
        this.history.push(ShapeFactory.create(obj));

    }
    redrawImage();

};
