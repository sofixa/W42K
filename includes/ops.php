<?php
function __autoload($name) {
	require_once("classes/ships/".$name.".class.php");
	}
require_once("classes/game/Game.class.php");

if (file_exists("conf.php"))
	include_once("conf.php");

if (isset($_GET['action']) && $_GET['action'] == "getShip" && is_numeric($_GET['gid'])) {
	if(!$sql = mysqli_query($con, "SELECT * FROM ships WHERE gid = ".$_GET['gid'].";"))
		echo mysqli_error($sql);
	while($results = mysqli_fetch_assoc($sql))
	{
		if ($results["dir"] === "S" || $results["dir"] === "N") {
			$test = $results['height'];
			$results['height'] = $results['width'];
			$results['width'] = $test;
		}
		$tab[] = $results;
	}
	echo (json_encode($tab));
}

else if (isset($_GET['action']) && $_GET['action'] === "updateShip") {
	$ship = new Ship($con, intval($_GET['sid']));
	$ship->x = intval($_GET['x']);
	$ship->y = intval($_GET['y']);
	$ship->dir = $_GET['dir'];
	$ship->health = intval($_GET['health']);
	$ship->power = intval($_GET['power']);
	$ship->speed = intval($_GET['speed']);
	$ship->armor = intval($_GET['armor']);
	$ship->weapons = intval($_GET['weapons']);
	$ship->update();
}

else if (isset($_GET['action']) && $_GET['action'] == "selectShip") {
	$_SESSION['selectedShip'] = $_GET['sid'];
}

else if (isset($_GET['action']) && $_GET['action'] == "getGames") {
	if(!$sql = mysqli_query($con, "SELECT * FROM games"))
		echo mysqli_error($sql);
?>
<table border="1" id="tablee">
<tr><th>ID</th><th>Game name</th><th>Player 1</th><th>Player 2</th><th>Player 3</th><th>Player 4</th><th>Join</th></tr>
<?php
	while($results = mysqli_fetch_assoc($sql))
	{
		echo "<tr><td>".$results['gid']."</td><td>".$results['game']."</td><td>".$results['uid1']."</td><td>".$results['uid2']."</td><td>".$results['uid3']."</td><td>".$results['uid4']."</td><td><button onclick='joinGame(".$results['gid'].",".$_SESSION['uid'].");' >Join</button></td></tr>";
	}
}

else if (isset($_GET['action']) && $_GET['action'] == "createGame" && is_numeric($_GET['uid1'])) {
	$game = new Game($con, 0);
	$game->createGame($_GET['name'], $_GET['uid1'], NULL, NULL, NULL);
	$_SESSION['gid'] = $game->gid;
	$ship1 = new SmallShip($con, 0);
	$ship1->create($_GET['uid1'], $game->gid);
	$ship2 = new MediumShip($con, 0);
	$ship2->create($_GET['uid1'], $game->gid);
	$ship3 = new BigShip($con, 0);
	$ship3->create($_GET['uid1'], $game->gid);
}

else if (isset($_GET['action']) && $_GET['action'] == "joinGame" && is_numeric($_GET['gid'])) {
	$game = new Game($con, $_GET['gid']);
	$game->addPlayer($_GET['uid']);
	$_SESSION['gid'] = $_GET['gid'];
	$ship1 = new SmallShip($con, 0);
	$ship1->create($_GET['uid'], $_GET['gid']);
	$ship2 = new MediumShip($con, 0);
	$ship2->create($_GET['uid'], $_GET['gid']);
	$ship3 = new BigShip($con, 0);
	$ship3->create($_GET['uid'], $_GET['gid']);
}



?>
