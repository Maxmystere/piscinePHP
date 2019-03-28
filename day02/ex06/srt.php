#!/usr/bin/php
<?PHP
if ($argc != 2)
	return ;
$line = true;
if (!($file = @fopen($argv[1], "r")))
	return ;
while ($read = (fgets($file)))
{
	$readall = $readall.$read;
}
fclose($file);
$array = explode("\n\n", $readall);
foreach($array as $key => $arr)
{
	$array[$key] = array_filter(explode("\n", $arr));
	$tmp = explode("-->", $array[$key][1]);
	$array[$key]["T"]["START"] = trim($tmp[0]);
	$array[$key]["T"]["END"] = trim($tmp[1]);
	$propre[($array[$key][0])]["TIME"] = $array[$key][1];
	$propre[($array[$key][0])]["SUB"] = $array[$key][2];
	$tmp = explode(":", $array[$key]["T"]["START"]);
	$propre[($array[$key][0])]["VSTART"] = $tmp[0] * 3600 + $tmp[1] * 60 + str_replace(",", ".",$tmp[2]);
	$tmp = explode(":", $array[$key]["T"]["END"]);
	$propre[($array[$key][0])]["VEND"] = $tmp[0] * 3600 + $tmp[1] * 60 + str_replace(",", ".",$tmp[2]);
}
$last = ($array[$key][0]);
unset($array);
$issort = true;
while($issort)
{
	$issort = false;
	$pValue = null;
	$pKey = null;
	foreach($propre as $key => $arr)
	{
		if ($previousValue)
		{
			if ($propre[$pKey]["VEND"] > $propre[$key]["VSTART"])
			{
				$tmp = $propre[$pKey];
				$propre[$pKey] = $propre[$key];
				$propre[$key] = $tmp;
				$issort = true;
			}
		}
		$previousValue = $arr;
		$pKey = $key;
	}
}
$propre[$last]["LAST"] = 1;
foreach($propre as $key => $arr)
{
	print($key."\n".$arr["TIME"]."\n".$arr["SUB"]."\n");
	if (!($arr["LAST"] == 1))
		print("\n");
}
?>
