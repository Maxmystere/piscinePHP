<?php session_start();
include "header.php";
if (isset($_SESSION['loggued_on_user'])) {
    echo '<div style="display:inline-block; height:1200px; width:85%"><iframe height="100%" width="100%" id="game" name="game" src="/game.php"></iframe></div>';
    echo '<div style="display:inline-block; height:1200px; width:15%"><iframe id="chatframe" height="30%" name="chatframe" src="/chat/index.php"></iframe></div>';
}
?>
</body></html>