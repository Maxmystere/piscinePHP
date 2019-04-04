<?php
require_once 'Ship.class.php';
require_once 'Player.class.php';
class Board
{
	public $player1;
	public $player2;
	public $x = 150;
	public $y = 100;
	protected $board;
	function __construct()
	{
		$this->board = array();
		$this->player1 = new Player(array(1));
		$this->player2 = new Player(array(1));

		for ($ytmp = 0; $ytmp < $this->y; $ytmp++) {
			for ($xtmp = 0; $xtmp < $this->x; $xtmp++) {
				if ($xtmp == 4 && $ytmp == 20)
				{
					$this->board[$ytmp][$xtmp] = new Ship(array(
						'name' => "Rightful Vengeance", 'width' => 1, 'length' => 2,
						'imgid' => 1, 'hp' => 5, 'pp' => 4, 'team' => 1,
						'speed' => 3, 'manu' => 2));
				}
				else if ($xtmp == 10 && $ytmp == 15)
				{
					$this->board[$ytmp][$xtmp] = new Ship(array(
						'name' => "Smite Of Terra", 'width' => 2, 'length' => 6,
						'imgid' => 2, 'hp' => 5, 'pp' => 5, 'team' => 1,
						'speed' => 3, 'manu' => 2));
				}
				else
					$this->board[$ytmp][$xtmp] = 0;
			}
		}
	}
	
	public function getShipAtLocation(array $kwargs)
	{
		if (array_key_exists('posx', $kwargs) && array_key_exists('posy', $kwargs))
		{
			//print("Searching ship at " . $kwargs["posx"] . " " . $kwargs["posy"]);
			return ($this->board[$kwargs["posy"]][$kwargs["posx"]]);
		}
		print("Error missing arguments" . PHP_EOL);
		return ;
	}
	public function getJsonBoard()
	{
		echo json_encode($this->board);
	}
	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Board.doc.txt", true));
	}
}
?>
