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
	ambulance ENUM('yes', 'no'),
	biker_age int(3) NOT NULL,
	bike_direction ENUM('With Traffic', 'Facing Traffic', 'N/A', 'Unknown'),
	biker_injury ENUM('A: Disabling Injury', 'B: Evident Injury',
		'C: Possible Injury', 'O: No Injury', 'Unknown Injury', 'K: Killed'),
	bike_position ENUM('Travel Lane', 'Multi-use Path', 'Non-Roadway', 'Bike Lane / Paved Shoulder',
		'Sidewalk / Crosswalk / Driveway Crossing', 'Unknown')
	biker_race ENUM('Asian', 'White', 'Black', 'Other', 'Unknown/Missing', 'Native American', 'Hispanic'),
	biker_sex ENUM('Male', 'Female', 'Unknown', 'Other'),
	city ENUM('Chapel Hill', 'Carrboro', 'None - Rural Crash', 'Durham'),
	county ENUM('Orange', 'Durham', 'Chatham'),
	day ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
	location_of_crash ENUM('Intersection', 'Intersection-Related', 'Non-Intersection'),
	month ENUM('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
		'September', 'October', 'November', 'December'),
	time varchar(10) NOT NULL
)";

$db->connect()->multi_query($query);

?>
