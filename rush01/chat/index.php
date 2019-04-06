<?php
session_start();
if (isset($_SESSION['loggued_on_user'])) {
    echo '<iframe id="msg" name="msg" title="42BattlenetChat"  height="300px" src="chat.php"></iframe><br>';
    if (isset($_POST['send_msg']) && $_POST['send_msg'] == 'OK') {
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
<html><head>
<link rel="stylesheet" type="text/css" href="../css/main.css">
<script langage="javascript">top.frames['chat'].location = "chat.php";</script>
</head>
<body><form method="post" action="index.php">
    Speak! <input id="msg" type="textarea" size="25" name="msg" value=""/>
    <input id="send_msg" type="submit" name="send_msg" value="OK"/>
</form></body>
</html>
