<?php
session_start();
include 'managecookie.php';
include 'manageitems.php';
function show_panier()
{
    $list_items = cookie_get_items();
    $items_array = list_items();
    if (!$list_items){
        echo "Ho non le panier est vide :(";
        exit;
    }   
    echo "<table border='1' width='100%'>";
    foreach($list_items as $key => $quantity)
    {
        echo "<tr>";
		echo "<td><img src='".$items_array[$key]["picpath"]."' alt='".$items_array[$key]["picpath"]."' height='50' width'50'/></td>";
        echo "<td>".$items_array[$key]["name"]."</td>";
        echo "<td>";
        echo "<form action='./managecookie.php' method='POST'>";
        echo "<input type='hidden' name='key' value='".$key."' />";
        echo "<input type='hidden' name='request' value='MOD' />";
        echo "<select name='quantity' onchange='if(this.value != ".$quantity.") { this.form.submit(); }'>";
        for ($x = 1; $x <= 10; $x++)
        {
            if ($x == $quantity)
                echo "<option selected='selected' value='".$x."'>".$x."</option>";
            else
                echo "<option value='".$x."'>".$x."</option>";
        }
        echo "</select>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form action='./managecookie.php' method='POST'>";
        echo "<input type='hidden' name='key' value='".$key."' />";
        echo "<input type='submit' name='submit' value='DEL' />";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
include 'includes/head.php';
if (isset($_SESSION['login']))
{
    $_SESSION['upanier'] = $_COOKIE["panier"];
    show_panier();
}
if (!isset($_SESSION['login']))
{
    show_panier(); 
}
?>
