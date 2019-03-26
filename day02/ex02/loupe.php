#!/usr/bin/php
<?PHP
if ($argc == 2)
{
	$html = file_get_contents($argv[1]);
	$exp = explode('title', $html);
	if (preg_match("/\s{0,}=/", $exp[3]) > 0)
		print($exp[3]);
	//print_r($exp);
}
?>