<?php
session_start();
require_once 'Board.class.php';
$board = unserialize($_SESSION['board']);
$ship = $board->getShipAtLocation($_GET);
if ($ship->team != $board->currentplayer) {
	header("Location: /index.php?errorcode=wrongteam");
	exit;
}
$player = $board->getCurrentPlayer();
if (isset($_GET['posx']) && isset($_GET['posy']) && $_GET['move']) {
	$player->move($_GET);
	$_SESSION['board'] = serialize($board);
	header("Location: /index.php");
	exit;
} else if (isset($_GET['posx']) && isset($_GET['posy']) && isset($_GET['rotate'])) {
	if ($_GET['rotate'] == 'left')
		$player->rotateLeft($_GET);
	else if ($_GET['rotate'] == 'right')
		$player->rotateRight($_GET);
	$_SESSION['board'] = serialize($board);
	header("Location: /index.php");
	exit;
}
header("Location: /index.php?errorcode=invalidparameters");
exit;
?>
