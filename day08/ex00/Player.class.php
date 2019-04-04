<?php

class Player
{
	protected $shipsarray;
	private $map;
	function __construct(array $kwargs)
	{
		$this->shipsarray = array();
	}
	function buildShip()
	{
		$tmp = new Ship(array(
			'name' => "Rightful Vengeance", 'width' => 1, 'length' => 2,
			'imgid' => 1, 'hp' => 5, 'pp' => 4, 'team' => 1,
			'speed' => 3, 'manu' => 2));
		$this->shipsarray[] = $tmp;
		return ($tmp);
	}
	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Player.doc.txt", true));
	}
}
?>
