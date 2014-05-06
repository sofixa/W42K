<?php
require_once("Ship.class.php");

class BigShip extends Ship {
	public function __construct($con, $sid) {
		parent::__construct($con, $sid);
	}

	public function create($uid, $gid) {
		$rand = array_rand($this->names);
		$this->name = $this->names[$rand];
		$this->width = 60;
		$this->height = 20;
		$this->health = 25;
		$this->power = 10;
		$this->speed = 10;
		$this->maneuver = 8;
		$this->armor = 0;
		$this->weapons = 8;
		$this->type = 3;
		$this->uid = $uid;
		$this->gid = $gid;
		parent::build($uid, $gid);
	}
	public static function doc() {
		if (file_exists("BigShip.doc.txt"))
			return (file_get_contents("BigShip.doc.txt"));
		else
			return ("Doc file missing");
	}
}
?>
