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
	<canvas id="canvas" width="3000" height="2000"></canvas>

	<script type="text/javascript">
	var board = <?PHP $tmp->getJsonBoard(); ?>;
	</script>
	<div class="form-popup" id="myForm">
		<button type="submit" class="btn cancel" onclick="closeForm()">X</button>
		<h2 id="shipnameform">Login</h2>
		<div id="shipposform" align="right">x: 42 y:21</div>
		<div id="shiphpform">42 HP</div>
		<div id="shipspeedform">42 km/h</div>
		<div id="shippowerform">42 PP</div>
		
		<form action="/movement.php" class="form-container">
			<input type='hidden' id='shipposxform' name='posx' value='0' />
			<input type='hidden' id='shipposyform' name='posy' value='0' />
			Moveforward : <select name='move'>
			<?php for ($x = 0; $x <= 5; $x++) {echo "<option value='" . $x . "'>" . $x . "</option>";} ?>
			</select>
			<button type="submit" class="btn">Validate</button>
		</form>
	
	</div>
</body>

</html>
