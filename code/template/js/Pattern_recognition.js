var width = height = 0;
var path = []; //made by users
var validpath = [];//positions x,y defined by pattern matrix 
var positions = "";
var hovering = [-1, -1];
var validpositions = []; //same as path, positions i,j of pattern matrix
var correctpositions = "00110201";
var cSize = 3; //size of canvas
var addonce = true;
var xStart = yStart = -1;
var xFinal = yFinal = -1;
var maxLengthPath = 50;
function isCorrectPath(vpath, cpath){ //comparing strings
	var r = true;
	len = cpath.length;
	vlen = vpath.length;
	p = 0;
	if (len != vlen) return false;
	return (vpath === cpath);
	
}
function checkValidPath(vpath, x, y, threhold){
	var r = false;
	var len = vpath.length;
	p = 0;
	while (p < len && r != true){
		if (Math.abs(vpath[p].x - x) <= threhold && Math.abs(vpath[p].y - y) <= threhold){
			var pto = new Point(vpath[p].x,vpath[p].y);			
			if(path.length == 0){ 
				path[0] = pto;
				positions += (validpositions[p].x).toString()+(validpositions[p].y).toString();
				hovering[0] = validpositions[p].x;
				hovering[1] = validpositions[p].y;
				xStart = xFinal = pto.x;
				yStart = yFinal = pto.y;
				//console.log(xStart + " .. "+yStart);
			}else{
				if(!(path[path.length-1].x == pto.x && path[path.length-1].y == pto.y)){
					path[path.length] = pto;
					positions += (validpositions[p].x).toString()+(validpositions[p].y).toString();
					hovering[0] = validpositions[p].x;
					hovering[1] = validpositions[p].y;
					//console.log(path[path.length-1].x + " & "+path[path.length-1].y);
					//console.log(positions);
				}
			}
			r = true;            			            		
			//for (var k=0;k<path.length;k++) console.log(path[k].x + " ; "+path[k].y);
			//console.log(Math.abs(vpath[p].y - y));
		}
		p++;

	}
	return r;
}
function basePattern(){
	var c = document.getElementById("myCanvas");
	var size = document.getElementById("sizeCanvas").value;
	cSize = size;
	var f = 1;
	if (size > (9-3))	f = 1.5;
	c.width = f*3*100;
	c.height = f*3*100;
	
	width = c.width;
	height = c.height;
	var ctx = c.getContext("2d");
	var centerX = c.width / 2;
	var centerY = c.height / 2;
	

	// Create gradient						
	
	var ctx = c.getContext("2d");
	var grd = ctx.createRadialGradient(centerX,centerY,1,centerX,centerY,100);
	grd.addColorStop(0, "black");
	grd.addColorStop(0.5, "red");
	grd.addColorStop(1, "white");	
	ctx.shadowBlur=10;
	
	//ctx.fillStyle = grd;
	ctx.fillStyle = "#0F0F0F";
	var ctr = [];
	//validpath.splice(0,validpath.length);
	var radio = width/(4+(size-1)*3);
	//console.log(radio);
	var pivot = 2*radio;
	var dx = 3*radio;
	previousr = radio;
	for(var i=0;i<size;i++){				    
	    var aux = [];
	    for(var j=0;j<size;j++){				    	  
			ctx.beginPath();
			if (hovering[0] == i && hovering[1] == j) radio = radio*1.2;
			else radio = previousr;
			var x = pivot+i*dx;
			var y = pivot+j*dx;
			grd = ctx.createRadialGradient(x,y,radio/5,x,y,radio);
			grd.addColorStop(0, "black");
			grd.addColorStop(0.5, "red");
			grd.addColorStop(1, "white");
			ctx.fillStyle = grd;
			ctx.arc(x,y,radio,0,2*Math.PI);
			ctx.fill();
			ctx.lineWidth = 2;
			ctx.strokeStyle = '#003300';
			ctx.stroke();
			aux[j] = x+" - "+y;
			if(addonce==true){
				var punto = new Point(x,y);
				var pos = new Point(i,j);
				validpath[i*size+j] = punto;
				validpositions[i*size+j] = pos;
			}
	          
	    }
	    ctr[i] = aux;
	    
	}	
	addonce = false;
	
}
window.onload = basePattern;
function drawPattern(color,x,y){
	var c = document.getElementById("myCanvas");
	var context = c.getContext("2d");
	var xy = c.leftTopScreen ();
	//console.log(checkValidPath(validpath,x - xy[0],y - xy[1],10));
	if (path.length > maxLengthPath) path = [];
	if(path.length > 0){
		if(xStart != -1 && yStart != -1){
			var flip = document.getElementById ("myCanvas");
			var context = flip.getContext ("2d");						
			context.fillStyle = "rgb(255, 0, 0)"; 
        	context.lineWidth="5";
			context.strokeStyle=color; // blue path  
           	context.beginPath();
           	context.moveTo(xStart, yStart);
           	context.lineTo(path[0].x, path[0].y);
			for (var k=1;k<path.length;k++){
				context.moveTo(path[k-1].x, path[k-1].y);
				context.lineTo(path[k].x, path[k].y);
			}                       
           context.stroke();
        }
	}

}


Element.prototype.leftTopScreen = function () {
    var x = this.offsetLeft;
    var y = this.offsetTop;

    var element = this.offsetParent;

    while (element !== null) {
        x = parseInt (x) + parseInt (element.offsetLeft);
        y = parseInt (y) + parseInt (element.offsetTop);

        element = element.offsetParent;
    }

    return new Array (x, y);
}

document.addEventListener ("DOMContentLoaded", function () {
    var flip = document.getElementById ("myCanvas");

    var xy = flip.leftTopScreen ();

    var context = flip.getContext ("2d");

    context.fillStyle = "rgb(255,255,255)";  
    context.lineWidth="5";
	context.strokeStyle="blue"; // blue path 
    context.fillRect (0, 0, 500, 500);

    flip.addEventListener ("mousemove", function (event) {
        var x = event.clientX;
        var y = event.clientY;                    		                    
        //console.log(validpath.toString());
        if(xStart != -1 && yStart != -1 && xFinal != -1 && yFinal != -1){
        	context.clearRect (0, 0, width, height);
        	basePattern();                    
        	drawPattern("blue",x,y);
        	console.log(checkValidPath(validpath,x - xy[0],y - xy[1],10));
            context.beginPath();
            context.moveTo(xFinal, yFinal);
           	context.lineTo(x - xy[0], y - xy[1]);
           	xFinal = path[path.length-1].x; //last point selected
           	yFinal = path[path.length-1].y; //last point selected
           	context.stroke();
        }
    });

    flip.addEventListener ("mousedown", function (event) {
        var x = event.clientX;
        var y = event.clientY;                    
        var check = checkValidPath(validpath,x - xy[0],y - xy[1],10); //threshold of 10px
       
    });
    flip.addEventListener ("mouseup", function (event) {
        var x = event.clientX;
        var y = event.clientY;

        context.fillStyle = "rgb(255, 0, 0)";  
        context.lineWidth="5";
		context.strokeStyle="black"; // blue path         
        //console.log(context.toString());
        hovering[0] = -1; hovering[1] = -1;
        if(xStart != -1 && yStart != -1){
           var pattern = document.getElementById("pattern");
           var patternlen = document.getElementById("patternlength");
           pattern.value = positions;                       
           patternlen.value = cSize;
           context.beginPath();
           context.moveTo(xStart, yStart);
           context.lineTo(x - xy[0], y - xy[1]);
           context.stroke();
           if(isCorrectPath(positions,correctpositions)){
           		context.clearRect (0, 0, width, height);
        		basePattern();                    
        		drawPattern("green",x,y);
           }else{
           		context.clearRect (0, 0, width, height);
        		basePattern();                    
        		drawPattern("red",x,y);
           }

        }
        path = [];
        positions = "";                    
        xStart = yStart = xFinal = yFinal = -1;
    });
    
});  

function changeCanvasSize(newValue)
{
	document.getElementById("valrange").innerHTML="Size => " +newValue+" x "+newValue;
	document.
	validpath = [];
	path = [];
	validpositions = [];
	hovering[0] = -1; hovering[1] = -1;
	xStart = yStart = xFinal = yFinal = -1;
	positions = "";	
	cSize = newValue;			
	addonce = true;
	basePattern();

}           
