<?php
session_start();
if (preg_match('#/index.php#', $_SERVER['REQUEST_URI'])){
    $isinindex = TRUE;
}
if (isset($_SESSION['login'])){
    $islogued = TRUE;
    if ($_SESSION['login'] == "root")
        $isadmin = TRUE;
    else
        $isadmin = FALSE;
if (isset($_GET['achat'])){
    $achat_done = TRUE;
}
}
if ("/includes/header.php"== $_SERVER['REQUEST_URI'])
{
    header("Location: /index.php");
    exit;
}
?>
<div class="header">
    <img src=".private/img/logo2.jpg" alt="Logo Site">
    <br/>
    <? if($isinindex == FALSE){ ?>
    <a href="index.php">Menu principal</a>
    <? } ?>
    <a href="cart.php">Panier</a>
    <? if ($islogued){ ?>
        <a href="logout.php">Deconnexion</a>
    <? }else{ ?>
        <a href="login.php">Connexion</a>
    <? } ?>
    <? if ($isadmin == TRUE){ ?>
        <a href="users.php">Gestion users</a>
        <a href="achats.php">Gestion achats</a>
        <a href="articles.php">Gestion articles</a>
    <? }else{ ?>
        <a href="articles.php">Tous nos articles</a>
    <? } ?>
    <? if ($achat_done == TRUE){ ?>
        <p style="color: green;">✅  Achat validé Merci 😇</p>
    <? } ?>
 </div>
</div>
