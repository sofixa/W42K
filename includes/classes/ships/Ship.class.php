<?php
class Ship {

	protected $names = array("Wrath Of The Righteous", "Rightful Vengeance", "Smite Of Terra");
	public $width;
	public $height;
	public $position;
	public $health;
	public $power;
	public $speed;
	public $maneuver;
	public $armor;
	public $weapons;
	public $sid;
	public $gid;
	public $uid;
	public $x;
	public $y;
	public $dir;
	public $type;
	public $alive;
	private $dirs = array("N", "S", "W", "E");

	public function __construct($con, $sid) {
		$this->sid = $sid;
		$this->con = $con;
		if ($this->sid != 0) {
			$query = "SELECT * FROM ships WHERE sid = ? LIMIT 1";
			$sql = mysqli_prepare($this->con, $query);
			mysqli_stmt_bind_param($sql, 'd', $sid);
			if (!mysqli_stmt_execute($sql))
				die("Something went wrong3".mysqli_stmt_error($sql));
			mysqli_stmt_bind_result($sql, $this->sid, $this->name, $this->gid, $this->uid, $this->x, $this->y, $this->dir, $this->health, $this->power, $this->speed, $this->maneuver, $this->armor, $this->weapons, $this->width, $this->height, $this->type, $this->alive);
			if (!mysqli_stmt_fetch($sql))
				die ("Something went wrong".mysqli_stmt_error($sql));
			mysqli_stmt_free_result($sql);
			mysqli_stmt_close($sql);
		}
	}

	protected function generate_position() {
		$this->x = rand(0, 1500);
		$this->y = rand(0, 1000);
		$dir =  array_rand($this->dirs);
		$this->dir = $this->dirs[$dir];
	}

	public function print_all() {
		print_r(get_object_vars($this));
	}

	public function build($uid, $gid) {
		$this->generate_position();
		$alive = "alive";
		$query = "INSERT INTO ships (name, gid, uid, x, y, dir, health, power, speed, maneuver, armor, weapons, type, alive, height, width) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$sql = mysqli_prepare($this->con, $query);
		if (!mysqli_stmt_bind_param($sql, 'sddddsssssssdsdd', $this->name, $gid, $uid, $this->x, $this->y, $this->dir, $this->health, $this->power, $this->speed, $this->maneuver, $this->armor, $this->weapons, $this->type, $alive, $this->height, $this->width))
			echo "Something went wrong".mysqli_stmt_error($sql);
		if (!mysqli_stmt_execute($sql))
			echo "Something went wrong".mysqli_stmt_error($sql);
		$this->sid = mysqli_stmt_insert_id($sql);
		mysqli_stmt_free_result($sql);
		mysqli_stmt_close($sql);
	}

	public function update() {
		$query = "UPDATE ships SET name = ?, gid = ?, uid = ?, x = ?, y = ?, dir = ?, health = ?, power = ?, speed = ?, maneuver = ? , armor = ?, weapons = ? WHERE sid = ?";
		$sql = mysqli_prepare($this->con, $query);
		if (!mysqli_stmt_bind_param($sql, 'sddddsssssssd', $this->name, $this->gid, $this->uid, $this->x, $this->y, $this->dir, $this->health, $this->power, $this->speed, $this->maneuver, $this->armor, $this->weapons, $this->sid))
			echo "Something went wrong".mysqli_stmt_error($sql);
		if (!mysqli_stmt_execute($sql))
			echo "Something went wrong".mysqli_stmt_error($sql);
		mysqli_stmt_free_result($sql);
		mysqli_stmt_close($sql);
	}

	public static function doc() {
		if (file_exists("Ship.doc.txt"))
			return (file_get_contents("Ship.doc.txt"));
		else
			return ("Doc file missing");
	}

}
?>
