#!/usr/bin/php
<?PHP
array_shift($argv);
$srh = trim(array_shift($argv));
foreach ($argv as $av)
{
	$tmp = explode(":", $av);
	$tmp = array_map("trim", $tmp);
	if ($tmp[0] == $srh)
	{
		$rtn = $tmp[1];
	}
}
if ($rtn)
	print("$rtn\n");
?>
