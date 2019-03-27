#!/usr/bin/php
<?PHP
if ($argc == 2)
{
	$html = file_get_contents($argv[1]);
	$exp = explode("title", $html);
	foreach($exp as $exppart)
	{
		if (preg_match("/(<a|=\")(.*?)>(.*?)</", $exppart) > 0)
		{
			unset($nchild);
			$child = explode("\"", $exppart);
			foreach($child as $lilchild)
			{
				if (!preg_match("/[<>]/", $lilchild))
					$lilchild = strtoupper($lilchild);
				$nchild[] = $lilchild;
			}
			$exppart = implode("\"", $nchild);
			$x = 0;
			$in = false;
			while ($exppart[$x])
			{
				if ($exppart[$x] == '>')
					$in = true;
				else if ($exppart[$x] == '<')
					$in = false;
				else if ($in)
					$exppart[$x] = strtoupper($exppart[$x]);
				$x++;
			}
		}
		$newexp[] = $exppart;
	}
	$perfect = implode("title", $newexp);
	print($perfect);
}
?>