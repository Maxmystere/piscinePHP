function drawSmallShip(canvas, ctx, image, x, y, rot, witdh, length, boardWidth, boardHeight) {
	if (rot == 1)
		ctx.drawImage(image, 39, 271, 53, 141, x, y, canvas.width / boardWidth * witdh, canvas.height / boardHeight * length);
	else if (rot == 2)
		ctx.drawImage(image, 168, 340, 141, 53, x, y, canvas.width / boardWidth * length, canvas.height / boardHeight * witdh);
	else if (rot == 3)
		ctx.drawImage(image, 309, 340, 53, 141, x, y, canvas.width / boardWidth * witdh, canvas.height / boardHeight * length);
	else if (rot == 4)
		ctx.drawImage(image, 168, 393, 141, 53, x, y, canvas.width / boardWidth * length, canvas.height / boardHeight * witdh);
}
function drawMediumShip(canvas, ctx, image, x, y, rot, witdh, length, boardWidth, boardHeight) {
	if (rot == 1)
		ctx.drawImage(image, 92, 188, 76, 196, x, y, canvas.width / boardWidth * witdh, canvas.height / boardHeight * length);
	else if (rot == 2)
		ctx.drawImage(image, 168, 188, 196, 76, x, y, canvas.width / boardWidth * length, canvas.height / boardHeight * witdh);
	else if (rot == 3)
		ctx.drawImage(image, 364, 271, 76, 196, x, y, canvas.width / boardWidth * witdh, canvas.height / boardHeight * length);
	else if (rot == 4)
		ctx.drawImage(image, 168, 264, 196, 76, x, y, canvas.width / boardWidth * length, canvas.height / boardHeight * witdh);
}
function drawBigShip(canvas, ctx, image, x, y, rot, witdh, length, boardWidth, boardHeight) {
	if (rot == 1)
		ctx.drawImage(image, 0, 0, 92, 271, x, y, canvas.width / boardWidth * witdh, canvas.height / boardHeight * length);
	else if (rot == 2)
		ctx.drawImage(image, 92, 0, 272, 93, x, y, canvas.width / boardWidth * length, canvas.height / boardHeight * witdh);
	else if (rot == 3)
		ctx.drawImage(image, 364, 0, 93, 271, x, y, canvas.width / boardWidth * witdh, canvas.height / boardHeight * length);
	else if (rot == 4)
		ctx.drawImage(image, 92, 93, 272, 95, x, y, canvas.width / boardWidth * length, canvas.height / boardHeight * witdh);
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

	var boardHeight = board.length;
	var boardWidth = board[0].length;
	console.log("Board x: " + boardWidth + " y: " + boardHeight);

	function fetchHeader(url, wch) {
		try {
			var req = new XMLHttpRequest();
			req.open("HEAD", url, false);
			req.send(null);
			if(req.status== 200)
			{
				return req.getResponseHeader(wch);
			}
			else return false;
		} catch(er) {
			return er.message;
		}
	}
	
	console.log(fetchHeader(window.location.href,'Last-Modified'));



	// Draw Pretty lines
	for (var h = canvas.height / boardHeight; h < canvas.height; h += canvas.height / boardHeight) {
		ctx.moveTo(0, h);
		ctx.lineTo(canvas.width, h);
	}
	for (var w = canvas.width / boardWidth; w < canvas.width; w += canvas.width / boardWidth) {
		ctx.moveTo(w, 0);
		ctx.lineTo(w, canvas.height);
	}
	ctx.stroke();

	canvas.addEventListener('click', function (event) {
		var x = event.pageX - event.pageX % (canvas.height / boardHeight);
		var y = event.pageY - event.pageY % (canvas.height / boardHeight);
		var curx = Math.round(x / (canvas.height / boardHeight));
		var cury = Math.round(y / (canvas.width / boardWidth));
		//drawSmallShip(canvas, ctx, image, x, y, 4);
		console.log("Click x : " + curx + " y : " + cury);
		console.log(board[cury][curx]);
		if (board[cury][curx]) {
			var tmp = board[board[cury][curx]['y']][board[cury][curx]['x']];
			document.getElementById("myForm").style.display = "block";
			document.getElementById("shipnameform").innerHTML = tmp['name'];
			document.getElementById("shiphpform").innerHTML = tmp['hp'] + " / " + tmp['maxhp'] + " HP";
			document.getElementById("shippowerform").innerHTML = tmp['pp'] + " / " + tmp['maxpp'] + " PP";
			document.getElementById("shipspeedform").innerHTML = tmp['speed'] + " km/h";
			document.getElementById('shipposform').innerHTML = "x: " + tmp['x'] + " y: " + tmp['y'] + " team: " + tmp['team'] + " id: " + tmp['id'];
			document.getElementById('shipposxform').value = tmp['x'];
			document.getElementById('shipposyform').value = tmp['y'];
			document.getElementById('shipidform').value = tmp['id'];
		}
		else {
			document.getElementById("myForm").style.display = "none";
		}
	}, false);


	// Draw from PHP
	for (var ytmp = 0; ytmp < boardHeight; ytmp++) {
		for (var xtmp = 0; xtmp < boardWidth; xtmp++) {
			if (board[ytmp][xtmp] && board[ytmp][xtmp].hasOwnProperty('imgid')) {
				if (board[ytmp][xtmp]['imgid'] != 0) {
					if (board[ytmp][xtmp]['rot'] == 2)
						var boardx = (xtmp - board[ytmp][xtmp]['length'] + 1) * (canvas.width / boardWidth);
					else
						var boardx = (xtmp - (board[ytmp][xtmp]['rot'] == 3) * (board[ytmp][xtmp]['width'] - 1)) * (canvas.width / boardWidth);
					if (board[ytmp][xtmp]['rot'] == 3)
						var boardy = (ytmp - board[ytmp][xtmp]['length'] + 1) * (canvas.height / boardHeight);
					else
						var boardy = (ytmp - (board[ytmp][xtmp]['rot'] == 4) * (board[ytmp][xtmp]['width'] - 1)) * (canvas.height / boardHeight);
				}
				if (board[ytmp][xtmp]['imgid'] == 1) {
					drawSmallShip(canvas, ctx,
						(board[ytmp][xtmp]['team'] == 1 ? image : image2),
						boardx,
						boardy,
						board[ytmp][xtmp]['rot'],
						board[ytmp][xtmp]['width'],
						board[ytmp][xtmp]['length'],
						boardWidth,
						boardHeight);
				}
				else if (board[ytmp][xtmp]['imgid'] == 2) {
					drawMediumShip(canvas, ctx,
						(board[ytmp][xtmp]['team'] == 1 ? image : image2),
						boardx,
						boardy,
						board[ytmp][xtmp]['rot'],
						board[ytmp][xtmp]['width'],
						board[ytmp][xtmp]['length'],
						boardWidth,
						boardHeight);
				}
				else if (board[ytmp][xtmp]['imgid'] == 3) {
					drawBigShip(canvas, ctx,
						(board[ytmp][xtmp]['team'] == 1 ? image : image2),
						boardx,
						boardy,
						board[ytmp][xtmp]['rot'],
						board[ytmp][xtmp]['width'],
						board[ytmp][xtmp]['length'],
						boardWidth,
						boardHeight);
				}
			}
		}
	}


}

function closeForm() {
	document.getElementById("myForm").style.display = "none";
}
