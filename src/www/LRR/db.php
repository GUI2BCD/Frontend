<?php
/**
 * University of Massachusetts Lowell
 * GUI Programming II, Prof. Jesse Heines
 * 
 * Last Resort Recovery
 * Authors - David Jelley, Jr.
 *           Cameron Morris
 *           Benjamin Cao
 * 
 * Description: This file contains all the functionality related to interacting
 *              with the database.
 */

// MySQL variables
include_once 'config.php';

// Holds the connection to the database
$connection = mysqlConnect ( HOST, PORT, USER, PASSWORD, DATABASE );

/**
 * This function connects to a MySQL database and returns a connection object
 * configured for it
 *
 * @param string $host
 *          Hostname of MySQL server
 * @param integer $port
 *          Port number of MySQL server
 * @param string $user
 *          User with access to database
 * @param string $password
 *          Password for user
 * @param string $dbname
 *          Name of the database to connect to
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
 * This function will create a MySQL database with the given name
 * 
 * @param object $connection
 *          MySQL connection object
 * @param string $dbname
 *          Name of the database to create
 */
function createDatabase($connection, $dbname) {
  
  // Create database
  $sql = "CREATE DATABASE " . $dbname . ";";
  
  // Execute query
  if (mysqli_query ( $connection, $sql )) {
    echo "Database " . $dbname . " created successfully.<br>";
  } else {
    echo "Error creating database: " . mysqli_error ( $connection ) . "<br>";
  }
}

/**
 * This function creates the user table
 * 
 * @param object $connection
 *          MySQL connection object
 */
function createUsersTable($connection) {
  
  // Select database
  mysqli_select_db ( $connection, DATABASE );
  
  // SQL Expression to create users table
  $sql = "CREATE TABLE users
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
}

/**
 * This function creates the devices table
 * 
 * @param object $connection
 *          MySQL connection object
 */
function createDevicesTable($connection) {
  
  // Select database
  mysqli_select_db ( $connection, DATABASE );
  
  // SQL Expression to create devices table
  $sql = "CREATE TABLE devices
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
}

// Setup the database
if (isset ( $_GET ["action"] )) {
  if ($_GET ["action"] == "setup") {
    createDatabase ( $connection, DATABASE );
    createUsersTable ( $connection );
    createDevicesTable ( $connection );
  }
}

?>