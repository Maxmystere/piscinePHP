<?php
if ("/install.php"== $_SERVER['REQUEST_URI'])
{
    header("Location: /index.php");
    exit;
}
include ('manageitems.php');
if (file_exists('.private')){
    rmdir_recursive('.private');
}
mkdir('.private', 0755);
$init['root'] = array('login' => 'root', 'mdp' => password_hash('root', PASSWORD_BCRYPT), 'admin' => 'Y');
$init['julien'] = array('login' => 'julien', 'mdp' => password_hash('julien', PASSWORD_BCRYPT), 'mail' => 'julien@julien.com');
$init['arnaud'] = array('login' => 'arnaud', 'mdp' => password_hash('arnaud', PASSWORD_BCRYPT), 'mail' => 'arnaud@arnaud.com');
$init = serialize($init);
file_put_contents('.private/users', $init);
mkdir('.private/img', 0755);
file_put_contents('.private/achats', serialize(array()));
file_put_contents('.private/articles', serialize(array()));

copy('https://i.ibb.co/Nyg4rqg/desert-rose-bottines-vegan-beige-465x528.jpg', ".private/img/bottines.jpg" );
copy('https://i.ibb.co/f0Y25vJ/sundust-bottines-noir-daim-vegan-465x528.jpg', ".private/img/bottines_noir.jpg");
copy('https://i.ibb.co/WKzGbVG/CANNON-KNIT-DARK-GREY-SAO3007-105-SIDE-2048x-465x528.jpg', '.private/img/basket.jpg' );

copy('https://i.ibb.co/VjfJYpX/PullF.jpg', '.private/img/PullF.jpg');
copy('https://i.ibb.co/GP4N36W/Pullh.jpg', '.private/img/Pullh.jpg');
copy('https://i.ibb.co/Vtzppbc/Tshirt.jpg', '.private/img/Tshirt.jpg');
copy('https://i.ibb.co/dLhrX2x/TshirtF.jpg', '.private/img/TshirtF.jpg');

copy('https://i.ibb.co/Ny7srh7/Pull-H.jpg', '.private/img/Pull-H.jpg');
copy('https://i.ibb.co/82Lsdyw/Bonnet-femme.jpg', '.private/img/Bonnet-femme.jpg');
copy('https://i.ibb.co/t8bTKN1/Veste-femme.jpg', '.private/img/Veste-femme.jpg');
copy('https://i.ibb.co/K7Gtt6L/chaussure-femme.jpg', '.private/img/chaussures-femme.jpg');
copy('https://i.ibb.co/jTD1Xdb/Pull-homme.jpg', '.private/img/Pull-hommes.jpg');
copy('https://www.by-ethics.com/wp-content/uploads/2016/09/logo-jaune.png', '.private/img/logo2.jpg');
copy('https://i.ibb.co/jTD1Xdb/Pull-homme.jpg', '.private/img/Pull-homme.jpg');
copy('https://i.ibb.co/GTCtx2t/Veste-homme.jpg', '.private/img/Veste-homme.jpg');

// add_item("bottines.jpg", 40, "Pull femme", "chaussure, femme", TRUE);
add_item("bottines_noir", 40, "bottines noirs", "chaussures, femme", TRUE);
add_item("basket", 40, "basket", "chaussures, femme", TRUE);

add_item("PullF", 40, "Pull femme", "vetements, femme", TRUE);
add_item("Pullh", 40, "Pull pour homme", "vetements, homme", TRUE);
add_item("Tshirt", 40, "Tshirt", "vetements", TRUE);
add_item("TshirtF", 40, 'Tshirt Femme', "vetements, femme", TRUE);
add_item("Pull-H", 40, "Pull homme", "vetements, homme", TRUE);
add_item("Bonnet-femme", 40, "Bonnet-femme", "vetements, femme", TRUE);
add_item("chaussures-femme", 40, "Chaussures femmes", "chaussures, femme", TRUE);
add_item("Pull-homme", intval(40), "Pull homme", "vetements, homme", TRUE);
add_item("Veste-homme", intval(40), "Veste homme", "vetements, homme", TRUE);


function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}
?>

