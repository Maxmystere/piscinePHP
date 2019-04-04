<?php
require_once 'Board.class.php';
abstract class Movement extends Board
{
	abstract public function getShipSize();
	function __construct()
	{
	}
	function Move()
	{
		$size = $this->getShipSize;
	}
	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Movement.doc.txt", true));
	}
}
?>
