<?php
/**
PHP Record Incident script
Code -1 : Internal Error
Code 0 : Successfully created incident report
*/

// Create errorMessageMap
$errorMessages = array(-1 => 'Internal Error', 0 => 'Successfully recorded incident');

// Get request
$request = $_POST;

// Create response array
$response = array('function' => 'Record incident', 'code' => -1, 'message' => 'Internal Error');

// Include Database handler
require_once 'include/DBFunctions.php';
$db = new DBFunctions();

// Retrieve parameters
$latitude = $request['latitude'];
$longitude = $request['longitude'];
$ambulance = $request['ambulance'];
$biker_age = $request['biker_age'];
$bike_direction = $request['bike_direction'];
$biker_injury = $request['biker_injury'];
$bike_position = $request['bike_position'];
$biker_race = $request['biker_race'];
$biker_sex = $request['biker_sex'];
$city = $request['city'];
$county = $request['county'];
$day = $request['day'];
$location_of_crash = $request['location_of_crash'];
$month = $request['month'];
$time = $request['time'];

//Get the team data
$result = $db->recordIncident($latitude, $longitude, $ambulance, $biker_age, $bike_direction, $bike_position,
  $biker_race, $biker_sex, $city, $county, $day, $location_of_crash, $time);

// Build response
if($result) {
  $response['code'] = $result['code'];
  $response['message'] = $errorMessages[$response['code']];

  if($response['code'] == 0) {
    $response = array_merge($response, $result);
  }

}

// Return response
echo json_encode($response);
?>
