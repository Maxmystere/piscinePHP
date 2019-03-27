#!/usr/bin/php
<?PHP
if ($argc != 2)
	return ;
$handle = fopen("php://stdin","r");
while ($read = trim(fgets($handle)))
{
	$array[] = explode(';', $read);
}
array_shift($array);
$calc = 0;
$div = 0;
if ($argv[1] == "moyenne")
{
	foreach ($array as $ar)
	{
		if (ctype_digit($ar[1]))
		{
			$calc = $calc + $ar[1];
			$div++;
		}
	}
	print($calc / $div);
	print("\n");
}
else if ($argv[1] == "moyenne_user")
{
	sort($array);
	$name = $array[0][0];
	foreach ($array as $ar)
	{
		if ($ar[0] == $name)
		{
			if (ctype_digit($ar[1]))
			{
				$calc = $calc + $ar[1];
				$div++;
			}
		}
		else
		{
			print("$name:");
			print($calc / $div);
			print("\n");
			$name = $ar[0];
			if (ctype_digit($ar[1]))
			{
				$calc = $ar[1];
				$div = 1;
			}
			else
			{
				$calc = 0;
				$div = 0;
			}
		}
	}
	print("$name:");
	print($calc / $div);
	print("\n");
}
else if ($argv[1] == "ecart_moulinette")
{
	sort($array);
	$name = $array[0][0];
	foreach ($array as $ar)
	{
		if ($ar[0] == $name)
		{
			if ($ar[2] == "moulinette")
			{
				$notemoul = $notemoul + $ar[1];
			}
			else if (ctype_digit($ar[1]))
			{
				$calc = $calc + $ar[1];
				$div++;
			}
		}
		else
		{
			print("$name:");
			print($calc / $div - $notemoul);
			print("\n");
			$name = $ar[0];
			if ($ar[2] == "moulinette")
			{
				$notemoul = $ar[1];
				$calc = 0;
				$div = 0;
			}
			else if (ctype_digit($ar[1]))
			{
				$calc = $ar[1];
				$div = 1;
				$notemoul = 0;
			}
			else
			{
				$calc = 0;
				$div = 0;
				$notemoul = 0;
			}
		}
	}
	print("$name:");
	print($calc / $div);
	print("\n");
}
?>
