<?php 
session_start();
include "../header.php";
?>
<div class="content">
<h1>Bonjour <?=$_SESSION['loggued_on_user']?></h1>
<a href="modif.php">Modifier son mot de passe</a><br>
<a href="create.php">Supprimer son compte</a><br>
<p>En attente de joueur: <?php if ($_SESSION['seek'] == 1) { echo "oui";} else {echo "non";}?></p>
</div>
</body></html>