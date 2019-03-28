<?PHP
if ($_SERVER["PHP_AUTH_USER"] == "zaz" && $_SERVER["PHP_AUTH_PW"] == "jaimelespetitsponeys")
{
	echo "<html><body>\n";
	echo "Bonjour Zaz<br />\n";
	echo "<img src='data:image/png;base64,".base64_encode(file_get_contents("../img/42.png"))."'>\n";
}
else
{
	//header("HTTP 1.0 assume close after body");
	header("HTTP/1.1 401 Unauthorized");
	echo "<html><body>Cette zone est accessible uniquement aux membres du site";
}
echo "</body></html>\n";
?>
