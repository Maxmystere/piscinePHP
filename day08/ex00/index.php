<?php session_start();
require_once 'Board.class.php';
$tmp = unserialize($_SESSION['board']);
if (!$tmp)
{
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
</body>


</html>
