<?php
if ("/managecookie.php"== $_SERVER['REQUEST_URI'])
{
    header("Location: /index.php");
    exit;
}
function cookie_add_item($data, $quantity)
{
	if ($_COOKIE["panier"])
		$arr = unserialize($_COOKIE["panier"]);
	else
		$arr = array();
	$arr[$data] = $arr[$data] + $quantity;
	$data = serialize($arr);
	setcookie("panier", $data, time() + 86400);
	if (isset($_SESSION['login']))
		$_SESSION['upanier'] = $data;
}
function cookie_update_item($data, $quantity)
{
	if ($_COOKIE["panier"])
		$arr = unserialize($_COOKIE["panier"]);
	else
		$arr = array();
	$arr[$data] = $quantity;
	$data = serialize($arr);
	setcookie("panier", $data, time() + 86400);
	if (isset($_SESSION['login']))
		$_SESSION['upanier'] = $data;
}
function cookie_rm_item($data)
{
	if (!$_COOKIE["panier"])
		return false;
	$arr = unserialize($_COOKIE["panier"]);
	unset($arr[$data]);
	$data = serialize($arr);
	setcookie("panier", $data, time() + 86400);
	if (isset($_SESSION['login']))
		$_SESSION['upanier'] = $data;
}
function cookie_get_items()
{
	if ($_COOKIE["panier"])
		return (unserialize($_COOKIE["panier"]));
	else
		return (array());
}
function cookie_calculate_price()
{
	$artarray = unserialize(file_get_contents('.private/articles'));
	$cookie = cookie_get_items();
	$price = 0;
	foreach ($cookie as $key => $quantity)
	{
		for ($x = 0; $x < $quantity ; $x++)
			$price = $price + $artarray[$key]["price"];
	}
	return ($price);
}
function cookie_items_reset()
{
	setcookie("panier", serialize(array()), 1);
	if (isset($_SESSION['login']))
		unset($_SESSION['upanier']);
}
if ($_POST["submit"] == "ADD")
{
	cookie_add_item($_POST["key"], $_POST["quantity"]);
	header("Location: panier.php");
}
else if ($_POST["request"] == "MOD")
{
	cookie_update_item($_POST["key"], $_POST["quantity"]);
	header("Location: panier.php");
}
else if ($_POST["submit"] == "DEL")
{
	cookie_rm_item($_POST["key"]);
	header("Location: panier.php");
}
?>
