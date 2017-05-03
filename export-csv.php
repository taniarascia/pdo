<?php

/**
 * Download CSV file 
 *
 */

function downloadCSV($location) {
	// Connection data
	include 'config.php';

	// Create connection
	$connection = new mysqli($host, $username, $password, $dbname);

	// Check connection
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	
	// Prepare query
	$statement = "SELECT id, firstname, lastname, email, age, location, date FROM users WHERE location = '$location'";
	$result = $connection->query($statement);

	// Open file stream for writing, and create if not exists
	$file_pointer = fopen('result.csv', 'w');

	// Make an array with the headers
	$headers = array(
		'id', 
		'First Name', 
		'Last Name', 
		'Email', 
		'Age', 
		'Location', 
		'Date',
	);

	// Insert header column
	fputcsv($file_pointer, $headers);

	// Fetch associative array 
	while ($row = $result->fetch_assoc()) {
		fputcsv($file_pointer, $row);
	}

	// Close stream
	fclose($file_pointer);
	
	// Output headers so that the file is downloaded rather than displayed
	header("Content-type: text/csv");
	header("Content-disposition: attachment; filename = result.csv");
	readfile("result.csv");

	// Close the database connection
	$connection->close();
	
}

downloadCSV($_POST['location']);