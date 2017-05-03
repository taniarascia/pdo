<?php

/**
 * Create a new database table with corresponding structure
 *
 */

function create_new_table() {
	
	// Connection data
	include 'config.php';

	// Create connection
	$connection = new mysqli($host, $username, $password, $dbname);
	
	// Check connection, and show an error on failure
	if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
	} 

	// Prepare SQL statement
	$sql = 
	"CREATE TABLE users 
	(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	age INT(3),
	location VARCHAR(50),
	date TIMESTAMP
	)";

	if ($connection->query($sql) === true) {
			echo "Table users created successfully";
	} else {
			echo "Error creating table: " . $connection->error;
	}
	
	// Close connection
	$connection->close();
}

// Run function to create new table
create_new_table(); 