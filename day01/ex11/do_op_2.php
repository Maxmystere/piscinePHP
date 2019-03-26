#!/usr/bin/php
<?PHP
if ($argc == 2)
{
	$str = trim($argv[1]);
	$add = substr_count($str, '+');
	$sub = substr_count($str, '-');
	$mul = substr_count($str, '*');
	$div = substr_count($str, '/');
	$mod = substr_count($str, '%');
	if ($add + $sub + $mul + $div + $mod != 1)
	{
		print("Syntax Error\n");
		return;
	}
	if ($add)
		$tab = array_filter(explode("+", $str));
	else if ($sub)
		$tab = array_filter(explode("-", $str));
	else if ($mul)
		$tab = array_filter(explode("*", $str));
	else if ($div)
		$tab = array_filter(explode("/", $str));
	else if ($mod)
    	$tab = array_filter(explode("%", $str));
	$tab = array_map("trim", $tab);
	if (!ctype_digit($tab[0]) || !ctype_digit($tab[1]))
	{
		print("Syntax Error\n");
		return;
	}
	$nb1 = $tab[0];
	$nb2 = $tab[1];
	if ($add)
		print($nb1 + $nb2);
	else if ($sub)
		print($nb1 - $nb2);
	else if ($mul)
		print($nb1 * $nb2);
	else if ($div)
		print($nb1 / $nb2);
	else if ($mod)
		print($nb1 % $nb2);
	print("\n");
}
else
	print("Incorrect Parameters\n");
?>