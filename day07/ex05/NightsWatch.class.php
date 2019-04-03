<?php
class NightsWatch {
	static $members;
	function __construct() {
		self::$members = array();
	}
	public function recruit($newmember) {
		self::$members[] = $newmember;
	}
	public function fight() {
		foreach(self::$members as $member)
		{
			if (class_implements($member)["IFighter"])
				$member->fight();
		}
	}
}
?>
