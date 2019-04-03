<?php
if ("/users.php"== $_SERVER['REQUEST_URI'])
{
    header("Location: /index.php");
    exit;
}
session_start();
include ('managedb.php');
include ('manageitems.php');
$login = $_SESSION['login'];
if ($login !== 'root'){
    header("Location: index.php");
    exit;
}
if (isset($_GET['del'])){
    $user = $_GET['del'];
    delete_user($user);
}
$users_array = users_array();
?>
<html>
<head>
    <?php include 'includes/head.php' ?>
</head>

<body>
    <?php include 'includes/header.php' ?>
    <div>
        <div class="table_wrapper">
            <h2 class="table-header">Gestion users<h2>
                    <?php foreach($users_array as $user => $data){ if (!isset($data['admin'])){?>
                    <div>
                        <table>
                            <tr>
                                <?=$user?>
                            </tr>
                            <tr>
                                <?=$data['mail']?>
                            </tr>
                            <tr>
                                <a href="users.php?del=<?=$user?>">❌</a>
                            </tr>
                        </table>
                    </div>
                    <? }}?>
        </div>
    </div>
</body>

</html>
