function drawSmallShip(canvas, ctx, image, x, y) {
	ctx.drawImage(image, 545, 200, 40, 150, x, y, canvas.width / 150 * 4, canvas.height / 100 * 8);
}

window.onload = function () {

	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	var image = new Image();
	image.src = "ships.png";

	for (var h = canvas.height / 100; h < canvas.height; h += canvas.height / 100) {
		ctx.moveTo(0, h);
		ctx.lineTo(canvas.width, h);
	}
	for (var w = canvas.width / 150; w < canvas.width; w += canvas.width / 150) {
		ctx.moveTo(w, 0);
		ctx.lineTo(w, canvas.height);
	}
	ctx.stroke();

	canvas.addEventListener('click', function (event) {
		var x = event.pageX - event.pageX % (canvas.height / 100);
		var y = event.pageY - event.pageY % (canvas.height / 100);
		drawSmallShip(canvas, ctx, image, x, y);
		console.log("Click x : " + x.toString() + " y : " + y.toString());
	}, false);


	
}
