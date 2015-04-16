var mousePressed = false;
var lastX, lastY;
var ctx;
var old_n = Date.now();
var delay = 25; //ms
var drawer;
var wrapper;
var points;
var savedImage;

function init() {
    ctx = document.getElementById('canvas').getContext("2d");
    wrapper = new CanvasAdapter(ctx);
    drawer = new Drawer(wrapper, document.getElementById('canvas'));
    $('#canvas').mousedown(function (e) {
        mousePressed = true;
        if ($("#selMode").val() != "Pencil") {
            points = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);
        } else {
            points = new Array();
        }

    });

    $('#canvas').mousemove(function (e) {
        if (mousePressed) {
            var point = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);

            if ($("#selMode").val() == "Pencil") {
                points.push(point);
            }

            var shape = createShape(point);

            if (shape) {
                drawer.drawOnPreviewLayer(shape);
            }

        }
    });

    $('#canvas').mouseup(function (e) {
        mousePressed = false;
        var point = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);

        var shape = createShape(point);
        if (shape) {
            drawer.storeAndDraw(shape);
        }
    });

    $('#canvas').mouseleave(function (e) {
        mousePressed = false;
    });

    $('#selLayer').change(function () {
        drawer.current=$('#selLayer').val();
    });
    load();
    updateLayers();
}

function updateLayers() {
    $('#selLayer').children().remove();
    for (var layerName in drawer.history) {
        $('#selLayer').append('<option value="' + layerName + '">' + layerName + '</option>');
    }
}

function createShape(point) {
    var style = new Style($('#selColor').val(), $('#selWidth').val());
    var shape = null;

    switch ($("#selMode").val()) {
        case "Ellipse":
            shape = new DrawEllipse(style, points, point);
            break;
        case "Line":
            shape = new DrawLine(style, points, point);
            break;
        case "Pencil":
            shape = new DrawAnyShape(style, points);
            break;
    }

    return shape;
}

function draw(x, y, isDown) {
    var n = Date.now();

    if (n - old_n > delay) {
        if (isDown) {
            ctx.beginPath();

            ctx.lineJoin = "round";
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(x, y);
            ctx.closePath();
            ctx.stroke();
        }

        lastX = x;
        lastY = y;
        old_n = Date.now();
    }
}

function redrawImage() {
    drawer.redrawImage();
}

function clearArea() {
    drawer.clear();
}

function addLayer(name) {
    drawer.addNewLayer(name);
    updateLayers();
}

function load() {
    if (savedImage) {
        drawer.parseJSONImage(savedImage);
    }
}

function saveImage(path) {
    var imgName = prompt("Please enter image name");

    if (imgName === null) {
        imgName = "default";
    }

    $.ajax({
        type: "POST",
        url: path,
        data: {
            name: imgName,
            img: drawer.getJSONImage()
        }
    }).done(function (response) {
        console.log(response.success);
    });
}

function loadImage(image) {

    savedImage = image.replace(/&quot;/g, '"');

}