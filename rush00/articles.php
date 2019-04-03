<?php
session_start();
include ('managedb.php');
include ('manageitems.php');
$login = $_SESSION['login'];
$items_array = list_items();
?>
<html>

<head>
    <?php include 'includes/head.php' ?>
</head>

<body>
    <?php include 'includes/header.php' ?>
    <?php print_item_list($items_array, $login == 'root'); ?>
</body>

</html>
