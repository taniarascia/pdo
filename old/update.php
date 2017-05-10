<?php

/**
 * Update the database with the entries
 *
 */


function insert_into_database() {
	// Connection data
	include 'config.php';

	// Open connection
	$connection = new mysqli($host, $username, $password, $dbname);

	// Check connection, and show an error on failure
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}

	// Prepare and bind statement
	$statement = $connection->prepare("INSERT INTO users (firstname, lastname, email, age, location) VALUES (?, ?, ?, ?, ?)"); 

	// Set paramaters
	// s = string 
	// i = integer 
	$statement->bind_param("sssis", $firstname, $lastname, $email, $age, $location);

	// Put posted information into variables
	$firstname  = $_POST['firstname'];
	$lastname   = $_POST['lastname'];
	$email      = $_POST['email'];
	$age        = $_POST['age'];
	$location   = $_POST['location'];

	// Execute and close the statement
	$statement->execute();
	$statement->close();

	// Close connection
	$connection->close();
}

// Run function to insert into database
insert_into_database();