<?php
session_start();
if (!file_exists("/private")) {
    mkdir("/private");
    file_put_contents("/private/.htaccess", "Deny from all");
}
if (!isset($_SESSION['loggued_on_user'])) {
    header("Location: /login/login.php");
    exit;
}
include "header.php";
?>
<div style="height:1140px;display:block;">
    <div style="display:inline-block; height:100%; width:84.5%">
        <?php if (isset($_SESSION['ingame'])) {
            echo '<iframe height="100%" width="100%" id="game" name="game" src="/game.php"></iframe>';
        } else {
            echo '<iframe height="100%" width="100%" id="proom" name="proom" src="/players.php"></iframe>';
        }?>
    </div>
    <div style="display:inline-block; height:100%; width:14.5%; vertical-align:top;">
        <iframe scrolling="no" id="chatframe" width="100%" height="40%" src="/chat/index.php"></iframe>
        <iframe scrolling="no" id="panel" width="100%" height="40%" src="panel.php"></iframe>
    </div>
</div>
</body></html>