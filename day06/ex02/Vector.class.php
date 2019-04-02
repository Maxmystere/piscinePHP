<?php
require_once 'Color.class.php';
require_once 'Vertex.class.php';
class Vector
{
	// déclaration d'une propriété
	public static $verbose;
	public $x = 0.0;
	public $y = 0.0;
	public $z = 0.0;
	public $w = 0.0;
	public $color = 0;

	// déclaration des méthodes
	public static function doc() {
		return (PHP_EOL.file_get_contents("Vector.doc.txt", true));
	}
	function __construct(array $kwargs) {
		
		if (array_key_exists('orig', $kwargs))
			$this->x = $kwargs['orig'];
		
		if (self::$verbose)
			printf("Vector( x: %.2f, y: %.2f, z:%.2f, w:%.2f ) constructed".PHP_EOL, $this->x, $this->y, $this->z, $this->w);
		return;
	}
	function __destruct() {
		if (self::$verbose)
			printf("Vector( x: %.2f, y: %.2f, z:%.2f, w:%.2f )", $this->x, $this->y, $this->z, $this->w);
		return;
	}
	function __toString() {
		return (sprintf("Vector( x: %.2f, y: %.2f, z:%.2f, w:%.2f )", $this->x, $this->y, $this->z, $this->w));
	}
}
?>
