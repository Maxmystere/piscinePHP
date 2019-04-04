function drawSmallShip(canvas, ctx, image, x, y) {
	ctx.drawImage(image, 545, 200, 45, 140, x, y, canvas.width / 150 * 1, canvas.height / 100 * 2);
}
function drawMediumShip(canvas, ctx, image, x, y) {
	ctx.drawImage(image, 300, 140, 70, 165, x, y, canvas.width / 150 * 2, canvas.height / 100 * 6);
}
function drawBigShip(canvas, ctx, image, x, y) {
	ctx.drawImage(image, 40, 70, 80, 260, x, y, canvas.width / 150 * 3, canvas.height / 100 * 10);
}

var image = new Image();
image.src = "ships.png";

window.onload = function () {

	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	
	if (typeof board === 'undefined')
	{
		console.log("NOT DEFINED");
		window.location.replace("install.php");
		return ;
	}

	// Draw Pretty lines
	for (var h = canvas.height / 100; h < canvas.height; h += canvas.height / 100) {
		ctx.moveTo(0, h);
		ctx.lineTo(canvas.width, h);
	}
	for (var w = canvas.width / 150; w < canvas.width; w += canvas.width / 150) {
		ctx.moveTo(w, 0);
		ctx.lineTo(w, canvas.height);
	}
	ctx.stroke();

	// Draw from PHP
	for (var ytmp = 0; ytmp < 100; ytmp++) {
		for (var xtmp = 0; xtmp < 150; xtmp++) {
			if (board[ytmp][xtmp] == 1) {
				drawSmallShip(canvas, ctx, image, ytmp * canvas.height / 100, xtmp * (canvas.width / 150));
			}
			else if (board[ytmp][xtmp] == 2) {
				drawMediumShip(canvas, ctx, image, ytmp * canvas.height / 100, xtmp * (canvas.width / 150));
			}
			else if (board[ytmp][xtmp] == 3) {
				drawBigShip(canvas, ctx, image, ytmp * canvas.height / 100, xtmp * (canvas.width / 150));
			}
		}
	}
	
	canvas.addEventListener('click', function (event) {
		var x = event.pageX - event.pageX % (canvas.height / 100);
		var y = event.pageY - event.pageY % (canvas.height / 100);
		drawMediumShip(canvas, ctx, image, x, y);
		console.log("Click x : " + x.toString() + " y : " + y.toString());
	}, false);
}
