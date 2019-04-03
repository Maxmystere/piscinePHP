<?php
session_start();
include ("managedb.php");
if (!isset($_GET['fail']) && isset($_POST['submit']))
{
    $submit = $_POST['submit'];
    if ($submit == "OK"){
        $login = $_POST['login'];
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $passconfirm = $_POST['passconfirm'];
        $submit = $_POST['submit'];
        if (!preg_match('/^[a-zA-Z0-9_-]{3,15}$/', $login)){ # On part du principe que la DB est deja créé
            header('Location: create.php?fail=login');
            die;
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            header('Location: create.php?fail=mail');
            die;
        }
        if ($pass !== $passconfirm){
            header('Location: create.php?fail=pass');
            die;
        }
        if (!create_account($login, $pass, $mail)){
            header('Location: create.php?fail=user');
            die;
        }
        if ($submit !== "OK"){ # RECUPERATION ID Crea compte
            header('Location: create.php');
            die;
        }
        $_SESSION['logued_on_user'] = $login;
        header('Location: login.php?account=success');
        exit;
    }
}
?>
<html>

<head>
    <?php include 'includes/head.php' ?>
</head>

<body>
    <?php include 'includes/header.php'?>
    <div class="form_container">
        <form action="create.php" method="post">
            <h2>Création de compte</h2>
            <input type="text" name="login" placeholder="login" required>
            <input type="text" name="mail" placeholder="mail" required>
            <input type="password" name="pass" placeholder="pass" required>
            <input type="password" name="passconfirm" placeholder="passconfirm" required>
            <button type="submit" name="submit" value="OK">Créer son compte</button>
        </form>
        <?
        if (isset($_GET['fail'])){
                switch ($_GET['fail']){
            case login:?>
        <p id="create_fail">Mauvais format login ( entre 3 et 15 char )<p>
            <?break?>
            <?case user:?>
            <p id="create_fail">Login déjà utilisé<p>
            <?break?>
            <?case pass:?>
            <p id="create_fail">Erreur de saisi mot de passe<p>
            <?break?>
            <?case mail:?>
            <p id="create_fail">Entrez un mail valide<p>
            <?break;
        }}?>
    </div>

</body>

</html>
