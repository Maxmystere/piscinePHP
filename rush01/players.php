<?php
session_start();
$file = "private/games";
if (!file_exists($file)) {
    file_put_contents($file, "", LOCK_EX);
}
$read = unserialize(file_get_contents($file));
if (isset($_SESSION['loggued_on_user'])) {
    $login = $_SESSION['loggued_on_user'];
    if (isset($_POST['SeekP']) && $_POST['SeekP'] == "Rechercher un joueur" ) {
        $_SESSION['seek'] = 1;
        $read[$login] = array(
            'name' => $login,
            'seek' => 1,
            'board' => 0);
        file_put_contents($file, serialize($read), LOCK_EX);
    } else if (isset($_POST['SeekP']) && $_POST['SeekP'] == "Stop") {
        unset($_SESSION['seek']);
        $read = unserialize(file_get_contents($file));
        $read[$login]['seek'] = 0;
        file_put_contents($file, serialize($read), LOCK_EX);
    } 
    if (isset($_SESSION['seek']) && $_SESSION['seek'] == 1) { 
        echo "<h4>Joueurs Connect&eacutes</h4>";
        foreach ($read as $user_array) {
            if ($user_array['seek'] == 1 && $user_array['name'] != $login) {
                echo '<input class="input_btn" id="startG" name=startG" type="submit" value="Play with">';
                echo $user_array['name']."<br>";
            }
        }
    }
}
?>
<head><link rel="stylesheet" type="text/css" href="../css/main.css"></head>
<hr><form method="POST" action="players.php"><input class="input_btn" id="SeekP" name="SeekP" type="submit" value="<?php if (!isset($_SESSION['seek'])) {echo "Rechercher un joueur";} else { echo "Stop";}?>"></form>