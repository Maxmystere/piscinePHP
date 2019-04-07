<?php session_start();
require_once 'Board.class.php';
$read = unserialize(file_get_contents("private/games"));
$tmp = unserialize(file_get_contents("private/" . $read[$_SESSION['loggued_on_user']]['gamefilename']));
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
	<canvas id="canvas" width="1200" height="1200"></canvas>

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
			Move : <input type='number' id='move' name='move' value='1'/>
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
		<button type="button" onclick="location.href='/movement.php?shoot=forward&id='
			+ document.getElementById('shipidform').value + '&posx='
			+ document.getElementById('shipposxform').value + '&posy='
			+ document.getElementById('shipposyform').value;">Shoot Forward</button>
	</div>
	<div class="stat-popup" id="myStats">
	<button type="button" onclick="location.href='/install.php';">Restart</button>
		<h2 id="currentplayerstat">Login-id</h2>
		<div id="ppleftstat">data</div>
	</div>
	<script type="text/javascript">
		var statstab = <?PHP $tmp->getCurrentStats(); ?>;
		document.getElementById('currentplayerstat').innerHTML = "player" + statstab['currentp'];
		document.getElementById('ppleftstat').innerHTML = "PP left " + statstab['ppleft'];
	</script>
</body>

</html>
