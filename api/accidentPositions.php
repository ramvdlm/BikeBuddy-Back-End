<?php
/**
PHP Accident Positions script
Code -1 : Internal Error
Code 0 : Successfully found all accident positions
*/

// Create errorMessageMap
$errorMessages = array(-1 => 'Internal Error', 0 => 'Successfully found all accident positions');

// Get request
$request = $_POST;

// Create response array
$response = array('function' => 'Accident positions', 'code' => -1, 'message' => 'Internal Error');

// Include Database handler
require_once 'include/DBFunctions.php';
$db = new DBFunctions();

// Retrieve parameters
$topLat = $request['topLat'];
$botLat = $request['botLat'];
$leftLong = $request['leftLong'];
$rightLong = $request['rightLong'];

//Get the team data
$result = $db->accidentPositions($topLat, $botLat, $leftLong, $rightLong);

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
