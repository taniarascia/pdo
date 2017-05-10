<?php

/**
 * Function to query information and display table
 *
 */

//if ($_POST) 
//{

	require_once realpath(__DIR__) . "/config.php";
	require_once "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		/*$sql = "SELECT *
						FROM users
						WHERE location = :location";
		
		$statement = $connection->prepare($sql);
		
		$statement->execute(array(
			":location" => "Portland")
		);

		$result = $connection->query($sql);*/
$loc = "Portland";

$sql= "SELECT * FROM users WHERE location = :location";
$stmt = $connection->prepare($sql);
$stmt->bindParam(':location', $loc, PDO::PARAM_STR);
$stmt->execute();

$result = $stmt->fetchAll();

foreach($result as $row){
    echo "<li>{$row['location']}</li>";
}

/*$total = $stmt->rowCount();

while ($row = $stmt->fetchObject()) {
   echo $row->location;
}*/