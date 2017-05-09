<?php

require_once 'pdo.config.php';

try 
{
	$connection = new PDO("mysql:host=$host", $username, $password,
		array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		)
	);
	
	$sql = 'CREATE DATABASE test';
	$connection->exec($sql);
	echo 'Database created successfully<br>';
}

catch(PDOException $e)
{
	echo $sql . '<br>' . $e->getMessage();
}