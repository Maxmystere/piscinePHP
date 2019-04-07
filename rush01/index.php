<?php
session_start();
if (!isset($_SESSION['loggued_on_user'])) {
    header("Location: /login/login.php");
    exit;
}
include "header.php";
?>
<div style="height:1140px;display:block;">
    <div style="display:inline-block; height:100%; width:84.5%">
        <iframe height="100%" width="100%" id="game" name="game" src="/players.php"></iframe>
    </div>
    <div style="display:inline-block; height:100%; width:14.5%; vertical-align:top;">
        <iframe scrolling="no" id="chatframe" width="100%" height="40%" src="/chat/index.php"></iframe>
        <iframe scrolling="no" id="panel" width="100%" height="40%" src="panel.php"></iframe>
    </div>
</div>
</body></html>