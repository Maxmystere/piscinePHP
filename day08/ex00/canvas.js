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
				if (board[ytmp][xtmp]['imgid'] != 0) {
					board[ytmp][xtmp]['realshipx'] = xtmp;
					board[ytmp][xtmp]['realshipy'] = ytmp;
					for (var lily = 0; lily < board[ytmp][xtmp]['width']; lily++) {
						for (var lilx = 0; lilx < board[ytmp][xtmp]['length']; lilx++) {
							if (lily || lilx) {
								console.log(lily + ' ' + lilx);
								board[ytmp + lily][xtmp + lilx] = JSON.parse( JSON.stringify((board[ytmp][xtmp])));
								board[ytmp + lily][xtmp + lilx]['imgid'] = 0;
								board[ytmp + lily][xtmp + lilx]['realshipx'] = xtmp;
								board[ytmp + lily][xtmp + lilx]['realshipy'] = ytmp;
							}
						}
					}
				}
				if (board[ytmp][xtmp]['imgid'] == 1) {
					drawSmallShip(canvas, ctx, image, ytmp * canvas.height / 100, xtmp * (canvas.width / 150));
				}
				else if (board[ytmp][xtmp]['imgid'] == 2) {
					drawMediumShip(canvas, ctx, image, ytmp * canvas.height / 100, xtmp * (canvas.width / 150));
				}
				else if (board[ytmp][xtmp]['imgid'] == 3) {
					drawBigShip(canvas, ctx, image, ytmp * canvas.height / 100, xtmp * (canvas.width / 150));
				}
			}
		}
	}

	canvas.addEventListener('click', function (event) {
		var x = event.pageX - event.pageX % (canvas.height / 100);
		var y = event.pageY - event.pageY % (canvas.height / 100);
		var curx = x / (canvas.height / 100);
		var cury = y / (canvas.width / 150);
		console.log(board[curx][cury]);
		//drawMediumShip(canvas, ctx, image, x, y);
		console.log("Click x : " + curx + " y : " + cury);
		if (board[curx][cury]) {
			var tmp = board[curx][cury];
			document.getElementById("myForm").style.display = "block";
			document.getElementById("shipnameform").innerHTML = tmp['name'];
			document.getElementById("shiphpform").innerHTML = tmp['hp'] + " / " + tmp['maxhp']  + " HP";
			document.getElementById("shipspeedform").innerHTML = tmp['speed'] + " km/h";
			document.getElementById("shippowerform").innerHTML = tmp['pp'] + " PP";
			document.getElementById('shipposform').innerHTML = "x: " + tmp['realshipx'] + " y: " + tmp['realshipy'];
			document.getElementById('shipposxform').value = tmp['realshipx'];
			document.getElementById('shipposyform').value = tmp['realshipy'];
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
