<?php
session_start();
$file = "private/games";
if (!file_exists($file)) {
    file_put_contents($file, "", LOCK_EX);
}
$read = unserialize(file_get_contents($file));
if (isset($_SESSION['loggued_on_user'])) {
    $login = $_SESSION['loggued_on_user'];
    $login2 = $read[$login]['with'];
    if (isset($_POST['delP'])) {
        $read[$login2]['with'] = "";
        $read[$login]['with'] = "";
        unset($_SESSION["ingame"]);
        file_put_contents($file, serialize($read), LOCK_EX);
    } else if ($read[$login2]['with'] = "") {
        $read[$login]['with'] = "";
        unset($_SESSION["ingame"]);
        file_put_contents($file, serialize($read), LOCK_EX);
    }
}
?>
<head><link rel="stylesheet" type="text/css" href="../css/main.css"></head>
<form method="POST" action="panel.php">
    <input class="input_btn" id="delP" name="delP" type="submit" value="Supprimer la partie" <?php
if (!isset($_SESSION['ingame'])) {
    echo "hidden";
}?>
></form>
<script> setInterval(function() {document.location.reload(true);}, 3000); </script>