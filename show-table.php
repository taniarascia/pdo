<?php

/**
Function to queried information from the database and display in a table.
*/

// return rows by the date selected
function returnRows($location) {
	
	// Connection data
	include 'config.php';

	// Create connection
	$connection = new mysqli($host, $username, $password, $dbname);
	
	// Check connection, and show an error on failure
	if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
	} 
	
	// custom query
	$sql = "SELECT * FROM users WHERE location = '$location'";
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
			while ($row = $result->fetch_array()) {
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
		
<?php } else { ?>
	
		<p>No entries found for <?php echo $location; ?></p>
		
<?php } 

	//return $row; 
	$connection->close();
}

if (isset($_POST['location'])) { 
	
	// Return function with selected date
	returnRows($_POST['location']);
	
} else { ?>

	<p>Error: No location selected. Please go back and enter a date.</p>
	
<?php } ?>