<?php
if ($_POST['login'] == "" || $_POST['oldpw'] == "" || $_POST['newpw'] == "" || $_POST['submit'] != "OK")
	echo "ERROR\n";
else
{
	$filename = "../private/passwd";
	$dirname = "../private";
	$login = $_POST['login'];
	$new_pass = hash('whirlpool', $_POST['newpw']);
	$old_pass = hash('whirlpool', $_POST['oldpw']);
	$error = "OK";
	$check = 0;
	if (!file_exists($dirname))
		$error = "ERROR";
	if (file_exists($filename))
	{
		$stock = unserialize(file_get_contents($filename));
		foreach ($stock as $key => $value)
		{
			if ($login == $stock[$key]['login'] && ($old_pass != $stock[$key]['passwd'] || $old_pass === $new_pass))
				$error = "ERROR";
			elseif ($login == $stock[$key]['login']) {
				$check = 1;
				$stock[$key]['passwd'] = $new_pass;
				file_put_contents($filename, serialize($stock));
			}
		}
		if ($check !== 1)
			$error = "ERROR";
	}
	echo $error."\n";
}
?>