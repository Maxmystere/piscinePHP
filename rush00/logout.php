<?php
session_start();
if (isset($_SESSION['login']))
{
	unset($_SESSION['login']);
	setcookie("panier", serialize(array()), 1);
	header('Location: index.php');
	exit ;
}
?>
