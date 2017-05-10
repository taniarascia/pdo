<?php

/**
 * Function to query information and display table
 *
 */

function printRows($location) {
	
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
	
	// custom query
	/*$sql = "SELECT * FROM users WHERE location = :location";
	
	$statement = $connection->prepare($sql);
		
	$statement->execute(
		array(':location' => 'Chicago')
	); */
		
$sth = $connection->prepare('SELECT *
    FROM users
    WHERE location = :location');
$sth->execute(array(':location' => 'Chicago'));
		
	$result = $connection->query($sql);

	if ($result->num_rows > 0) { ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email Address</th>
						<th>Age</th>
						<th>Location</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody> 
				
<?php
			while ($row = $statement->fetch()) {
				// place all rows into an array
				$rows[] = $row;
			}
			// echo out each row as a table item
			foreach ($rows as $row) { ?>
				<tr>
					<td><?php echo $row["id"]; ?></td>
					<td><?php echo $row["firstname"]; ?></td>
					<td><?php echo $row["lastname"]; ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row["age"]; ?></td>
					<td><?php echo $row["location"]; ?></td>
					<td><?php echo $row["date"]; ?> </td></tr>
					
<?php	} ?>
	
		</table>
		
		<form method="post" action="export-csv.php">
			<input type="hidden" name="location" value="<?php echo $location; ?>">
			<input class="btn btn-primary" type="submit" value="Download CSV File">
		</form>
		
<?php
		
	} else { 
			echo "No entries found.";
	}

}
	catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
}

if (isset($_POST['location'])) { 
	printRows($_POST['location']);
} else {
		echo "Error: No location selected. Please go back and enter a date.";
} 
