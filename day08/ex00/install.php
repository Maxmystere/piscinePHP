<?php
session_start();
require_once 'Board.class.php';
$tmp = new Board();
$_SESSION['board'] = serialize($tmp);
header("Location: /index.php");
?>
