<?php
require_once 'Board.class.php';
class Cruiser extends Ship
{
	function __construct(array $kwargs)
	{
		for ($ytmp = 0; $ytmp < $this->y; $ytmp++) {
			for ($xtmp = 0; $xtmp < $this->x; $xtmp++) {
				if ($xtmp == 4 && $ytmp == 20)
				{
					$this->board[$ytmp][$xtmp] = $this->player1->buildShip(array('name' => "Redful Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				}
				else if ($xtmp == 9 && $ytmp == 10)
				{
					$this->board[$ytmp][$xtmp] = $this->player1->buildShip(array('name' => "Blueful Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				}
				else if ($xtmp == 8 && $ytmp == 12)
				{
					$this->board[$ytmp][$xtmp] = $this->player1->buildShip(array('name' => "Kind Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				}
				else if ($xtmp == 10 && $ytmp == 15)
				{
					$this->board[$ytmp][$xtmp] = $this->player2->buildShip(array('name' => "Bad Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				}
				else if ($xtmp == 135 && $ytmp == 15)
				{
					$this->board[$ytmp][$xtmp] = $this->player2->buildShip(array('name' => "Bad Vengeance", 'x' => $xtmp, 'y' => $ytmp));
				}
				else
					$this->board[$ytmp][$xtmp] = 0;
			}
		}
	}
}
?>
