#!/usr/bin/php
<?PHP
if ($argc == 2)
{
    $str = trim($argv[1]);
    $tab = array_filter(explode(" ", $str));
    $tab = array_map("trim", $tab);
    $str = implode(" ", $tab);
    print("$str\n");
}
?>
