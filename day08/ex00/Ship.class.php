<?php
class Ship
{
	public $team; // Quel cote
	public $id;
	public $name; // Cool name
	public $width; // Largeur du vaisseau
	public $length; // Longueur du vaisseau
	public $imgid; // Image to load
	public $hp; // Points de vie
	public $maxhp; // Points de vie
	public $pp; // Puissance de moteur
	public $maxpp; // Puissance de moteur
	public $speed; // Vitesse
	public $manu; // Manoeuvrabilite
	public $shield; // Bouclier
	public $wpns; // array d'armes
	public $x;
	public $y;
	public $rot;

	function __construct(array $kwargs)
	{
		if (!array_key_exists('name', $kwargs) || !array_key_exists('width', $kwargs) || !array_key_exists('length', $kwargs)
		|| !array_key_exists('imgid', $kwargs) || !array_key_exists('hp', $kwargs) || !array_key_exists('pp', $kwargs) || !array_key_exists('team', $kwargs)
		|| !array_key_exists('speed', $kwargs) || !array_key_exists('manu', $kwargs) || !array_key_exists('id', $kwargs)
		|| !array_key_exists('x', $kwargs) || !array_key_exists('y', $kwargs))
		{
			print("Error missing arguments" . PHP_EOL);
			return (0);
		}
		$this->name = $kwargs['name'];
		$this->width = $kwargs['width'];
		$this->length = $kwargs['length'];
		$this->imgid = $kwargs['imgid'];
		$this->hp = $kwargs['hp'];
		$this->maxhp = $kwargs['hp'];
		$this->pp = $kwargs['pp'];
		$this->maxpp = $kwargs['pp'];
		$this->speed = $kwargs['speed'];
		$this->manu = $kwargs['manu'];
		$this->team = $kwargs['team'];
		$this->id = $kwargs['id'];
		$this->x = $kwargs['x'];
		$this->y = $kwargs['y'];
		$this->rot = ($this->team == 1 ? 3 : 1);
		//$this->wpns = $kwargs['wpns'];
	}
	function getShipSize()
	{
		$tmp['width'] = $this->width;
		$tmp['length'] = $this->length;
		return ($tmp);
	}
	function getRotation()
	{
		return ($this->rot);
	}
	function setRotation($newrot)
	{
		if ($newrot && $newrot < 5 && ($this->rot = $newrot + 1 || $this->rot = $newrot - 1))
		{
			$this->rot = $newrot;
			if ($this->rot == 1)
				$this->y--;
			else if ($this->rot == 2)
				$this->x++;
			else if ($this->rot == 3)
				$this->y++;
			else if ($this->rot == 4)
				$this->x--;
		}
	}
	function moveForward($newpos)
	{
		if ($this->rot == 1)
			$this->y -= $newpos;
		else if ($this->rot == 2)
			$this->x += $newpos;
		else if ($this->rot == 3)
			$this->y += $newpos;
		else if ($this->rot == 4)
			$this->x -= $newpos;
	}
	function useEnergy($needpp)
	{
		if ($needpp <= $this->pp)
		{
			$this->pp -= $needpp;
			return (true);
		}
		return (false);
	}
	function getEnergy()
	{
		return ($this->pp);
	}
	function refuelEnergy()
	{
		$this->pp = $this->maxpp;
	}
	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Ship.doc.txt", true));
	}
}
?>
