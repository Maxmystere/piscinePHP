#!/usr/bin/php
<?PHP
array_shift($argv);
$merge = array();
foreach ($argv as $av)
{
    $tab = array_filter(explode(" ", trim($av)));
    $tab = array_map("trim", $tab);
    $merge = array_merge($merge, $tab);
    sort($merge);
}
foreach ($merge as $my)
    print("$my\n");
?>