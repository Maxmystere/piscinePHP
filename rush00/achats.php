<?php
session_start();
include ('managecookie.php');
include ('manageachats.php');
$login = $_SESSION['login'];
if ($login !== 'root'){
    header("Location: index.php");
    exit;
}
?>

<html>
<head>
    <?php include 'includes/head.php' ?>
</head>

<body>
	<?php include 'includes/header.php';
	print_achats_list(list_achats());
	?>
</body>
</html>
