<?php
require_once 'Ship.class.php';
class Flagship extends Ship
{
	function __construct(array $kwargs)
	{
		$this->name = $kwargs['name'];
		$this->width = 3;
		$this->length = 10;
		$this->imgid = 3;
		$this->maxhp = 20;
		$this->hp = $this->maxhp;
		$this->maxpp = 4;
		$this->pp = $this->maxpp;
		$this->speed = 2;
		$this->manu = 3;
		$this->x = $kwargs['x'];
		$this->y = $kwargs['y'];
		$this->team = $kwargs['team'];
		$this->rot = ($this->team == 1 ? 3 : 1);
	}
}
?>
