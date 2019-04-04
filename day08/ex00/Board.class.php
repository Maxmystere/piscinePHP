<?php
require_once 'Ship.class.php';
class Board
{
	public $x = 150;
	public $y = 100;
	protected $board = array();
	function __construct()
	{
		$this->board = array();

		for ($ytmp = 0; $ytmp < $this->y; $ytmp++) {
			for ($xtmp = 0; $xtmp < $this->x; $xtmp++) {
				if ($xtmp == 4 && $ytmp == 20)
				{
					$this->board[$ytmp][$xtmp] = new Ship(array(
						'name' => "Rightful Vengeance", 'width' => 1, 'length' => 2,
						'imgid' => 1, 'hp' => 5, 'pp' => 3, 'team' => 1,
						'speed' => 3, 'manu' => 2));
				}
				else if ($xtmp == 10 && $ytmp == 15)
				{
					$this->board[$ytmp][$xtmp] = new Ship(array(
						'name' => "Smite Of Terra", 'width' => 2, 'length' => 6,
						'imgid' => 2, 'hp' => 5, 'pp' => 3, 'team' => 1,
						'speed' => 3, 'manu' => 2));
				}
				else
					$this->board[$ytmp][$xtmp] = 0;
			}
		}
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
