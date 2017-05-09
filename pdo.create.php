<?php

/**
 * Create a new database table with corresponding structure
 *
 */

require_once "pdo.config.php";
require_once "common.php";

function createTable() 
{
	
	try 
	{
		$connection = openPDO();
		
		// Prepare SQL statement
		$sql = "CREATE TABLE users (
					id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
					firstname VARCHAR(30) NOT NULL,
					lastname VARCHAR(30) NOT NULL,
					email VARCHAR(50) NOT NULL,
					age INT(3),
					location VARCHAR(50),
					date TIMESTAMP
					)";

		// Success message
		$connection->exec($sql);
			echo "Table users created successfully";
	} 
	
	catch(PDOException $e) 
	{
		// Fail message
		echo $sql . "<br>" . $e->getMessage();
	}
	
}

// Run function to create new table
createTable(); 