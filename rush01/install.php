<?php
session_start();
require_once 'Board.class.php';
$file = "private/games";
if (!file_exists($file)) {
    file_put_contents($file, "", LOCK_EX);
}
$read = unserialize(file_get_contents($file));
if (isset($_SESSION['loggued_on_user'])) {
    $login = $_SESSION['loggued_on_user'];
    if ($_POST['startG'] == "Play with") {
        unset($_SESSION['seek']);
        $read[$login]['with'] = $_POST['login2'];
        $read[$login]['gamefilename'] = $login . "_" .$_POST['login2'] . ".map";
        file_put_contents($file, serialize($read), LOCK_EX);
        echo "Waiting confirmation from ".$_POST['login2']."<br>";
    } else if ($_POST['startG'] == "Accept") {
        unset($_SESSION['seek']);
        $read[$login]['with'] = $_POST['login1'];
        $read[$login]['gamefilename'] = $_POST['login1'] . "_" . $login . ".map";
        file_put_contents($file, serialize($read), LOCK_EX);
    }
}
if (isset($read[$login]['with'])) {
    $other = $read[$login]['with'];
    //echo "me playing with".$read[$login]['with'];
    //echo "other with".$read[$other]['with']." = ".$login;
}

if ($read[$other]['with'] == $login) {
    $_SESSION['ingame'] = 1;
    $read[$login]['nbgame'] += 1;
    file_put_contents($file, serialize($read), LOCK_EX);

    $tmp = new Board();
    file_put_contents("private/" . $read[$login]['gamefilename'], serialize($tmp), LOCK_EX);
    header("Location: /game.php?install=success");
}
?>
<script> setInterval(function() {document.location.reload(true);}, 3000); </script>
