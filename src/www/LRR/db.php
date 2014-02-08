<?php

// Configuration of the mysql connection
$host = "localhost";
$port = 3306;
$user = "";
$password = "";
$dbname = "";

/**
 * This function connects to a MySQL database and returns a connection object
 * configured for it
 *
 * @param string $host
 *        	Hostname of MySQL server
 * @param integer $port
 *        	Port number of MySQL server
 * @param string $user
 *        	User with access to database
 * @param string $password
 *        	Password for user
 * @param string $dbname
 *        	Name of the database to connect to
 * @return object MySQL Connection object which is connected to database
 */
function mysqlConnect($host, $port, $user, $password, $dbname) {
	
	// Not default port
	if ($port != 3306) {
		$connection = mysqli_connect ( $host . ":" . $port, $user, $password );
	} else {
		$connection = mysqli_connect ( $host, $user, $password );
	}
	
	// Select database
	if ($dbname != NULL) {
		mysqli_select_db ( $connection, $dbname );
	}
	
	// Error in connecting
	if (mysqli_connect_errno ()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error ();
		die ();
	}
	
	return $connection;
}

/**
 * This function creates the user table
 *
 * @param string $host
 *        	Hostname of MySQL server
 * @param integer $port
 *        	Port number of MySQL server
 * @param string $user
 *        	User with access to database
 * @param string $password
 *        	Password for user
 * @param string $dbname
 *        	Name of the database to connect to
 */
function createUsersTable($host, $port, $user, $password, $dbname) {
	
	// Connect to mysql server
	$connection = mysqlConnect ( $host, $port, $user, $password, $dbname );
	
	// SQL Expression to create users table
	$sql = 
	"CREATE TABLE users
	(
	ID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(ID),
	username TINYBLOB,
	password BLOB,
	email TINYBLOB
	);";
	
	// Execute query
	if (mysqli_query ( $connection, $sql )) {
		echo "Table users created successfully.<br>";
	} else {
		echo "Error creating table: " . mysqli_error ( $connection ) . "<br>";
	}
	
	// Close connection
	mysqli_close ( $connection );
}

/**
 * This function creates the devices table
 *
 * @param string $host
 *        	Hostname of MySQL server
 * @param integer $port
 *        	Port number of MySQL server
 * @param string $user
 *        	User with access to database
 * @param string $password
 *        	Password for user
 * @param string $dbname
 *        	Name of the database to connect to
 */
function createDevicesTable($host, $port, $user, $password, $dbname) {
	
	// Connect to mysql server
	$connection = mysqlConnect ( $host, $port, $user, $password, $dbname );
	
	// SQL Expression to create devices table
	$sql = 
	"CREATE TABLE devices
	(
	ID INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(ID),
	userid INT NOT NULL,
	name TINYBLOB
	);";
	
	// Execute query
	if (mysqli_query ( $connection, $sql )) {
		echo "Table devices created successfully.<br>";
	} else {
		echo "Error creating table: " . mysqli_error ( $connection ) . "<br>";
	}
	
	// Close connection
	mysqli_close ( $connection );
}

?>