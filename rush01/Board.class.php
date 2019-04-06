<?php
require_once 'Ship.class.php';
require_once 'Player.class.php';
require_once 'Fighter.class.php';
require_once 'Cruiser.class.php';
require_once 'Flagship.class.php';
class Board
{
	public static $verbose;
	public $currentplayer;
	public $player1;
	public $player2;
	public $x = 20;
	public $y = 20;
	public $board;
	function __construct()
	{
		$this->currentplayer = 0;
		$this->board = array();
		$this->player1 = new Player(array('id' => 0, 'boardclass' => $this));
		$this->player2 = new Player(array('id' => 1, 'boardclass' => $this));
		$this->initBoard();
		if (self::$verbose)
			print("Board initialised" . PHP_EOL);
	}
	protected function initBoard()
	{
		for ($ytmp = 0; $ytmp < $this->y; $ytmp++) {
			for ($xtmp = 0; $xtmp < $this->x; $xtmp++) {
				$this->board[$ytmp][$xtmp] = 0;
			}
		}

		$this->initFleet(array('team' => 0, 'player' => $this->player1, 'x' => 15, 'y' => 4));
		$this->initFleet(array('team' => 1, 'player' => $this->player2, 'x' => 10, 'y' => 12));
	}
	private function initFleet(array $kwargs)
	{
		$player = $kwargs['player'];
		$ylne = $kwargs['y']; //Position on board
		$xctr = $kwargs['x']; //center of fleet
		$team = $kwargs['team'];

//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr - 22, 'y' => $ylne - 2, 'shipclass' => 'Fighter', 'name' => 'Reaper'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr - 20, 'y' => $ylne - 1, 'shipclass' => 'Fighter', 'name' => 'Inquisitor'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr - 18, 'y' => $ylne, 'shipclass' => 'Fighter', 'name' => 'Inquisitor'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr - 16, 'y' => $ylne + 1, 'shipclass' => 'Cruiser', 'name' => 'Bulwark'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr - 10 - $team, 'y' => $ylne, 'shipclass' => 'Flagship', 'name' => 'Doom Bringer'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr - 5 - $team, 'y' => $ylne, 'shipclass' => 'Cruiser', 'name' => 'High Templar'));
//		$player->addShip($ship);
		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr - 1, 'y' => $ylne, 'shipclass' => 'Flagship', 'name' => 'Emperor\'s Might'));
		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr + 5, 'y' => $ylne, 'shipclass' => 'Cruiser', 'name' => 'High Templar'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr + 9, 'y' => $ylne, 'shipclass' => 'Flagship', 'name' => 'Doom Bringer'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr + 15, 'y' => $ylne + 1, 'shipclass' => 'Cruiser', 'name' => 'Bulwark'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr + 18, 'y' => $ylne, 'shipclass' => 'Fighter', 'name' => 'Inquisitor'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr + 20, 'y' => $ylne - 1, 'shipclass' => 'Fighter', 'name' => 'Inquisitor'));
//		$player->addShip($ship);
//		$ship = $this->buildShipatLocation(array('team' => $team, 'x' => $xctr + 22, 'y' => $ylne - 2, 'shipclass' => 'Fighter', 'name' => 'Reaper'));
//		$player->addShip($ship);
	}
	private function buildShipatLocation(array $kwargs)
	{
		$x = $kwargs['x'];
		$y = $kwargs['y'];
		$classname = $kwargs['shipclass'];
		$shipname = $kwargs['name'];
		$team = $kwargs['team'];
		$newship = new $classname(array('team' => $team, 'name' => $shipname, 'x' => $x, 'y' => $y));
		$this->board[$y][$x] = $newship;
		$shiprot = $newship->getRotation();
		$shipsize = $newship->getSize();
		if ($shiprot == 1) {
			for ($ytmp = $y; $ytmp < $y + $shipsize['l']; $ytmp++) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['w']; $xtmp++) {
					if ($x != $xtmp || $y != $ytmp) {
						$this->board[$ytmp][$xtmp] = array('x' => $x, 'y' => $y);
					}
				}
			}
		} else if ($shiprot == 2) {
			for ($ytmp = $y; $ytmp < $y + $shipsize['w']; $ytmp++) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['l']; $xtmp--) {
						$this->board[$ytmp][$xtmp] = array('x' => $x, 'y' => $y);
				}
			}
		} else if ($shiprot == 3) {
			for ($ytmp = $y; $ytmp > $y - $shipsize['l']; $ytmp--) {
				for ($xtmp = $x; $xtmp > $x - $shipsize['w']; $xtmp--) {
					if ($x != $xtmp || $y != $ytmp) {
						$this->board[$ytmp][$xtmp] = array('x' => $x, 'y' => $y);
					}
				}
			}
		} else if ($shiprot == 4) {
			for ($ytmp = $y; $ytmp > $y - $shipsize['w']; $ytmp--) {
				for ($xtmp = $x; $xtmp < $x + $shipsize['l']; $xtmp++) {
					if ($x != $xtmp || $y != $ytmp) {
						$this->board[$ytmp][$xtmp] = array('x' => $x, 'y' => $y);
					}
				}
			}
		}
		return ($newship);
	}
	public function changePlayer()
	{
		if (self::$verbose)
			print("Switching player turn" . PHP_EOL);
		$pl = $this->getCurrentPlayer();
		foreach ($pl->getShipList() as $lilship) {
			$lilship->refuelEnergy();
		}
		if ($this->currentplayer == 0)
			$this->currentplayer = 1;
		else
			$this->currentplayer = 0;
	}
	public function getCurrentPlayer()
	{
		if ($this->currentplayer == 0)
			return ($this->player1);
		return ($this->player2);
	}
	public function getPPLeft()
	{
		$pl = $this->getCurrentPlayer();
		$ppleft = 0;
		foreach ($pl->getShipList() as $lilship) {
			$ppleft += $lilship->getEnergy();
		}
		return ($ppleft);
	}
	public function getPlayer($id)
	{
		if ($id == 0)
			return ($this->player1);
		return ($this->player2);
	}
	public function getShipAtLocation(array $kwargs)
	{
		if (array_key_exists('posx', $kwargs) && array_key_exists('posy', $kwargs)) {
			if (self::$verbose)
				print("Searching ship at " . $kwargs["posx"] . " " . $kwargs["posy"]);
			return ($this->board[$kwargs["posy"]][$kwargs["posx"]]);
		}
		print("Error missing arguments" . PHP_EOL);
		return;
	}
	public function getJsonBoard()
	{
		echo json_encode($this->board);
	}
	public function getCurrentStats()
	{
		$tmp['ppleft'] = $this->getPPLeft();
		if (!$tmp['ppleft']) {
			$this->changePlayer();
			$tmp['ppleft'] = $this->getPPLeft();
			$_SESSION['board'] = serialize($this);
		}
		$tmp['currentp'] = $this->currentplayer;
		echo json_encode($tmp);
	}
	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Board.doc.txt", true));
	}
}
?>
