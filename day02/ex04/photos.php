#!/usr/bin/php
<?PHP
if ($argc == 2)
{
	$c = curl_init($argv[1]);

	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	$str = curl_exec($c);
	$tab = explode("\n", $str);
	$tab = preg_grep("/<img.*?>/", $tab);
	if ($tab)
	{
		$path = explode("/", $argv[1]);
		$tab = array_map("trim", $tab);
		if (!file_exists($path[2]))
			mkdir($path[2]);
		foreach($tab as $imgloc)
		{
			$imgloc = substr($imgloc, strpos($imgloc, "src="));
			$tmp = explode("\"", $imgloc);
			if (count($tmp) == 1)
				$tmp = explode("'", $imgloc);
			$imgloc = $tmp[1];
			if (!preg_match("/https{0,1}:\/\//", $imgloc))
				$imgloc = $path[0]."//".$path[2].$imgloc;
			file_put_contents($path[2]."/".(array_pop(explode("/", $imgloc))), file_get_contents($imgloc));
		}
	}
}
?>
