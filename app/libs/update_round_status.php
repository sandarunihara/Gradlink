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

		// Set all rounds to inactive
		$db->query("UPDATE round SET active = 0");

		// Set the correct round to active
		$db->query("UPDATE round SET active = 1 WHERE '$today' BETWEEN `startDate` AND `endDate`");

		$db->close();
	}
}
