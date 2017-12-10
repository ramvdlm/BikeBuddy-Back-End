<?php
/**
Create court_game table
**/

// Include Database handler
require_once 'include/DBConnect.php';
$db = new DBConnect();
$query = "DROP TABLE IF EXISTS bike_crash;";
$query .= "CREATE TABLE bike_crash (
	latitude double() NOT NULL,
	longitude double() NOT NULL,
	crash_severity ENUM('Major', 'Minor', 'Near Miss'),
	notes varchar() NOT NULL,
	time varchar(10) NOT NULL,
	date date() NOT NULL
)";

$db->connect()->multi_query($query);

?>
