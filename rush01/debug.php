<?php
session_start();
require_once 'Board.class.php';
$tmp = unserialize($_SESSION['board']);
print_r($tmp->getcurrentplayer());
?>
