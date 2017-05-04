<?php

/**
 * Update the table with the entries
 *
 */

function updateTable() {
	
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
		
	$sql = "INSERT INTO users (firstname, lastname, email, age, location)
				 	VALUES (:firstname, :lastname, :email, :age, :location)";
		
	$statement = $connection->prepare($sql);
		
	$statement->execute(array(
			"firstname" => $_POST['firstname'],
			"lastname"  => $_POST['lastname'],
			"email"     => $_POST['email'],
			"age"       => $_POST['age'],
			"location"  => $_POST['location']
	));
		
	}
	
	catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
}

// Run function to insert into database
updateTable();
