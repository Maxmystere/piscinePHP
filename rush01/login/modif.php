<?php
include "../header.php";
foreach($_POST as $value) {
	$value = htmlspecialchars($value);
}
if ($_POST['submit'] == 'OK' && $_POST['login'] && $_POST['oldpw'] && $_POST['newpw']) {
    $login = $_POST['login'];
    $oldpw = hash('whirlpool', $_POST['oldpw']);
    $newpw = hash('whirlpool', $_POST['newpw']);
    $file = "../private/passwd";
    if (file_exists($file))
        $read = unserialize(file_get_contents($file));
    if (@!$read[$login]) {
        echo("Mauvais utilisateur\n");
    } else {
        if ($read[$login]['passwd'] == $oldpw) {
            $read[$login] = array(
                'login' => $login,
                'passwd' => $newpw
            );
            file_put_contents($file, serialize($read), LOCK_EX);
            echo "OK\n";
            header("Location: /index.php");
        } else {
            echo "Mauvais mot de passe\n";
        }
    }
}
?>
<html><body>
  <form method="POST" action="modif.php">
    <h1>Modification du mot de passe</h1>
    <p>Identifiant: <input id="1" type="text" name="login" value=""/> <br>
      Ancien mot de passe: <input id="2" type="password" name="oldpw" value=""/><br>
      Nouveau mot de passe: <input id="3" type="password" name="newpw" value=""/><br>
      <input id="4" type="submit" name="submit" value="OK"></p>
  </form>
</body></html>
  