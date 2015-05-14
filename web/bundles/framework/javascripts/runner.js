var mousePressed = false;
var lastX, lastY;
var ctx;
var old_n = Date.now();
var delay = 25; //ms
var drawer;
var wrapper;
var points;
var savedImage;
var canvas2;

var layerList = {};

function init() {
    $("#layer_list_div ul").append('<li class="mainLayer"><canvas class="canvas-layer-list" id="mainLayer" width="192" height="96"></canvas><br><center>mainLayer</center></li>');
    layerList['mainLayer'] = new CanvasAdapter(document.getElementById("mainLayer").getContext('2d'));

    $("#layer_list li").click(function () {
        drawer.current = $(this).attr('class');
    });


    canvas = document.getElementById('canvas');
    //canvas.width = 800;
    //canvas.height = 400;
    ctx = canvas.getContext('2d');
    wrapper = new CanvasAdapter(ctx, new Point(400, 200));
    drawer = new Drawer(wrapper, canvas, layerList);

    $('#canvas').mousedown(function (e) {
        mousePressed = true;
        if ($("#selMode").val() != "Move" && $("#selMode").val() != "MoveLayer") {
            if ($("#selMode").val() != "Pencil") {
                points = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);
            } else {
                points = new Array();
            }
        } else if ($("#selMode").val() == "MoveLayer") {
            points = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);

            var point = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);
            drawer.setLayerOffset(new Point(point.x - points.x, point.y - points.y));

        } else {
            points = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);
            drawer.select(new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top));

        }

    });

    $('#canvas').mousemove(function (e) {
        var point = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);

        if (mousePressed) {

            if ($("#selMode").val() != "Move" && $("#selMode").val() != "MoveLayer") {

                if ($("#selMode").val() == "Pencil") {
                    points.push(point);
                }

                var shape = createShape(point);

                if (shape) {
                    drawer.drawOnPreviewLayer(shape);
                }
            } else if ($("#selMode").val() == "MoveLayer") {
                drawer.setLayerOffset(new Point(point.x - points.x, point.y - points.y));

            } else {
                //drawer.select(point);
                drawer.change(new Point(point.x - points.x, point.y - points.y));
                points = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);
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
    $("#layer_list_div ul").append('<li class="' + name + '"><canvas class="canvas-layer-list" id="' + name + '" width="192" height="96"></canvas><br><center>' + name + '</center></li>');
    layerList[name] = new CanvasAdapter(document.getElementById(name).getContext('2d'));
    $("#layer_list li").click(function () {
        drawer.current = $(this).attr('class');
    });
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

    var pub = "true";
    if (!$("#public").is(":checked")) {
        pub = "false";
    }

    $.ajax({
        type: "POST",
        url: path,
        data: {
            name: imgName,
            img: drawer.getJSONImage(),
            thumb: drawer.getThumbnail(),
            public: pub
        }
    }).done(function (response) {
        console.log(response.success);
    });
}



function loadImage(image) {
    savedImage = image.replace(/&quot;/g, '"');
}