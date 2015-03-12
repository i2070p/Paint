
var mousePressed = false;
var lastX, lastY;
var ctx;
var old_n = Date.now();
var delay = 25; //ms
var buffer = new Array();

function Point(x, y){
    this.x=x;
    this.y=y;
}

Point.prototype.setXY = function(x, y) {
    this.x = x;
    this.y = y;
}

Point.prototype.toString = function() {
    return "("+this.x+", "+this.y+")";
}

function Line(x1, y1, x2, y2){
    this.from = new Point(x1, y1);
    this.to =  new Point(x2, y2);
}

Line.prototype.set = function Line(x1, y1, x2, y2){
    this.from = new Point(x1, y1);
    this.to =  new Point(x2, y2);
}

Line.prototype.toString = function() {
    return "From: "+this.from.toString()+", To: "+this.to.toString();
}


function init() {
    ctx = document.getElementById('canvas').getContext("2d");

    $('#canvas').mousedown(function (e) {
        mousePressed = true;
        draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#canvas').mousemove(function (e) {
        if (mousePressed) {
            draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#canvas').mouseup(function (e) {
        mousePressed = false;
    });

    $('#canvas').mouseleave(function (e) {
        mousePressed = false;
    });
}

function draw(x, y, isDown) {
    var n = Date.now();

    if (n - old_n > delay ) {
        if (isDown) {
            buffer.push(new Line(lastX, lastY, x, y));
        }
        lastX = x;
        lastY = y;
        old_n=Date.now();
        clearArea();
        flush();
    }
}

function flush() {
    for (i = 0; i < buffer.length; i++) {
        var from = buffer[i].from;
        var to = buffer[i].to;

        ctx.beginPath();
        ctx.moveTo(from.x, from.y);
        ctx.lineTo(to.x, to.y);
        ctx.closePath();
        ctx.stroke();
    }
}

function clearArea() {
    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}

function saveImage(path) {
   /* var dataURL = document.getElementById('canvas').toDataURL("image/png");
    $.ajax({
        type: "POST",
        url: path,
        data: {
            img64: dataURL
        }
    }).done(function(response) {
        alert(response.path);
    });

    (isDown) {
    buffer.push(JSON.stringify(new Line(lastX, lastY, x, y)));
var text="";

    alert(text);*/
}