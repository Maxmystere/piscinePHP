<?php
class Tyrion extends Lannister {
	public function sleepWith($person) {
		if (get_class($person) == "Sansa")
			print("Let's do this." . PHP_EOL);
		else
			print("Not even if I'm drunk !" . PHP_EOL);
	}
}
?>
