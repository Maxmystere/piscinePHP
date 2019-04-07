<?php 
include "header.php";
if (isset($_SESSION['loggued_on_user'])) {
    echo '<div style="height:1140px;display:block;scrolling:no;">';
    echo '<div style="display:inline-block; height:100%; width:85%"><iframe height="100%" width="100%" id="game" name="game" src="/game.php"></iframe></div>';
    echo '<div style="display:inline-block; height:100%; width:14.5%; vertical-align:top;">';
    echo '<iframe scrolling="no" id="chatframe" width="100%" height="40%" src="/chat/index.php"></iframe>';
    echo '<iframe scrolling="no" id="searchP" width="100%" height="40%" src="/players.php"></iframe>';
    echo '</div></div></body></html>';
} else {
    header("Location: /login/login.php");
}
?>
