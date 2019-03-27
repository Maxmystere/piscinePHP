#!/usr/bin/php
<?PHP
$str = trim($argv[1]);
$tab = array_filter(explode(" ", $str));
$tab = array_map("trim", $tab);
$tmp = array_shift($tab);
array_push($tab, $tmp);
$str = implode(" ", $tab);
if ($str)
    print("$str\n");
?>
