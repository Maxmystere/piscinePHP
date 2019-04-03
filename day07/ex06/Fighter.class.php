<?php
abstract class Fighter {
	abstract public function fight($target);
	function __construct($name) {
		$this->unitname = $name;
	}
}
?>
