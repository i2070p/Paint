ShapeFactory = {
    create: function (obj) {
        switch (obj.tag) {
            case "DrawEllipse":
                return eval("new DrawEllipse("+this.createStyle(obj)+", "+this.createPoint(obj, "from")+", "+this.createPoint(obj, "to")+");");
            case "DrawLine":
                return eval("new DrawLine("+this.createStyle(obj)+", "+this.createPoint(obj, "from")+", "+this.createPoint(obj, "to")+");");
            case "DrawAnyShape":
                return eval("new DrawAnyShape(obj.style, obj.points);");
        }
        return null;
    },
    createStyle: function(obj) {
        return "new Style(obj.style.color, obj.style.lineWidth)";
    },
    createPoint: function(obj, name) {
        return "new Point(obj."+name+".x, obj."+name+".y)";
    }
    
}