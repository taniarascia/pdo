<?php
$host = "localhost";
$username = "root";
$password = "root";

try 
{
	$connection = new PDO("mysql:host=$host", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE DATABASE testing";
	// use exec() because no results are returned
	$conn->exec($sql);
	echo "Database created successfully<br>";
}
catch(PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
