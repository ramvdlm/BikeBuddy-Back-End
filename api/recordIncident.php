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
$crash_severity = $request['crash_severity'];
$notes = $request['notes'];
$time = $request['time'];
$date = $request['date'];

//Get the team data
$result = $db->recordIncident($latitude, $longitude, $crash_severity, $notes, $time, $date);

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
