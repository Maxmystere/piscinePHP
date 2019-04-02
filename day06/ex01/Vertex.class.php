<?php
require_once 'Color.class.php';
class Vertex
{
	// déclaration d'une propriété
	public static $verbose;
	public $x = 0.0;
	public $y = 0.0;
	public $z = 0.0;
	public $w = 1.0;
	public $color = 0;

	// déclaration des méthodes
	public static function doc() {
		return (PHP_EOL.file_get_contents("Vertex.doc.txt", true));
	}
	function __construct(array $kwargs) {
		
		if (array_key_exists('x', $kwargs) && array_key_exists('y', $kwargs) && array_key_exists('z', $kwargs))
		{
			$this->x = $kwargs['x'];
			$this->y = $kwargs['y'];
			$this->z = $kwargs['z'];
		}
		else
			throw new Exception('Need x, y, z parameters');
		if (array_key_exists('w', $kwargs))
			$this->w = $kwargs['w'];
		if (array_key_exists('color', $kwargs))
			$this->color = clone $kwargs['color'];
		else
			$this->color = new Color( array( 'red' => 255, 'green' => 255, 'blue' => 255 ) );
		
		if (self::$verbose)
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, Color( red: %3u, green: %3u, blue: %3u ) ) constructed".PHP_EOL,
					$this->x, $this->y, $this->z, $this->w, $this->color->red, $this->color->green, $this->color->blue);
		return;
	}
	function __destruct() {
		if (self::$verbose)
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, Color( red: %3u, green: %3u, blue: %3u ) ) destructed".PHP_EOL,
				$this->x, $this->y, $this->z, $this->w, $this->color->red, $this->color->green, $this->color->blue);
		return;
	}
	function __toString() {
		if (self::$verbose)
			return (sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, Color( red: %3u, green: %3u, blue: %3u ) )",
				$this->x, $this->y, $this->z, $this->w, $this->color->red, $this->color->green, $this->color->blue));
		return (sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, )",
			$this->x, $this->y, $this->z, $this->w));
	}
}
?>
