<?php

session_start();

include 'connectionDB.php';
require realpath(__DIR__.'/PhpOrient-master/vendor/').'\autoload.php';
use PhpOrient\PhpOrient;

// check if DB exists
$database = $client->dbExists('ICT2103Team1', PhpOrient::DATABASE_TYPE_DOCUMENT);

//if DB exists
if (isset($database) && $database == TRUE){
	if ($debug){echo("ICT2103Team1 DB exists!<br>");}
	
	// open DB
	$cluster_map = $client->dbOpen('ICT2103Team1', 'root', 'ict2103!');
	
	// if DB opens successfully
	if (isset($cluster_map)){
		if ($debug){echo("ICT2103Team1 DB open successfully!<br><br>");}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			// obtain form values
			// $_POST['carpark'] is string "carpark, rate". Convert to array and take just the carpark location
			$carpark = explode(", ", $_POST['carpark'])[0];
			$rate = $_POST['rate'];
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];

			// DEBUG: print form values
			if ($debug) {echo "FORM VALUES<br>carpark: " . $carpark . "<br>";}
			if ($debug) {echo "rate: " . $rate ."<br>";}
			if ($debug) {echo "startDate: " . $startDate . "<br>";}
			if ($debug) {echo "startDate data type: " . gettype($startDate) . "<br>" ;}
			if ($debug) {echo "endDate: " . $endDate . "<br>";}
			if ($debug){echo("Database status:<br>");}
			
			// query database for user
			$userID = $_SESSION['UID'];
			$query = "SELECT * FROM user WHERE userID = {$userID}";
			$record = $client->query($query);
			
			// DEBUG: print query information
			if ($debug){echo("Query information: <br>");}
			if ($debug) {echo("Query: " . $query . "<br>");}
			if ($debug){echo("Return type: " . gettype($record) . "<br>");}
			if ($debug){echo("Size of array: " . sizeof($record) . "<br>");}
			if ($debug){echo ("Array data: " . implode(" ", $record) . "<br><br>");}
		
			$validFlag = true;
			// VALIDATION: ensure that user does not input same season parking location as season parking location that is already in DB
			foreach ($record[0]->getOData()["seasonParking"] as $entry){
				if ($entry['location'] == $carpark){
					$validFlag = false;
				}
			}
			
			if ($validFlag == false){
				echo '<script>window.location = "seasonParking.php?return=1,' . $carpark . '"</script>';
			}
			else{
				// determine if user has prior season parkings
				$priorSeasonParkingFlag = "true";
				if ($record[0]->getOData()["seasonParking"] == null){
					$priorSeasonParkingFlag = "false";
				}

				if ($debug){echo("User's season parking information: <br>");}
				if ($debug){echo("Have prior season parking? " . $priorSeasonParkingFlag. "<br>");}
				
				// since user has no prior season parking, simply UPDATE
				if($priorSeasonParkingFlag == "false"){
					
					// update query
					$updateQuery = "UPDATE user SET seasonParking = {location : '{$carpark}', rate : {$rate}, startDate : date('{$startDate}', 'MM/dd/yyyy'), endDate : date('{$endDate}', 'MM/dd/yyyy')} WHERE userID = {$userID}";
					if ($debug) {echo "UPDATE query: " . $updateQuery . "<br>";}
					$client->command($updateQuery);
				}
				
				// if user has at least one season parking
				else{
					
					
					$updateQuery = "UPDATE user ADD seasonParking = {location : '{$carpark}', rate : {$rate}, startDate : date('{$startDate}', 'MM/dd/yyyy'), endDate : date('{$endDate}', 'MM/dd/yyyy')} WHERE userID = {$userID}";
					if ($debug) {echo "UPDATE query: " . $updateQuery . "<br>";}
					$client->command($updateQuery);
				}
				
				// redirect user to seasonParking page
				echo '<script>window.location = "seasonParkingHistory.php?return=1"</script>';
			}
		}
	}
	
	// if DB fails to open
	else{
		if ($debug){echo("ICT2103Team1 DB failed to open!<br><br>");}
	}
}
// if DB does not exists
else{
	if ($debug){echo("ICT2103Team1 DB does not exists!<br>");}
}

$client->dbClose();
?>