<?php 
session_start();
include "auth.php";
foreach($_POST as $value) {
	$value = htmlspecialchars($value);
}

if (isset($_POST['login']) && isset($_POST['passwd']) && auth($_POST['login'], $_POST['passwd'])) {
    $_SESSION['loggued_on_user'] = $_POST['login'];
    header("Location: /index.php");
} else if (isset($_POST['login']) && isset($_POST['passwd'])) {
    echo "Erreur de connexion.\n";
}
include "../header.php";
?>
<form class="lform" method="POST" action="login.php">
    <h1>Connexion &agrave 42Battlenet</h1>
    <p>Identifiant: <input id="1" type="text" name="login" autocomplete="username" value=""/> <br>
      Mot de passe: <input id="2" type="password" name="passwd" autocomplete="current-password" value=""/><br>
      <input id="3" type="submit" name="submit" value="OK"></p>
  </form>
  <a href="create.php">Cr&eacuteer un compte</a><br>
  <a href="modif.php">Modifier son mot de passe</a><br>
</body></html>
  