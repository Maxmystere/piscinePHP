<?php
class Color
{
	// déclaration d'une propriété
	public static $verbose;
	public $red = 0x00;
	public $green = 0x00;
	public $blue = 0x00;

	// déclaration des méthodes
	public static function doc() {
		return (PHP_EOL.file_get_contents("Color.doc.txt", true));
	}
	function __construct(array $kwargs) {
		if (array_key_exists('rgb', $kwargs))
		{
			$this->red = $kwargs['rgb'] / 0x10000;
			$this->green = $kwargs['rgb'] % 0x10000 / 0x100;
			$this->blue = $kwargs['rgb'] % 0x100;
		}
		else
		{
			if (array_key_exists('red', $kwargs))
				$this->red = $kwargs['red'];
			if (array_key_exists('green', $kwargs))
				$this->green = $kwargs['green'];
			if (array_key_exists('blue', $kwargs))
				$this->blue = $kwargs['blue'];
		}
		if (self::$verbose)
			printf("Color( red: %3u, green: %3u, blue: %3u ) constructed.".PHP_EOL, $this->red, $this->green, $this->blue);
		return;
	}
	function __destruct() {
		if (self::$verbose)
			printf("Color( red: %3u, green: %3u, blue: %3u ) destructed.".PHP_EOL, $this->red, $this->green, $this->blue);
		return;
	}
	function __toString() {
		return (sprintf("Color( red: %3u, green: %3u, blue: %3u )", $this->red, $this->green, $this->blue));
	}
}
?>
