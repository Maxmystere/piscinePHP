#!/usr/bin/php
<?PHP
$handle = fopen("/var/run/utmpx","r");
while ($read = fgets($handle))
{
	$array[] = $read;
}
fclose($handle);
array_shift($array);
while ($array)
	$read = $read.str_replace('\n', '\n', array_shift($array));
$tab = (array_map('ord', str_split($read)));
$x = 630;
while (count($tab) - $x >= 0)
{
	$tab[count($tab) - $x] = '^';
	$x = $x + 628;
}
$reader = implode(" ", $tab);
$tab = explode('^', $reader);
array_shift($tab);
array_shift($tab);
foreach($tab as $key => $t)
{
	$tab[$key] = explode(" ", $tab[$key]);
	$wres[$key]["USER"] = chr($tab[$key][2]);
	$x = 0;
	while ($x < 32)
	{
		$wres[$key]["USER"] = $wres[$key]["USER"].chr($tab[$key][$x + 3]);
		$x++;
	}
	$wres[$key]["USER"] = trim($wres[$key]["USER"]);
	$wres[$key]["LINE"] = chr($tab[$key][262]);
	$x = 0;
	while ($x < 6)
	{
		$wres[$key]["LINE"] = $wres[$key]["LINE"].chr($tab[$key][$x + 263]);
		$x++;
	}
	$wres[$key]["STATUS"] = ($tab[$key][298] == '7' ? 1 : 0);
	$wres[$key]["WHEN"] = $tab[$key][305] * 16777216 + $tab[$key][304] * 65536 + $tab[$key][303] * 256 + $tab[$key][302];
	$wres[$key]["TERM"] = $tab[$key][296];
	date_default_timezone_set('Europe/Paris');
	setlocale(LC_TIME, 'fr_FR.utf8','fra');
	$wres[$key]["HWHEN"] = strftime("%a %d %H:%M", $wres[$key]["WHEN"]);
}
foreach($wres as $wline)
{
	if ($wline["STATUS"] == 1)
	{
		print($wline["USER"]);
		print("\t");
		print($wline["LINE"]);
		print("\t");
		print($wline["HWHEN"]);
		print("\n");
	}
}
?>
