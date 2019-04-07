<?php
date_default_timezone_set('Europe/Paris');
$file = "../private/chat";
if (file_exists($file)) {
    $data = unserialize(file_get_contents($file));
    foreach ($data as $input) {
        echo "[".date('H:i', $input['time'])."] <b>".$input['login']."</b>: ".$input['msg']."<br />";
    }
}
?>
<script>window.setInterval(function() {location.reload();}, 1500);</script>