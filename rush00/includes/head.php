<?php
if ("/includes/head.php"== $_SERVER['REQUEST_URI'])
{
    header("Location: /index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" type="text/css" href="CSS/header.css" />
<link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
<title>
	<?=$title?>
</title>
