<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Function to query information and display table
 *
 */

//if ($_POST) 
//{

	require_once "config.php";
	require_once "common.php";

	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);

		/*$sql = "SELECT *
						FROM users
						WHERE location = :location";
		
		$statement = $connection->prepare($sql);
		
		$statement->execute(array(
			":location" => "Portland")
		);

		$result = $connection->query($sql);*/
		
	 $statement = $connection->prepare(
        'SELECT
           *
        FROM
            users
        WHERE
            location = :location'
    );
		
	$result = $statement->execute(
        array('location' => 'Portland', )
    );
		
	$row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row;

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

			<?php	
			} ?>

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

	catch(PDOException $e) 
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
//}

/*
if (isset($_POST['location'])) { 
	printRows($_POST['location']);
} else {
	echo "Error: No location selected. Please go back and enter a date.";
} */
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/primitive.css">
	<title>Read</title>

</head>

<body>

	<div class="small-container">
		<h1>Read</h1>

		<div class="row">
			<div class="offset-md-3 col-md-6">
				<form method="post">
					<label for="location">Location</label>
					<input type="text" id="location" name="location">
					<input type="submit" value="View Results">
				</form>
			</div>
		</div>
	</div>

</body>
</html>