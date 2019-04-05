function drawSmallShip(canvas, ctx, image, x, y, rot) {
	if (rot == 1)
		ctx.drawImage(image, 39, 271, 53, 141, x, y, canvas.width / 150 * 1, canvas.height / 100 * 2);
	else if (rot == 2)
		ctx.drawImage(image, 168, 340, 141, 53, x, y, canvas.width / 150 * 2, canvas.height / 100 * 1);
	else if (rot == 3)
		ctx.drawImage(image, 309, 340, 53, 141, x, y, canvas.width / 150 * 1, canvas.height / 100 * 2);
	else if (rot == 4)
		ctx.drawImage(image, 168, 393, 141, 53, x, y, canvas.width / 150 * 2, canvas.height / 100 * 1);
}
function drawMediumShip(canvas, ctx, image, x, y, rot) {
	if (rot == 1)
		ctx.drawImage(image, 92, 188, 76, 196, x, y, canvas.width / 150 * 2, canvas.height / 100 * 6);
	else if (rot == 2)
		ctx.drawImage(image, 168, 188, 196, 76, x, y, canvas.width / 150 * 6, canvas.height / 100 * 2);
	else if (rot == 3)
		ctx.drawImage(image, 364, 271, 76, 196, x, y, canvas.width / 150 * 2, canvas.height / 100 * 6);
	else if (rot == 4)
		ctx.drawImage(image, 168, 264, 196, 76, x, y, canvas.width / 150 * 6, canvas.height / 100 * 2);
}
function drawBigShip(canvas, ctx, image, x, y, rot) {
	if (rot == 1)
		ctx.drawImage(image, 0, 0, 92, 271, x, y, canvas.width / 150 * 3, canvas.height / 100 * 10);
	else if (rot == 2)
		ctx.drawImage(image, 92, 0, 272, 93, x, y, canvas.width / 150 * 10, canvas.height / 100 * 3);
	else if (rot == 3)
		ctx.drawImage(image, 364, 0, 93, 271, x, y, canvas.width / 150 * 3, canvas.height / 100 * 10);
	else if (rot == 4)
		ctx.drawImage(image, 92, 93, 272, 95, x, y, canvas.width / 150 * 10, canvas.height / 100 * 3);
}

var image = new Image();
image.src = "ships.png";
var image2 = new Image();
image2.src = "ships2.png";

window.onload = function () {

	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");

	if (typeof board === 'undefined') {
		console.log("NOT DEFINED");
		window.location.replace("install.php");
		return;
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
			if (board[ytmp][xtmp] == 0) {
			}
			else {
				if (board[ytmp][xtmp]['imgid'] != 0) {/*
					for (var lily = 0; lily < board[ytmp][xtmp]['width']; lily++) {
						for (var lilx = 0; lilx < board[ytmp][xtmp]['length']; lilx++) {
							if (lily || lilx) {
								board[ytmp + lily][xtmp + lilx] = JSON.parse( JSON.stringify((board[ytmp][xtmp])));
								board[ytmp + lily][xtmp + lilx]['imgid'] = 0;
							}
						}
					}*/
					if (board[ytmp][xtmp]['rot'] == 2)
						var boardx = (xtmp - board[ytmp][xtmp]['width'] + 1) * (canvas.width / 150);
					else
						var boardx = xtmp * (canvas.width / 150);
					if (board[ytmp][xtmp]['rot'] == 3)
						var boardy = (ytmp - board[ytmp][xtmp]['length'] + 1) * (canvas.height / 100);
					else
						var boardy = ytmp * (canvas.height / 100);
				}
				if (board[ytmp][xtmp]['imgid'] == 1) {
					drawSmallShip(canvas, ctx,
						(board[ytmp][xtmp]['team'] == 1 ? image : image2),
						boardx,
						boardy,
						board[ytmp][xtmp]['rot']);
				}
				else if (board[ytmp][xtmp]['imgid'] == 2) {
					drawMediumShip(canvas, ctx,
						(board[ytmp][xtmp]['team'] == 1 ? image : image2),
						boardx,
						boardy,
						board[ytmp][xtmp]['rot']);
				}
				else if (board[ytmp][xtmp]['imgid'] == 3) {
					drawBigShip(canvas, ctx,
						(board[ytmp][xtmp]['team'] == 1 ? image : image2),
						boardx,
						boardy,
						board[ytmp][xtmp]['rot']);
				}
			}
		}
	}

	canvas.addEventListener('click', function (event) {
		var x = event.pageX - event.pageX % (canvas.height / 100);
		var y = event.pageY - event.pageY % (canvas.height / 100);
		var curx = x / (canvas.height / 100);
		var cury = y / (canvas.width / 150);
		console.log(board[cury][curx]);
		//drawSmallShip(canvas, ctx, image, x, y, 4);
		//console.log("Click x : " + curx + " y : " + cury);
		if (board[cury][curx]) {
			var tmp = board[cury][curx];
			document.getElementById("myForm").style.display = "block";
			document.getElementById("shipnameform").innerHTML = tmp['name'];
			document.getElementById("shiphpform").innerHTML = tmp['hp'] + " / " + tmp['maxhp']  + " HP";
			document.getElementById("shippowerform").innerHTML = tmp['pp'] + " / " + tmp['maxpp']  + " PP";
			document.getElementById("shipspeedform").innerHTML = tmp['speed'] + " km/h";
			document.getElementById('shipposform').innerHTML = "x: " + tmp['x'] + " y: " + tmp['y'] + " team: " + tmp['team'] + " id: " + tmp['id'];
			document.getElementById('shipposxform').value = tmp['x'];
			document.getElementById('shipposyform').value = tmp['y'];
			document.getElementById('shipidform').value = tmp['id'];
		}
		else
		{
			document.getElementById("myForm").style.display = "none";
		}
	}, false);
}

function closeForm() {
	document.getElementById("myForm").style.display = "none";
  }
