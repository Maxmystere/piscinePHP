<?php
class UnholyFactory {
	static $slaves;
	function __construct() {
		self::$slaves = array();
	}
	public function absorb($target) {
		$add = 1;
		if (!$target->unitname)
		{
			print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
			return ;
		}
		foreach(self::$slaves as $slave)
		{
			if ($target->unitname == $slave->unitname)
				$add = 0;
		}
		if ($add)
		{
			print("(Factory absorbed a fighter of type " . $target->unitname . ")" . PHP_EOL);
			self::$slaves[$target->unitname] = $target;
		}
		else
			print("(Factory already absorbed a fighter of type " . $target->unitname . ")" . PHP_EOL);
	}
	static function fabricate($unitname) {
		foreach(self::$slaves as $slave)
		{
			if ($slave->unitname == $unitname)
			{
				print("(Factory fabricate a fighter of type " . $unitname . ")" . PHP_EOL);
				return (self::$slaves[$unitname]);
			}
		}
		print("(Factory hasn't absorbed any fighter of type " . $unitname . ")" . PHP_EOL);
	}
}
?>
