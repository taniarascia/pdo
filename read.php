<?php

/**
 * Function to query information and display table
 *
 */

if ($_POST) 
{

	require_once realpath(__DIR__) . "/config.php";
	require_once "common.php";

	$connection = new PDO($dsn, $username, $password, $options);

	$sql= "SELECT * 
         FROM users
         WHERE location = :location";
	
	$location = $_POST['location'];

	$statement = $connection->prepare($sql);
	$statement->bindParam(':location', $location, PDO::PARAM_STR);
	$statement->execute();

	$result = $statement->fetchAll();

	foreach($result as $row){
			echo "<li>{$row['location']}</li>";
	}
	
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Read</title>
	
	<link rel="stylesheet" href="css/primitive.css">

</head>

<body>

	<div class="small-container">
		<h1>Read</h1>
		
		<form method="post">
			<label for="location">Location</label>
			<input type="text" id="location" name="location">
			<input type="submit" value="View Results">
		</form>
	</div>

</body>
</html>
