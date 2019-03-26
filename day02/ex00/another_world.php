#!/usr/bin/php
<?PHP
if ($argc > 1)
{
	print(preg_replace('/[\t]/', ' ', $argv[1]));
	print("\n");
}
?>