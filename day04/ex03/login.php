<?PHP
$err = !(session_start());
if (!($tmp = @file_get_contents("../private/passwd")) || !($usersarr = unserialize($tmp)))
	$err = true;
include 'auth.php';
if (!$err)
{
	if ($_GET["login"] && $_GET["passwd"] && auth($_GET["login"], $_GET["passwd"]))
	{
		$_SESSION["loggued_on_user"] = $_GET["login"];
	}
	else
	{
		$_SESSION["loggued_on_user"] = "";
		$err = true;
	}
}
else
	$err = true;
if ($err)
	echo("ERROR\n");
else
	echo("OK\n");
?>
