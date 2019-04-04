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

	var board = 
	<?PHP
$tmp->getJsonBoard();
?>;
	</script>
	<div class="form-popup" id="myForm">
	<form action="/action_page.php" class="form-container">
		<h2 id="shipnameform">Login</h2>

		<input type="text" placeholder="Enter Email" name="email" required>

		<button type="submit" class="btn">Validate</button>
		<button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
	</form>
	</div>
</body>


</html>
