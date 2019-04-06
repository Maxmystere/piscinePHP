<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>42 Battlenet</title>
	<link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
	<div class="menu">
	    <ul>
           <li class="logo" ><a style="padding:12px;" href="/index.php"><img class="logo" src="/img/42.png"/>Battlenet</a> <li>
            <?php if(isset($_SESSION['loggued_on_user'])) {
                
                echo "<li><a href='/login/logout.php'>Se d&eacuteconnecter</a></li>";
                echo "<li><a>Bonjour ".$_SESSION['loggued_on_user']."</a></li>";
			} else {
				echo "<li><a href='/login/create.php'>Cr&eacuteer un compte</a></li>";
				echo "<li><a href='/login/login.php'>Se connecter</a></li><br/>";
			} ?>
		</ul>
    </div>
