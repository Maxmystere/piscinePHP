<?php
session_start();
require_once 'Board.class.php';
$tmp = unserialize($_SESSION['board']);
if (!isset($_GET['posx']) || !isset($_GET['posy']) || !$_GET['move'] )
{
	header("Location: /index.php?errorcode=invalidparameters");
	exit;
}
$ship = $tmp->getShipAtLocation($_GET);
print_r($ship->move($_GET));
?>
