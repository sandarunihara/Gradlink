<?php

class RoundStatusUpdater
{
	public static function update()
	{
		require_once("../app/core/config.php");

		$db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

		if ($db->connect_error) {
			die("Database connection failed: " . $db->connect_error);
		}

		$today = date("Y-m-d");

		// Set all rounds to inactive first
		$db->query("UPDATE round SET active = 0");

		// Activate the round that matches today's date
		$result = $db->query("UPDATE round SET active = 1 WHERE '$today' BETWEEN `startDate` AND `endDate`");

		// If no rows were affected, set the 'None' row as active
		if ($db->affected_rows == 0) {
			$db->query("UPDATE round SET active = 1 WHERE round = 'None'");
		}

		$db->close();
	}
}
