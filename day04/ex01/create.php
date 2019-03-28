<?PHP
$err = false;
if (!(file_exists("../private")))
	if (!(mkdir("../private")))
		$err = true;
if (!$err && !(file_exists("../private/passwd")))
	if (file_put_contents("../private/passwd", "a:0:{}") == false)
		$err = true;

$usersarr = unserialize(file_get_contents("../private/passwd"));

if (!$err && $_POST["submit"] == "OK")
{
	if ($_POST["login"] && $_POST["passwd"])
	{
		foreach($usersarr as $user)
		{
			if ($user["login"] == $_POST["login"])
				$err = true;
		}
		if (!$err)
		{
			$newuser["login"] = $_POST["login"];
			$newuser["passwd"] = hash("sha256", $_POST["passwd"]);
			$usersarr[] = $newuser;
		}
	}
	else
		$err = true;
}
if (!$err)
{
	if (file_put_contents("../private/passwd", serialize($usersarr)) == false)
		$err = true;
}
if ($err)
	echo("ERROR\n");
else
	echo("OK\n");
?>
