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
	function setShipSize()
	{
		$this->pp = 42;
	}
	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Ship.doc.txt", true));
	}
}
?>
