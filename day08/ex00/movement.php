<?php
session_start();
require_once 'Board.class.php';
$board = unserialize($_SESSION['board']);
if (!isset($_GET['posx']) || !isset($_GET['posy']) || !$_GET['move'] )
{
	header("Location: /index.php?errorcode=invalidparameters");
	exit;
}
$ship = $board->getShipAtLocation($_GET);
if ($ship->team != $board->currentplayer)
{
	header("Location: /index.php?errorcode=wrongteam");
	exit;
}
$player = $board->getCurrentPlayer();
$player->move($_GET);

//print_r($player->move($_GET));

$_SESSION['board'] = serialize($board);
//header("Location: /index.php");
//exit;
?>
