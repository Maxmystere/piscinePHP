<?php
session_start();
if ($_POST['submit'] = "Rechercher un joueur" && isset($_SESSION['loggued_on_user'])) {
    $login = $_SESSION['loggued_on_user'];
    $_SESSION['Seek'] = 1;
    $file = "private/games";
    if (file_exists($file)) {
        $read = unserialize(file_get_contents($file));
    } else {
        file_put_contents($file, "", LOCK_EX);
    }
    $read[$login] = array(
         'name' => $login,
         'seek' => 1,
         'board' => 0);
    file_put_contents($file, serialize($read), LOCK_EX);
    foreach ($read as $user_array) {
        if ($user_array['seek'] == 1) {
            echo $user_array['name']."<br>";
        }
    }
} else if ($_POST['submit'] = "Stop" && isset($_SESSION['loggued_on_user'])) {
    $_SESSION['Seek'] = 0;
    $read = unserialize(file_get_contents($file));
    $read[$login]['seek'] = 0;
    file_put_contents($file, serialize($read), LOCK_EX);
}
?>
<form method="POST" action="players.php"><input id="SeekP" name="SeekP" type="submit" value="<?php if ($_SESSION['Seek'] == 0) {echo 'Rechercher un joueur';} else { echo 'Stop';}?>"></form>