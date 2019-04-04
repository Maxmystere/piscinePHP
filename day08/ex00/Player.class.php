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
			'speed' => 3, 'manu' => 2, 'id' => sizeof($this->shipsarray), 'x' => $kwargs['x'], 'y' => $kwargs['y']
		));
		$this->shipsarray[] = $tmp;
		return ($tmp);
	}
	function move(array $kwargs)
	{
		if (!$this->shipsarray[$kwargs['id']]->useEnergy($kwargs['move'])) {
			return ("needEnergy");
		}
		$rot = $this->shipsarray[$kwargs['id']]->getrotation();
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		if ($rot == 1) {
			$tmpship = $this->boardclass->board[$y][$x];
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y - $kwargs['move']][$x] = $tmpship;
		} else if ($rot == 2) {
			$tmpship = $this->boardclass->board[$y][$x];
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y][$x + $kwargs['move']] = $tmpship;
		} else if ($rot == 3) {
			$tmpship = $this->boardclass->board[$y][$x];
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y + $kwargs['move']][$x] = $tmpship;
		} else if ($rot == 4) {
			$tmpship = $this->boardclass->board[$y][$x];
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y][$x - $kwargs['move']] = $tmpship;
		}
		$tmpship->moveForward($kwargs['move']);
	}
	function rotateLeft(array $kwargs)
	{
		if (!$this->shipsarray[$kwargs['id']]->useEnergy(1)) {
			return ("needEnergy");
		}
		$rot = $this->shipsarray[$kwargs['id']]->getrotation();
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		if ($rot == 1) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(4);
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y][$x - 1] = $tmpship;
		} else if ($rot == 4) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(3);
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y + 1][$x] = $tmpship;
		} else if ($rot == 3) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(2);
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y][$x + 1] = $tmpship;
		} else if ($rot == 2) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(1);
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y - 1][$x] = $tmpship;
		}
	}
	function rotateRight(array $kwargs)
	{
		if (!$this->shipsarray[$kwargs['id']]->useEnergy(1)) {
			return ("needEnergy");
		}
		$rot = $this->shipsarray[$kwargs['id']]->getrotation();
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		if ($rot == 1) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(2);
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y][$x + 1] = $tmpship;
		} else if ($rot == 2) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(3);
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y + 1][$x] = $tmpship;
		} else if ($rot == 3) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(4);
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y][$x - 1] = $tmpship;
		} else if ($rot == 4) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(1);
			$this->boardclass->board[$y][$x] = 0;
			$this->boardclass->board[$y - 1][$x] = $tmpship;
		}
	}
	function getShipList()
	{
		return ($this->shipsarray);
	}
	function getShipByID($arg)
	{
		return ($this->shipsarray[$arg]);
	}
	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Player.doc.txt", true));
	}
}
?>
