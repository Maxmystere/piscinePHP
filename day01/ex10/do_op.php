#!/usr/bin/php
<?PHP
if ($argc == 4)
{
	$nb1 = intval(trim($argv[1]));
	$op = trim($argv[2]);
	$nb2 = intval(trim($argv[3]));
	if ($op == "*")
		print($nb1 * $nb2);
	else if ($op == "/")
		print($nb1 / $nb2);
	else if ($op == "+")
		print($nb1 + $nb2);
	else if ($op == "-")
		print($nb1 - $nb2);
	else if ($op == "%")
		print($nb1 % $nb2);
	print("\n");
}
else
	print("Incorrect Parameters\n");
?>
