<?php
if ("/validate.php"== $_SERVER['REQUEST_URI'])
{
    header("Location: /index.php");
    exit;
}
session_start();
include ('managecookie.php');
include ('manageachats.php');

if (isset($_GET['achat']) && ($_GET['achat'] == 1))
{
	$cmdarray = list_achats();
	$artarray = list_items();
	$cookie = cookie_get_items();
	$newitem["commandtime"] = time();
	$newitem["username"] = $_SESSION['login'];
	$newitem["commande"] = $cookie;
	$newitem["totalprice"] = cookie_calculate_price();
	if ($newitem["totalprice"] > 0)
	{
		$cmdarray[] = $newitem;
		file_put_contents('.private/achats', serialize($cmdarray), LOCK_EX);
		cookie_items_reset();
		header("Location: index.php?achat=valide");
	}
	else
		header("Location: index.php?pasachat=erreur");
}
?>
