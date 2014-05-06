<?php
require_once("Ship.class.php");

class MediumShip extends Ship {
	public function __construct($con, $sid) {
		parent::__construct($con, $sid);
	}

	public function create($uid, $gid) {
		$rand = array_rand($this->names);
		$this->name = $this->names[$rand];
		$this->width = 50;
		$this->height = 10;
		$this->health = 10;
		$this->power = 15;
		$this->speed = 15;
		$this->maneuver = 4;
		$this->armor = 0;
		$this->weapons = 5;
		$this->type = 2;
		$this->uid = $uid;
		$this->gid = $gid;
		parent::build($uid, $gid);
	}
	public static function doc() {
		if (file_exists("MediumShip.doc.txt"))
			return (file_get_contents("MediumShip.doc.txt"));
		else
			return ("Doc file missing");
	}
}
?>
