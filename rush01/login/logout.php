<?php session_start();
include "../header.php";
if (isset($_SESSION['loggued_on_user'])) {
    $_SESSION['loggued_on_user'] = "";
}
session_destroy();
header("Location: /index.php");
?>