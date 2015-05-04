function Drawer(wrapper, canvasElement, layers) {
    this.wrapper = wrapper;
    this.layers = layers;
    this.canvasElement = canvasElement;
    this.history = {"mainLayer": {"data": [], "offset": new Point(0, 0)}};
    this.current = "mainLayer";
    this.selected = null;
    this.mode = 0;
}

Drawer.prototype.redrawImage = function () {
    this.wrapper.clear();
    for (var i in this.history) {
        this.layers[i].clear();
        for (var j in this.history[i]["data"]) {
            var shape = this.history[i]["data"][j];
            shape.draw(this.wrapper);
            this.layers[i].scale(0.24, 0.24);
            shape.draw(this.layers[i]);
            this.layers[i].canvas.scale(1.0 / 0.24, 1.0 / 0.24);
        }
    }
};

Drawer.prototype.clear = function () {
    this.history[this.current]['data'].length = 0;
    this.redrawImage();
};

Drawer.prototype.select = function (click) {

    for (var j in this.history[this.current]["data"]) {
        var clicked = this.history[this.current]["data"][j].select(false);
        this.selected = null;
        this.clicked = 0;
    }

    for (var j in this.history[this.current]["data"]) {
        var clicked = this.history[this.current]["data"][j].checkClick(click);
        if (clicked) {
            var shape = this.history[this.current]["data"][j];
            this.selected = shape;
            shape.select(true);
            this.mode = clicked;
            break;
        }
    }
    this.redrawImage();
};

Drawer.prototype.change = function (point) {
    if (this.selected) {

        switch (this.mode) {
            case 1:
                this.selected.move(point);
                break;
            case 2:
                this.selected.resize(point);
                break;
        }

        this.redrawImage();
    }
}

Drawer.prototype.storeAndDraw = function (shape) {
    this.history[this.current]["data"].push(shape);
    shape.draw(this.wrapper);
};

Drawer.prototype.drawOnPreviewLayer = function (shape) {
    this.redrawImage();

    shape.draw(this.wrapper);
    var curr = this.current;
    this.layers[curr].scale(0.24, 0.24);
    shape.draw(this.layers[curr]);
    this.layers[curr].scale(1.0 / 0.24, 1.0 / 0.24);
};

Drawer.prototype.getJSONImage = function () {
    return JSON.stringify(this.history);
};

Drawer.prototype.getThumbnail = function () {
    return this.canvasElement.toDataURL("image/png");
};

Drawer.prototype.getLayerOffset = function () {
    return this.history[this.current]['offset'];
};

Drawer.prototype.setLayerOffset = function (point) {


    this.history[this.current]['offset'] = point;

    for (var j in this.history[this.current]["data"]) {
        this.history[this.current]["data"][j].offset = point;
    }

    this.redrawImage();
}

Drawer.prototype.addNewLayer = function (name) {
    this.history[name] = {"data": [], "offset": new Point(0, 0)};

};


Drawer.prototype.parseJSONImage = function (image) {
    var parsed = JSON.parse(image);
    this.history.length = 0;
    for (var layer in parsed) {

        var obj = parsed[layer];
        if (this.history[layer] == undefined) {
            this.history[layer] = {"data": [], "offset": new Point(0, 0)};
        }
        for (var i in obj['data']) {

            this.history[layer]['data'].push(ShapeFactory.create(obj['data'][i]));
        }

        this.history[layer]['offset'] = obj['offset'];
    }
    this.redrawImage();

};

