<?php
require_once 'Ship.class.php';
require_once 'Player.class.php';
require_once 'Cruiser.class.php';
class Board
{
	public static $verbose;
	public $currentplayer;
	public $player1;
	public $player2;
	public $x = 150;
	public $y = 100;
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
				if ($xtmp == 12 && $ytmp == 2) {
					$this->board[$ytmp][$xtmp] = $this->player2->buildShip(array('name' => "Redful Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				} else if ($xtmp == 16 && $ytmp == 2) {
					$this->board[$ytmp][$xtmp] = $this->player2->buildShip(array('name' => "Blueful Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				} else if ($xtmp == 20 && $ytmp == 2) {
					$this->board[$ytmp][$xtmp] = $this->player2->buildShip(array('name' => "Kind Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				} else if ($xtmp == 12 && $ytmp == 10) {
					$this->board[$ytmp][$xtmp] = $this->player1->buildShip(array('name' => "Bad Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				} else if ($xtmp == 16 && $ytmp == 10) {
					$this->board[$ytmp][$xtmp] = $this->player1->buildShip(array('name' => "Bad Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				} else if ($xtmp == 20 && $ytmp == 10) {
					$this->board[$ytmp][$xtmp] = $this->player1->buildShip(array('name' => "Bad Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				} else if ($xtmp == 20 && $ytmp == 10) {
					$this->board[$ytmp][$xtmp] = $this->player1->buildShip(array('name' => "Bad Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				} else
					$this->board[$ytmp][$xtmp] = 0;
			}
		}
	}
	function buildShipatLocation(array $kwargs)
	{
		$x = $kwargs['x'];
		$y = $kwargs['y'];
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
