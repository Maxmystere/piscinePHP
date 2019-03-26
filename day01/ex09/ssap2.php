#!/usr/bin/php
<?PHP
array_shift($argv);
$merge = array();
foreach ($argv as $av)
{
    $tab = array_filter(explode(" ", trim($av)));
    $tab = array_map("trim", $tab);
    $merge = array_merge($merge, $tab);
	natcasesort($merge);
}
$issort = true;
while ($issort)
{
	$issort = false;
	$x = 0;
	while ($merge[$x] && $merge[$x + 1])
	{
		$merge = array_values($merge);
		if (((ctype_digit($merge[$x])) && ctype_alpha($merge[$x + 1])) || (!ctype_alnum($merge[$x]) && ctype_alnum($merge[$x + 1])))
		{
			$tmp = $merge[$x];
			$merge[$x] = $merge[$x + 1];
			$merge[$x + 1] = $tmp;
			$issort = true;
		}
		if (ctype_digit($merge[$x]) && ctype_digit($merge[$x + 1]) && strcmp($merge[$x], $merge[$x + 1]) > 0)
		{
			$tmp = $merge[$x];
			$merge[$x] = $merge[$x + 1];
			$merge[$x + 1] = $tmp;
			$issort = true;
		}
		$merge = array_values($merge);
		$x++;
	}
}
foreach ($merge as $my)
{
	print("$my\tdigit : ");
	print(ctype_digit($my));
	print("\talpha : ");
	print(ctype_alpha($my));
	print("\talnum : ");
	print(ctype_alnum($my));
	print("\n");
}
print_r($merge);
?>