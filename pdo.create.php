<?php

/**
 * Create a new database table with corresponding structure
 *
 */

function createTable() {
	
	// Connection data
	include "pdo.config.php";
	
	try {
	
	// Open PDO connection
	$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password,
		array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_PERSISTENT => false,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
		)
	);
		
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
	
	catch(PDOException $e) 	{
		
		// Fail message
		echo $sql . "<br>" . $e->getMessage();
	}
}

// Run function to create new table
createTable(); 