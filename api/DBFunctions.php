<?php

class DBFunctions {

	// constructor
	function __construct() {
		require_once 'DBConnect.php';

		// connecting to database
		$db = new DBConnect();
		$db = $db->connect();
		return $db;
	}

	// destructor
	function __destruct() {

	}

  //register an accident
  public function registerAccident(){

  }

  //returns the number of accidents in the area
  public function alert(){

  }

	public function recordIncident($latitude, $longitude, $crash_severity, $notes, $time, $date) {

		$db = $this->__construct();

		$result = array('code' => -1);

		$query = $db->query("INSERT INTO bike_crash(latitude, longitude, crash_severity, notes, time, date) VALUES('$latitude',
			'$longitude', '$crash_severity', '$notes', '$time', '$date')") or die(mysqli_error($db));

		if($query){
			$result['code'] = 0;
		}

		return $result;
	}

	public function retrieveIncident($latitude, $longitude){
		$db = $this->__construct();

		$result = array('code' => -1);

		$query = $db->query("SELECT COUNT(DISTINCT bc.longitude) AS count FROM(SELECT * FROM bike_crash HAVING ABS(latitude - '$latitude') < 0.001
		AND ABS(longitude - '$longitude') < 0.001) AS bc") or die(mysqli_error($db));

		if($query){
			$result['code'] = 0;
			$result = array_merge($result, $query->fetch_array(MYSQLI_ASSOC));
		}

		return $result;
	}

	public function accidentPositions($topLat, $botLat, $leftLong, $rightLong){
		$db = $this->__construct();

		$result = array('code' => -1);

		$query = $db->query("SELECT latitude, longitude FROM bike_crash HAVING latitude <= $topLat
		AND latitude >= $botLat AND longitude >= $leftLong
		AND longitude <= $rightLong") or die(mysqli_error($db));

		if($query){
			$positions = [];
			while($row = $query->fetch_assoc()) {
				$positions[] = $row;
			}
			$result['code'] = 0;
			$result['positions'] = $positions;
		}
		return $result;
	}
}
