<?PHP
$err = false;

if (!($tmp = @file_get_contents("../private/passwd")) || !($usersarr = unserialize($tmp)))
	$err = true;

if (!$err && $_POST["submit"] == "OK")
{
	if ($_POST["login"] && $_POST["oldpw"] && $_POST["newpw"])
	{
		$fkey = 0;
		foreach($usersarr as $key => $user)
		{
			if ($user["login"] == $_POST["login"])
				$fkey = $key;
		}
		if ($fkey !== false)
		{
			if (hash("sha256", $_POST["oldpw"]) == $usersarr[$fkey]["passwd"])
			{
				$usersarr[$fkey]["passwd"] = hash("sha256", $_POST["newpw"]);
			}
			else
				$err = true;
		}
		else
			$err = true;
	}
	else
		$err = true;
}
else
	$err = true;
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
