<?php 
session_start();
include "../header.php";
$file = "../private/games";
if (!file_exists($file)) {
    file_put_contents($file, "", LOCK_EX);
}
$read = unserialize(file_get_contents($file));
?>
<div class="content">
<h1>Bonjour <?=$_SESSION['loggued_on_user']?></h1>
<a href="modif.php">Modifier son mot de passe</a><br>
<a href="create.php">Supprimer son compte</a><br>
<p>En attente de joueur: <?php if (isset($_SESSION['seek'])) { echo "oui";} else {echo "non";}?></p>
<p># de parties: <?= $read[$login]['nbgame'] ?></p>
</div>
</body></html>