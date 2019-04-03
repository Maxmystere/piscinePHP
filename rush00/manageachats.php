<?php
if ("/manageachats.php"== $_SERVER['REQUEST_URI'])
{
    header("Location: /index.php");
    exit;
}
session_start();
include ('manageitems.php');
function list_achats()
{
	$cmdarray = unserialize(file_get_contents('.private/achats'));
	return ($cmdarray);
}
function print_achats_list($array)
{
	$artarray = list_items();
	date_default_timezone_set("Europe/Paris");
	echo "<table>";
	echo "<tr><td>time</td><td>User</td><td>Items</td><td>Total Price</td></tr>";
	foreach($array as $arrkey => $item)
	{
		echo "<tr>";
		foreach($item as $key => $data)
		{
			if ($key == 'totalprice')
				echo "<td>".$data." €</td>";
			else if ($key == 'commandtime')
			{
				echo "<td>".date("j/n/Y H:i", $data)."</td>";
			}
			else if ($key == 'commande')
			{
				echo "<td>";
				foreach($data as $itemid => $quantity)
				{
					echo $artarray[$itemid]["name"].": ".$quantity."<br/>";
				}
				echo "</td>";
			}
			else
				echo "<td>".$data."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
?>
