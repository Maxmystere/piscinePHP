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
	function addShip($newship)
	{
		$newship->setID(sizeof($this->shipsarray));
		$newship->setTeam($this->id);
		$this->shipsarray[] = $newship;
	}
	function move(array $kwargs)
	{
		if (!$this->shipsarray[$kwargs['id']]->useEnergy($kwargs['move'])) {
			return ("needEnergy");
		}
		$rot = $this->shipsarray[$kwargs['id']]->getrotation();
		$shipsize = $this->shipsarray[$kwargs['id']]->getSize();
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		if ($rot == 1) {
			$tmpship = $this->boardclass->board[$y][$x];
			for ($ytmp = $y; $ytmp < $y + $shipsize['l']; $ytmp++) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['w']; $xtmp++) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y - $kwargs['move']][$x] = $tmpship;
		} else if ($rot == 2) {
			$tmpship = $this->boardclass->board[$y][$x];
			for ($ytmp = $y; $ytmp < $y + $shipsize['w']; $ytmp++) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['l']; $xtmp--) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y][$x + $kwargs['move']] = $tmpship;
		} else if ($rot == 3) {
			$tmpship = $this->boardclass->board[$y][$x];
			for ($ytmp = $y; $ytmp > $y - $shipsize['l']; $ytmp--) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['w']; $xtmp--) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y + $kwargs['move']][$x] = $tmpship;
		} else if ($rot == 4) {
			$tmpship = $this->boardclass->board[$y][$x];
			for ($ytmp = $y; $ytmp > $y - $shipsize['w']; $ytmp--) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['l']; $xtmp++) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
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
		$shipsize = $this->shipsarray[$kwargs['id']]->getSize();
		$shiplen = $shipsize['l'] / 2;
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		$tmpship = $this->boardclass->board[$y][$x];
		if ($rot == 1) {
			$tmpship->setRotation(4);
			for ($ytmp = $y; $ytmp < $y + $shipsize['l']; $ytmp++) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['w']; $xtmp++) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y][$x - $shiplen] = $tmpship;
		} else if ($rot == 2) {
			$tmpship->setRotation(1);
			for ($ytmp = $y; $ytmp < $y + $shipsize['w']; $ytmp++) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['l']; $xtmp--) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y - $shiplen][$x] = $tmpship;
		} else if ($rot == 3) {
			$tmpship->setRotation(2);
			for ($ytmp = $y; $ytmp > $y - $shipsize['l']; $ytmp--) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['w']; $xtmp--) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y][$x + $shiplen] = $tmpship;
		} else if ($rot == 4) {
			$tmpship->setRotation(3);
			for ($ytmp = $y; $ytmp > $y - $shipsize['w']; $ytmp--) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['l']; $xtmp++) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y + $shiplen][$x] = $tmpship;
		}
	}
	function rotateRight(array $kwargs)
	{
		if (!$this->shipsarray[$kwargs['id']]->useEnergy(1)) {
			return ("needEnergy");
		}
		$rot = $this->shipsarray[$kwargs['id']]->getrotation();
		$shipsize = $this->shipsarray[$kwargs['id']]->getSize();
		$shiplen = $shipsize['l'] / 2;
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		if ($rot == 1) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(2);
			for ($ytmp = $y; $ytmp < $y + $shipsize['l']; $ytmp++) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['w']; $xtmp++) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y][$x + $shiplen] = $tmpship;
		} else if ($rot == 2) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(3);
			for ($ytmp = $y; $ytmp < $y + $shipsize['w']; $ytmp++) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['l']; $xtmp--) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y + $shiplen][$x] = $tmpship;
		} else if ($rot == 3) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(4);
			for ($ytmp = $y; $ytmp > $y - $shipsize['l']; $ytmp--) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['w']; $xtmp--) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y][$x - $shiplen] = $tmpship;
		} else if ($rot == 4) {
			$tmpship = $this->boardclass->board[$y][$x];
			$tmpship->setRotation(1);
			for ($ytmp = $y; $ytmp > $y - $shipsize['w']; $ytmp--) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['l']; $xtmp++) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y - $shiplen][$x] = $tmpship;
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
