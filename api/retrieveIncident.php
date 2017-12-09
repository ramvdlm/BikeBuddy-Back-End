<?php
/**
PHP Retrieve Incident script
Code -1 : Internal Error
Code 0 : Successfully retrieved incident
*/

// Create errorMessageMap
$errorMessages = array(-1 => 'Internal Error', 0 => 'Successfully retrieved incident');

// Get request
$request = $_POST;

// Create response array
$response = array('function' => 'Retrieve Incident', 'code' => -1, 'message' => 'Internal Error');

// Include Database handler
require_once 'include/DBFunctions.php';
$db = new DBFunctions();

// Retrieve parameters
$latitude = $request['latitude'];
$longitude = $request['longitude'];

//Get the team data
$result = $db->retrieveIncident($latitude, $longitude);

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
