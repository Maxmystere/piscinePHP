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
		$this->hp = 10;
		$this->maxhp = 10;
		$this->pp = 5;
		$this->maxpp = 5;
		$this->speed = 2;
		$this->manu = 3;
		$this->team = $kwargs['team'];
		$this->id = $kwargs['id'];
		$this->x = $kwargs['x'];
		$this->y = $kwargs['y'];
		$this->rot = ($this->team == 1 ? 3 : 1);
	}
}
?>
