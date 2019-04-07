<?php
session_start();
foreach($_POST as $value) {
	$value = htmlspecialchars($value);
}
if ($_POST['submit'] == 'OK' && isset($_POST['login']) && isset($_POST['passwd'])) {
    $login = $_POST['login'];
    $passwd = hash('whirlpool', $_POST['passwd']);
    $folder = "../private";
    $file = $folder."/passwd";
    if (!file_exists($folder)) {
        mkdir($folder);
        file_put_contents($folder."/.htaccess", "Deny from all");
    }
    if (file_exists($file))
        $read = unserialize(file_get_contents($file));
    if (@$read[$login]) {
        echo("L'utilisateur existe déjà.\n");
    } else {
        $read[$login] = array(
            'login' => $login,
            'passwd' => $passwd
        );
        file_put_contents($file, serialize($read), LOCK_EX);
        header("Location: login.php");
    }
}
include "../header.php";
?>
    <form method="POST" action="create.php">
    <h1>Cr&eacuteation de compte utilisateur</h1>
    <p>Identifiant: <input id="1" type="text" name="login" value=""/> <br>
      Mot de passe: <input id="2" type="password" name="passwd" value=""/><br>
      <input id="3" type="submit" name="submit" value="OK"></p>
    </form>
    </body>
    </html>

