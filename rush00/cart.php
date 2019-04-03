<?php
session_start();
?>
<html>

<head>
    <?php include 'includes/head.php' ?>
</head>

<body>
    <?php include 'includes/header.php' ?>
    <?php if (isset($_SESSION['login'])){ ?>
    <a style="color:red;"href="validate.php?achat=1">Valider la commande✅</a>
    <?php } ?>
    <?php if (!isset($_SESSION['login'])){ ?>
    <a style="color:red;"href="create.php">Crée un compte pour valider la commande✅</a>
    <?php } ?>
    <iframe id="panierUser" width="100%" height="50%" title="Panier User" src="panier.php"/>
</body>
</html>
