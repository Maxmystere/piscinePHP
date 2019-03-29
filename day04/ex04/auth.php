<?php
function auth($login, $passwd) {
	if (!$login || !$passwd)
		return (false);
	if (!($tmp = @file_get_contents("../private/passwd")) || !($usersarr = unserialize($tmp)))
		return (false);
	foreach($usersarr as $user)
	{
		if ($user["login"] == $login && $user["passwd"] == hash("sha256", $passwd))
			return (true);
	}
	return (false);
}
?>
