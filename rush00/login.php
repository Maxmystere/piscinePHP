<?php
session_start();
if (isset($_SESSION['login'])){
	header('Location: index.php');
	exit;
}
include ('managedb.php');
if ($_POST['submit'] == "OK")
{
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	if (auth($login, $passwd) == TRUE)
	{
		$_SESSION['login'] = $login;
		if ($_SESSION['upanier'])
			setcookie("panier", $_SESSION['upanier'], time() + 86400);
		else
			$_SESSION['upanier'] = $_COOKIE["panier"];
		header("Location: index.php");
		exit;
	}
	else
	   header("Location: login.php?log=echec");
}
$title = "Login page";
?>
<html>

<head>
	<?php include 'includes/head.php' ?>
</head>

<body>
	<?php include 'includes/header.php' ?>
	<div>
		<div class="form_container">
			<h2>Login</h2>
			<form action="login.php" method="post">
				<input type="text" name="login" placeholder="login">
				<input type="password" name="passwd" placeholder="pass">
				<button type="submit" name="submit" value="OK">Connexion</button>
				<a href="create.php">Créer un compte</a>
			</form>
			<? if ($_GET['account'] == 'success'){?>
			<p id="success_msg">Compte crée avec succés</p>
			<? } ?>
			<? if ($_GET['account'] == 'echec' ){?>
			<p id="echec_msg">Compte crée avec succés </p>
			<? }?>
		</div>
	</div>
</body>

</html>
