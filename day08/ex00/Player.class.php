<?php

class Player
{
	protected $shipsarray;
	private $id;
	private $boardclass;
	function __construct(array $kwargs)
	{
		$this->shipsarray = array();
		$this->id = $kwargs['id'];
		$this->boardclass = $kwargs['boardclass'];
	}
	function buildShip(array $kwargs)
	{
		$tmp = new Ship(array(
			'name' => $kwargs['name'], 'width' => 1, 'length' => 2,
			'imgid' => 1, 'hp' => 5, 'pp' => 4, 'team' => $this->id,
			'speed' => 3, 'manu' => 2, 'id' => sizeof($this->shipsarray), 'x' => $kwargs['x'], 'y' => $kwargs['y']));
		$this->shipsarray[] = $tmp;
		return ($tmp);
	}
	function move(array $kwargs)
	{
		$this->shipsarray[$kwargs['id']];
		print_r($kwargs);
		return ($kwargs);
	}
	function getShipList()
	{
		return ($this->shipsarray);
	}
	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Player.doc.txt", true));
	}
}
?>
