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
    drawer = new Drawer(wrapper);

    $('#canvas').mousedown(function (e) {
        mousePressed = true;
        points = new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top);
    });

    $('#canvas').mousemove(function (e) {
        if (mousePressed) {
        }
    });

    $('#canvas').mouseup(function (e) {
        mousePressed = false;
        var style = new Style($('#selColor').val(), $('#selWidth').val());
        var shape = null;
        
        switch ($("#selMode").val()) {
            case "Ellipse":
                shape = new DrawEllipse(style, points, new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top));
                break;
            case "Line":
                shape = new DrawLine(style, points, new Point(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top));
                break;
        }
        
        if (shape) {
            drawer.storeAndDraw(shape);
        }
    });

    $('#canvas').mouseleave(function (e) {
        mousePressed = false;
    });
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


function load() {
    if (savedImage) {
        drawer.parseJSONImage(savedImage);
    }
}

function saveImage(path) {
    /* var dataURL = document.getElementById('canvas').toDataURL("image/png");
     $.ajax({
     type: "POST",
     url: path,
     data: {
     img: JSON.stringify(buffer)
     }
     }).done(function(response) {
     alert(response.path);
     }); */

    //var k = new DrawEllipse(new Style('#ff0000', 20), new Point(0, 0), new Point(50, 100));
    //drawer.storeAndDraw(k);

    //console.log(drawer.getJSONImage());
    savedImage = drawer.getJSONImage();
    //drawer.parseJSONImage('[{"tag":"DrawEllipse","from":{"x":259.5,"y":308},"to":{"x":380.5,"y":399},"style":{"color":"blue","lineWidth":"9"}},{"tag":"DrawEllipse","from":{"x":530.5,"y":279},"to":{"x":612.5,"y":354},"style":{"color":"blue","lineWidth":"9"}}]');
}