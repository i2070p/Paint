function Drawer(wrapper, canvasElement) {
    this.wrapper = wrapper;
    this.canvasElement = canvasElement;
    this.history = {"mainLayer": {"data": [], "offset": new Point(0, 0)}};
    this.current = "mainLayer";
}

Drawer.prototype.redrawImage = function () {
    this.wrapper.clear();
    for (var i in this.history) {
        for (var j in this.history[i]["data"]) {
            this.history[i]["data"][j].draw(this.wrapper);
        }
    }
};

Drawer.prototype.clear = function () {
    this.wrapper.clear();
    this.history = {"mainLayer": {"data": [], "offset": new Point(0, 0)}};
};

Drawer.prototype.storeAndDraw = function (shape) {
    this.history[this.current]["data"].push(shape);
    shape.draw(this.wrapper);
};

Drawer.prototype.drawOnPreviewLayer = function (shape) {
    this.redrawImage();
    shape.draw(this.wrapper);
};

Drawer.prototype.getJSONImage = function () {
    return JSON.stringify(this.history);
};

Drawer.prototype.addNewLayer = function (name) {
    this.history[name] = {"data": [], "offset": new Point(0, 0)};
};


Drawer.prototype.parseJSONImage = function (image) {
    var parsed = JSON.parse(image);
    this.history.length = 0;
    for (var command in parsed) {

        var obj = parsed[command];
        this.history.push(ShapeFactory.create(obj));

    }
    this.redrawImage();

};

