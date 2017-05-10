<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

if ($_POST) 
{

	require_once "config.php";
	require_once "common.php";

	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);

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

	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/primitive.css">
	<title>Create</title>

</head>

<body>

	<div class="small-container">
		<h1>Add a user</h1>

			<form method="post">
				<label for="firstname">First Name</label>
				<input type="text" name="firstname" id="firstname">
				<label for="lastname">Last Name</label>
				<input type="text" name="lastname" id="lastname">
				<label for="email">Email Address</label>
				<input type="text" name="email" id="email">
				<label for="age">Age</label>
				<input type="text" name="age" id="age">
				<label for="location">Location</label>
				<input type="text" name="location" id="location">
				<input type="submit" value="Submit">
			</form>
	</div>

</body>

</html>
