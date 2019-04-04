<?php session_start();
require_once 'Board.class.php';
$tmp = unserialize($_SESSION['board']);
if (!$tmp) {
	header("Location: /install.php");
	exit;
}
?>
<html>
<head>
	
	<html lang="en">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="index.css" />
	<script type="text/javascript" src="canvas.js"></script>
	<title>Warhammer 40K</title>
</head>
<body>
	<canvas id="canvas" width="6000" height="4000"></canvas>

	<script type="text/javascript">
	var board = <?PHP $tmp->getJsonBoard(); ?>;
	</script>
	<div class="form-popup" id="myForm">
		<button type="submit" class="btn cancel" onclick="closeForm()">X</button>
		<h2 id="shipnameform">Login</h2>
		<div id="shipposform" align="right">x: 42 y:21</div>
		<div id="shiphpform">42 HP</div>
		<div id="shippowerform">42 PP</div>
		<div id="shipspeedform">42 km/h</div>
		
		<form action="/movement.php" class="form-container">
			<input type='hidden' id='shipposxform' name='posx' value='0' />
			<input type='hidden' id='shipposyform' name='posy' value='0' />
			<input type='hidden' id='shipidform' name='id' value='-1' />
			Moveforward : <input type='number' id='move' name='move' value='0' min="0" />
			<button type="submit" class="btn">Ziouu</button>
		</form>
		<button type="button" onclick="location.href='/movement.php?rotate=left&id='
			+ document.getElementById('shipidform').value + '&posx='
			+ document.getElementById('shipposxform').value + '&posy='
			+ document.getElementById('shipposyform').value;">Rotate Left</button>
		<button type="button" onclick="location.href='/movement.php?rotate=right&id='
			+ document.getElementById('shipidform').value + '&posx='
			+ document.getElementById('shipposxform').value + '&posy='
			+ document.getElementById('shipposyform').value;">Rotate Right</button>
	</div>
</body>

</html>
