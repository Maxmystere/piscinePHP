<?PHP
session_start();
require_once 'Board.class.php';
$read = unserialize(file_get_contents("private/games"));
echo filemtime("private/" . $read[$_SESSION['loggued_on_user']]['gamefilename']);

?>
