<?php
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
					$this->board[$ytmp][$xtmp] = 1;
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
