<?php
session_start();
require_once 'Board.class.php';

$read = unserialize(file_get_contents("private/games"));
$board = unserialize(file_get_contents("private/" . $read[$_SESSION['loggued_on_user']]['gamefilename']));
$ship = $board->getShipAtLocation($_GET);
if ($ship->team != $board->currentplayer) {
	header("Location: /game.php?errorcode=wrongteam");
	exit;
}
$player = $board->getCurrentPlayer();
if (isset($_GET['posx']) && isset($_GET['posy']) && $_GET['move']) {
	$player->move($_GET);
	$_SESSION['board'] = serialize($board);
	header("Location: /game.php");
	exit;
} else if (isset($_GET['posx']) && isset($_GET['posy']) && isset($_GET['rotate'])) {
	if ($_GET['rotate'] == 'left')
		$player->rotateLeft($_GET);
	else if ($_GET['rotate'] == 'right')
		$player->rotateRight($_GET);
	$_SESSION['board'] = serialize($board);
	header("Location: /game.php");
	exit;
}
header("Location: /game.php?errorcode=invalidparameters");
exit;
?>
