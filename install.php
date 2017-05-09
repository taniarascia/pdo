<?php

/**
 * Install database
 *
 */

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
		
    $sql = "CREATE DATABASE myDBPDO";
    // use exec() because no results are returned
    $connection->exec($sql);
    echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$connection = null;