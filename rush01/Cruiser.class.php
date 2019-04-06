<?php
require_once 'Ship.class.php';
class Cruiser extends Ship
{
	function __construct(array $kwargs)
	{
		$this->name = $kwargs['name'];
		$this->width = 2;
		$this->length = 6;
		$this->imgid = 2;
		$this->maxhp = 10;
		$this->hp = $this->maxhp;
		$this->maxpp = 5;
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
