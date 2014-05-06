<?php
class Game {
	public $gid;
	private $con;
	public $uid1;
	public $uid2;
	public $uid3;
	public $uid4;
	public $name;

	public function __construct($con, $gid) {
		$this->con = $con;
		$this->gid = $gid;
		if ($this->gid != 0) {
			$query = "SELECT gid, game, uid1, uid2, uid3, uid4 FROM games WHERE gid = ? LIMIT 1";
			$sql = mysqli_prepare($this->con, $query);
			mysqli_stmt_bind_param($sql, 'd', $this->gid);
			if (!mysqli_stmt_execute($sql))
				die("Something went wrong".mysqli_stmt_error($sql));
			mysqli_stmt_bind_result($sql, $this->gid, $this->name, $this->uid1, $this->uid2, $this->uid3, $this->uid4);
			if (!mysqli_stmt_fetch($sql))
				die ("Something went wrong".mysqli_stmt_error($sql));
			mysqli_stmt_free_result($sql);
			mysqli_stmt_close($sql);
		}
	}

	public function addPlayer($uid) {
		mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_STRICT);
		$query1 = "UPDATE games SET uid2 = ? WHERE gid = ?";
		if(!$sql1 = mysqli_prepare($this->con, $query1))
				echo "Something went wrong1".mysqli_error($sql1);
		mysqli_stmt_bind_param($sql1, 'dd', $uid, $this->gid);
		if (!mysqli_stmt_execute($sql1))
				echo "Something went wrong2".mysqli_stmt_error($sql1);
		mysqli_stmt_free_result($sql1);
		mysqli_stmt_close($sql1);	
		
	}
	
	private function asteroids($num) {
		for($i = 0; $i < $num; $i++) {
			$x = rand(0, 1500);
			$y = rand(1, 1000);
			$alive = "alive";
			$dir = "S";
			$uid = 1;
			$health = 50;
			$power = 20;
			$speed = 0;
			$name = "Asteroid";
			$maneuver = 0;
			$armor = 0;
			$weapons = 0;
			$height = rand(1, 3);
			$width = rand(2, 10);
			$type = 4;
			$query = "INSERT INTO ships (name, gid, uid, x, y, dir, health, power, speed, maneuver, armor, weapons, type, alive, height, width) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$sql = mysqli_prepare($this->con, $query);
			if (!mysqli_stmt_bind_param($sql, 'sddddsssssssdsdd', $name, $this->gid, $uid, $x, $y, $dir, $health, $power, $speed, $maneuver, $armor, $weapons, $type, $alive, $height, $width))
				echo "Something went wrong".mysqli_stmt_error($sql);
			if (!mysqli_stmt_execute($sql))
				echo "Something went wrong".mysqli_stmt_error($sql);
			$this->sid = mysqli_stmt_insert_id($sql);
			mysqli_stmt_free_result($sql);
			mysqli_stmt_close($sql);
		}
	}

	public function createGame($name, $uid1, $uid2, $uid3, $uid4) {
		$query = "INSERT INTO games (game, uid1, uid2, uid3, uid4) VALUES (?, ?, ?, ?, ?)";
		$sql = mysqli_prepare($this->con, $query);
		if (!mysqli_stmt_bind_param($sql, 'sdddd', $name, $uid1, $uid2, $uid3, $uid4))
			echo "Something went wrong".mysqli_stmt_error($sql);
		if (!mysqli_stmt_execute($sql))
			echo "Something went wrong".mysqli_stmt_error($sql);
		$this->gid = mysqli_stmt_insert_id($sql);
		mysqli_stmt_free_result($sql);
		mysqli_stmt_close($sql);
		$this->asteroids(rand(1, 10));
	}

	public static function doc() {
		if (file_exists("Game.doc.txt"))
			return (file_get_contents("Game.doc.txt"));
		else
			return ("Doc file missing");
	}
}
?>
