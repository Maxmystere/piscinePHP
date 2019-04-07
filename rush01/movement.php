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
if ($player != $_SESSION['metoken'])
{
	header("Location: /game.php?errorcode=wrongteam");
	exit;
}
if (isset($_GET['posx']) && isset($_GET['posy']) && $_GET['move']) {
	if ($player->move($_GET))
		$error = true;
	else
		$error = false;
	
		file_put_contents("private/" . $read[$_SESSION['loggued_on_user']]['gamefilename'], serialize($board), LOCK_EX);
	header("Location: /game.php?moved=" . ($error ? "true" : "false"));
	exit;
} else if (isset($_GET['posx']) && isset($_GET['posy']) && isset($_GET['rotate'])) {
	if ($_GET['rotate'] == 'left')
		$player->rotateLeft($_GET);
	else if ($_GET['rotate'] == 'right')
		$player->rotateRight($_GET);

	file_put_contents("private/" . $read[$_SESSION['loggued_on_user']]['gamefilename'], serialize($board), LOCK_EX);
	header("Location: /game.php?rotate=true");
	exit;
}
header("Location: /game.php?errorcode=invalidparameters");
exit;
?>
