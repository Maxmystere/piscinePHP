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
	private function putShipAtLocation(Ship $tmpship, $x, $y, $rot, $shipsize)
	{
		if ($rot == 1) {
			for ($ytmp = $y; $ytmp < $y + $shipsize['l']; $ytmp++) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['w']; $xtmp++) {
					if ($x != $xtmp || $y != $ytmp)
						$this->boardclass->board[$ytmp][$xtmp] = array('x' => $x, 'y' => $y);
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		} else if ($rot == 2) {
			for ($ytmp = $y; $ytmp < $y + $shipsize['w']; $ytmp++) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['l']; $xtmp--) {
					if ($x != $xtmp || $y != $ytmp)
						$this->boardclass->board[$ytmp][$xtmp] = array('x' => $x, 'y' => $y);
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		} else if ($rot == 3) {
			for ($ytmp = $y; $ytmp > $y - $shipsize['l']; $ytmp--) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['w']; $xtmp--) {
					if ($x != $xtmp || $y != $ytmp)
						$this->boardclass->board[$ytmp][$xtmp] = array('x' => $x, 'y' => $y);
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		} else if ($rot == 4) {
			for ($ytmp = $y; $ytmp > $y - $shipsize['w']; $ytmp--) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['l']; $xtmp++) {
					if ($x != $xtmp || $y != $ytmp)
						$this->boardclass->board[$ytmp][$xtmp] = array('x' => $x, 'y' => $y);
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		}
	}
	private function checkShipMove($ship, $x, $y, $rot, $shipsize, $trust)
	{
		$xhome = $x;
		$yhome = $y;
		if ($rot == 1) {
			$y -= $trust;
			for ($ytmp = $y; $ytmp < $y + $shipsize['l']; $ytmp++) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['w']; $xtmp++) {
					if ($xtmp < 0 || $ytmp < 0 || $xtmp > $this->boardclass->x || $ytmp > $this->boardclass->y || $this->boardclass->board[$ytmp][$xtmp]) {
						return (false);
					}
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		} else if ($rot == 2) {
			$x += $trust;
			for ($ytmp = $y; $ytmp < $y + $shipsize['w']; $ytmp++) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['l']; $xtmp--) {
					if ($xtmp < 0 || $ytmp < 0 || $xtmp > $this->boardclass->x || $ytmp > $this->boardclass->y || $this->boardclass->board[$ytmp][$xtmp]) {
						return (false);
					}
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		} else if ($rot == 3) {
			$y += $trust;
			for ($ytmp = $y; $ytmp > $y - $shipsize['l']; $ytmp--) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['w']; $xtmp--) {
					if ($xtmp < 0 || $ytmp < 0 || $xtmp > $this->boardclass->x || $ytmp > $this->boardclass->y || $this->boardclass->board[$ytmp][$xtmp]) {
						return (false);
					}
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		} else if ($rot == 4) {
			$x -= $trust;
			for ($ytmp = $y; $ytmp > $y - $shipsize['w']; $ytmp--) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['l']; $xtmp++) {
					if ($xtmp < 0 || $ytmp < 0 || $xtmp > $this->boardclass->x || $ytmp > $this->boardclass->y || $this->boardclass->board[$ytmp][$xtmp]) {
						return (false);
					}
				}
			}
		}
		return (true);
	}
	private function cleanShipAtLocation($x, $y, $rot, $shipsize)
	{
		if ($rot == 1) {
			for ($ytmp = $y; $ytmp < $y + $shipsize['l']; $ytmp++) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['w']; $xtmp++) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		} else if ($rot == 2) {
			for ($ytmp = $y; $ytmp < $y + $shipsize['w']; $ytmp++) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['l']; $xtmp--) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		} else if ($rot == 3) {
			for ($ytmp = $y; $ytmp > $y - $shipsize['l']; $ytmp--) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['w']; $xtmp--) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		} else if ($rot == 4) {
			for ($ytmp = $y; $ytmp > $y - $shipsize['w']; $ytmp--) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['l']; $xtmp++) {
					$this->boardclass->board[$ytmp][$xtmp] = 0;
				}
			}
			$this->boardclass->board[$y][$x] = $tmpship;
		}
	}
	function shoot(array $kwargs)
	{
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		$tmpship = $this->boardclass->board[$y][$x];
		$rot = $tmpship->getrotation();
		$shipsize = $tmpship->getSize();
		
	}
	function move(array $kwargs)
	{
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		$tmpship = $this->boardclass->board[$y][$x];
		$rot = $tmpship->getrotation();
		$shipsize = $tmpship->getSize();
		$this->cleanShipAtLocation($x, $y, $rot, $shipsize);
		if (!$this->checkShipMove($tmpship, $x, $y, $rot, $shipsize, $kwargs['move']) || !$tmpship->useEnergy($kwargs['move'])) {
			$this->putShipAtLocation($tmpship, $x, $y, $rot, $shipsize);
			return (true);
		}
		$tmpship->moveForward($kwargs['move']);
		if ($rot == 1) {
			$this->putShipAtLocation($tmpship, $x, $y - $kwargs['move'], $rot, $shipsize);
		} else if ($rot == 2) {
			$this->putShipAtLocation($tmpship, $x + $kwargs['move'], $y, $rot, $shipsize);
		} else if ($rot == 3) {
			$this->putShipAtLocation($tmpship, $x, $y + $kwargs['move'], $rot, $shipsize);
		} else if ($rot == 4) {
			$this->putShipAtLocation($tmpship, $x - $kwargs['move'], $y, $rot, $shipsize);
		}
		return (false);
	}
	function rotateLeft(array $kwargs)
	{
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		$tmpship = $this->boardclass->board[$y][$x];
		if (!$tmpship->useEnergy(1)) {
			return ("needEnergy");
		}
		$rot = $tmpship->getrotation();
		$shipsize = $tmpship->getSize();
		$shiplen = floor($shipsize['l'] / 3);
		$this->cleanShipAtLocation($x, $y, $rot, $shipsize);
		if ($rot == 1) {
			$tmpship->setRotation(4);
			$this->putShipAtLocation($tmpship, $x - $shiplen, $y, 4, $shipsize);
		} else if ($rot == 2) {
			$tmpship->setRotation(1);
			$this->putShipAtLocation($tmpship, $x, $y - $shiplen, 1, $shipsize);
		} else if ($rot == 3) {
			$tmpship->setRotation(2);
			$this->putShipAtLocation($tmpship, $x + $shiplen, $y, 2, $shipsize);
		} else if ($rot == 4) {
			$tmpship->setRotation(3);
			$this->putShipAtLocation($tmpship, $x, $y + $shiplen, 3, $shipsize);
		}
	}
	function rotateRight(array $kwargs)
	{
		$x = $kwargs['posx'];
		$y = $kwargs['posy'];
		$tmpship = $this->boardclass->board[$y][$x];
		if (!$tmpship->useEnergy(1)) {
			return ("needEnergy");
		}
		$rot = $tmpship->getrotation();
		$shipsize = $tmpship->getSize();
		$shiplen = floor($shipsize['l'] / 3);
		$this->cleanShipAtLocation($x, $y, $rot, $shipsize);
		if ($rot == 1) {
			$tmpship->setRotation(2);
			$this->putShipAtLocation($tmpship, $x + $shiplen, $y, 2, $shipsize);
		} else if ($rot == 2) {
			$tmpship->setRotation(3);
			$this->putShipAtLocation($tmpship, $x, $y + $shiplen, 3, $shipsize);
		} else if ($rot == 3) {
			$tmpship->setRotation(4);
			$this->putShipAtLocation($tmpship, $x - $shiplen, $y, 4, $shipsize);
		} else if ($rot == 4) {
			$tmpship->setRotation(1);
			$this->putShipAtLocation($tmpship, $x, $y - $shiplen, 1, $shipsize);
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
