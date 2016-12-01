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
			$carpark = $_POST['bookingCarparkLocation'];
			$availableLots = $_POST['bookingAvailableLots'];
			$rate = $_POST['bookingCarparkRate'];
			$startDate = $_POST['startDate'];


			// DEBUG: print form values
			if ($debug) {echo "FORM VALUES<br>carpark: " . $carpark . "<br>";}
			if ($debug) {echo "rate: " . $rate ."<br>";}
			if ($debug) {echo "startDate: " . $startDate . "<br>";}
			if ($debug) {echo "availableLots: " . $availableLots . "<br>";}
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
		
			// determine if user has prior season parkings
			$priorBookingFlag = "true";
			if ($record[0]->getOData()["booking"] == null){
				$priorBookingFlag = "false";
			}

			if ($debug){echo("User's booking information: <br>");}
			if ($debug){echo("Have prior booking? " . $priorBookingFlag. "<br>");}
			
			// generate random carpark lot number_format
			$carparkLotNumber = rand(1, $availableLots);
			if ($debug){echo("User's random carpark lot number: ". $carparkLotNumber . "<br>");};
			
			// calculate rate the user has to pay for that carparklot
			// as datasets is rate per half an hour
			// our system charge booking per day
			$rate = $rate * 2 * 24; 
			
			$validFlag = true;
			// VALIDATION: ensure that user does not input same season parking location as season parking location that is already in DB
			foreach ($record[0]->getOData()["booking"] as $entry){
				// echo $entry['startDate']->format('Y-m-d');
				// echo $startDate . ", " . $entry['startDate']->add(new DateInterval('P1D'))->format('m/d/Y') . "<br>";
				if (($entry['location'] == $carpark) &&  ($entry['startDate']->add(new DateInterval('P1D'))->format('m/d/Y') == $startDate)){
					echo $startDate . ", " . $entry['startDate']->add(new DateInterval('P1D'))->format('m/d/Y');
					$validFlag = false;
				}
			}
			
			if ($validFlag == false){
				echo '<script>window.location = "booking.php?return=1,' . $carpark . "," . $startDate .'"</script>';
			}
			else{
				// since user has no prior season parking, simply UPDATE
				if($priorBookingFlag == "false"){
					
					// update query
					$updateQuery = "UPDATE user SET booking = {location : '{$carpark}', totalCost : {$rate}, startDate : date('{$startDate}', 'MM/dd/yyyy'), lotNumber : {$carparkLotNumber}} WHERE userID = {$userID}";
					if ($debug) {echo "UPDATE query: " . $updateQuery . "<br>";}
					$client->command($updateQuery);
				}
				
				// if user has at least one season parking
				else if($priorBookingFlag == "true"){
					
					
					$updateQuery = "UPDATE user ADD booking = {location : '{$carpark}', totalCost : {$rate}, startDate : date('{$startDate}', 'MM/dd/yyyy'), lotNumber : {$carparkLotNumber}} WHERE userID = {$userID}";
					if ($debug) {echo "UPDATE query: " . $updateQuery . "<br>";}
					$client->command($updateQuery);
				}
				
				//redirect user to seasonParking page
				echo '<script>window.location = "bookingHistory.php?return=1"</script>';
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