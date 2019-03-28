#!/usr/bin/php
<?PHP
if ($argc != 3)
	return ;
$line = true;
if (!($file = @fopen($argv[1], "r")))
	return ;
while ($read = trim(fgets($file)))
{
	$array[] = explode(';', $read);
}
fclose($file);
$params = array_shift($array);
if (($sorter = array_search($argv[2], $params)) === false)
	return ;
foreach($array as $val)
{
	$sortarr[] = $val[$sorter];
}
foreach($params as $key => $pname)
{
	//print("$pname\n");
	foreach($array as $arrkey => $val)
	{
		${$pname}[$sortarr[$arrkey]] = $val[$key];
	}
}

while ($line != $EOF)
{
    print("Entrez votre commande: ");
    $handle = fopen("php://stdin","r");
    $line = (fgets($handle));
    $read = trim($line);
    if ($read != $EOF)
    {
		eval($read);
    }
    fclose($handle);
}
?>
