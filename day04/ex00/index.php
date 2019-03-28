<?PHP
session_start();
if ($_GET["submit"] == "OK")
{
	$_SESSION["login"] = $_GET["login"];
	$_SESSION["passwd"] = $_GET["passwd"];
}
echo "<html><body>\n";
echo "<form>\n";
echo "Identifiant: <input type='text' name='login' value='".$_SESSION["login"]."' />\n";
echo "<br />\n";
echo "Mot de passe: <input type='password' name='passwd' value='".$_SESSION["passwd"]."' />\n";
echo "<input type='submit' name='submit' value='OK' />\n";
echo "</form>\n";
echo "</body></html>\n";
?>
