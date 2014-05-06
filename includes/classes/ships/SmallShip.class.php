<?php
require_once("Ship.class.php");

class SmallShip extends Ship {
	public function __construct($con, $sid) {
		parent::__construct($con, $sid);
	}

	public function create($uid, $gid) {
		$rand = array_rand($this->names);
		$this->name = $this->names[$rand];
		$this->width = 30;
		$this->height = 10;
		$this->health = 5;
		$this->power = 10;
		$this->speed = 20;
		$this->maneuver = 2;
		$this->armor = 0;
		$this->weapons = 2;
		$this->type = 1;
		$this->uid = $uid;
		$this->gid = $gid;
		parent::build($uid, $gid);
	}
	public static function doc() {
		if (file_exists("SmallShip.doc.txt"))
			return (file_get_contents("SmallShip.doc.txt"));
		else
			return ("Doc file missing");
	}
}
?>
