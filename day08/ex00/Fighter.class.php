<?php
require_once 'Ship.class.php';
class Fighter extends Ship
{
	function __construct(array $kwargs)
	{
		$this->name = $kwargs['name'];
		$this->width = 1;
		$this->length = 2;
		$this->imgid = 1;
		$this->maxhp = 5;
		$this->hp = $this->maxhp;
		$this->maxpp = 6;
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
