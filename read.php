<?php

/**
 * Function to query information based on a
 *
 */

if ($_POST) 
{

	require_once "config.php";
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
		<h1>Simple database</h1>
		
		<?php 
		if ($_POST) 
		{
			if ($result && $statement->rowCount() > 0) 
			{ ?>
				<h2>Results</h2>

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
				foreach ($result as $row) 
				{ ?>
					<tr>
						<td><?php echo $row["id"]; ?></td>
						<td><?php echo $row["firstname"]; ?></td>
						<td><?php echo $row["lastname"]; ?></td>
						<td><?php echo $row["email"]; ?></td>
						<td><?php echo $row["age"]; ?></td>
						<td><?php echo $row["location"]; ?></td>
						<td><?php echo $row["date"]; ?> </td>
					</tr>
				<?php 
				} ?>
				</tbody>
			</table>
			<?php 
			} 
			else 
			{ ?>
				<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
			<?php
			} 
		}?> 
		
		<h2>Find user based on location</h2>
		
		<form method="post">
			<label for="location">Location</label>
			<input type="text" id="location" name="location">
			<input type="submit" value="View Results">
		</form>
		
		<div class="text-right"><a class="button muted-button" href="index.php">Back to home</a></div>
	</div>

</body>
</html>