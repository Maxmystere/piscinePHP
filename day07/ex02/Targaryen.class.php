<?PHP
class Targaryen {
	public function resistsFire() {
		return False;
	}
	public function getBurned() {
		if ($this->resistsFire())
			return "emerges naked but unharmed";
		return "burns alive";
	}
}
?>
