<?php
session_start();
if (isset($_SESSION['loggued_on_user'])) {
    echo '<iframe id="msg" name="msg" title="42BattlenetChat" width="300px" height="300px" src="chat.php"></iframe><br>';
    if (isset($_POST['send_msg']) && $_POST['send_msg'] == "Speak!") {
        $folder = "../private";
        $file = $folder."/chat";
        if (!file_exists($folder))
            mkdir($folder);
        if (file_exists($file))
            $read = unserialize(file_get_contents($file));
        $read[] = array(
                    'login' => $_SESSION['loggued_on_user'],
                    'time' => time(),
                    'msg' => $_POST['msg']
                );
        file_put_contents($file, serialize($read), LOCK_EX);
    }
} else {
    echo 'Merci de vous connecter <a href="/index.php">par ici.</a><br>';
}
?>
<html><head><link rel="stylesheet" type="text/css" href="../css/main.css"></head>
<body><form method="POST" action="index.php">
    <input style="margin:10px 10px 5px 10px; font-size:12pt;" id="msg" type="textarea" size="25"  name="msg" value=""/>
    <input class="input_btn" id="send_msg" type="submit" name="send_msg" value="Speak!"/>
</form></body>
</html>