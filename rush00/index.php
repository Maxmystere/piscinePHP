<?php
session_start();
include ('manageitems.php');
include ('managecookie.php');
$dbarticles = list_items();

if (isset($_GET['add'])){
    $item = $_GET['add'];
    cookie_add_item($item, 1);
}
?>
<html>
<head>
    <?php include 'includes/head.php' ?>
</head>
<body>
    <?php include 'includes/header.php'?>
    <div class="category">
        <a href="index.php">Collection</a>
        <a href="index.php?cat=femme">Femme</a>
        <a href="index.php?cat=homme">Homme</a>
        <a href="index.php?cat=chaussures">Chaussures</a>
        <a href="index.php?cat=vetements">Vêtements</a>
    </div>
    <div class="wrap_articles">
        <?php if(isset($_GET['cat'])){
            $dbarticles = list_items();
            foreach($dbarticles as $article => &$content){
                if (in_array($_GET['cat'], $content['category']))
                    $display_array[$article] = $content;
            }
            $dbarticles = $display_array;
        }?>
        <?php foreach($dbarticles as $article => $content){
            echo "<div class='img_container'>";
            echo "<h2>".$content['name']."</h2>"; ?>
            <img src="<?=$content['picpath']?>">
            <p>
                <?=$content['price']?>€</p>
            <p>
                <?=$content['desc']?>
            </p>
            <?php if(isset($_GET['cat'])){
                $cat = $_GET['cat']?>
            <a href="index.php?cat=<?=$cat?>&add=<?=$article?>">🛒</a>
            <?php }?>
            <?php if (!isset($_GET['cat'])){?>
                <a href="index.php?add=<?=$article?>">🛒</a>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</body>

</html>
