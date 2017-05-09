<?php

/**
 * Open PDO connection
 *
 */

function openPDO() {

	return new PDO("mysql:host=$host;dbname=$dbname;", $username, $password,
		array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		)
	);
}