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
			$iu = $_POST['iu'];
			$carplate = $_POST['carplate'];

			// DEBUG: print form values
			if ($debug) {echo "FORM VALUES<br>iu: " . $iu . "<br>";}
			if ($debug) {echo "carplate: " . $carplate ."<br><br>";}
			if ($debug){echo("Database status:<br>");}
		
			// query database for specific user
			$userID = $_SESSION['UID'];
			$query = "SELECT car.carplate FROM user WHERE userID = {$userID}";
			$record = $client->query($query);
		
			// DEBUG: print query information
			if ($debug){echo("Query information: <br>");}
			if ($debug) {echo("Query: " . $query . "<br>");}
			if ($debug){echo("Return type: " . gettype($record) . "<br>");}
			if ($debug){echo("Size of array: " . sizeof($record) . "<br>");}
			if ($debug){echo ("Array data: " . implode(" ", $record) . "<br><br>");}

			
			// VALIDATION. Ensure IU_SN is not already in database
			$allCarQuery = "SELECT car.car_IU_SN FROM user";
			$allCarRecord = $client->query($allCarQuery);
			
			if ($debug) {echo "Array data for IU_SN: " .  implode(" ", $allCarRecord) . "<BR>";}
			if ($debug) {echo "Size of Array data for IU_SN: " .  sizeof($allCarRecord)	 . "<BR>";}
			
			$valid_IU_SN_flag = true;
			// loop through each car object
			foreach($allCarRecord as $carObject){
				if ($debug) {echo "Number of car_IU_SN that user have: " . sizeof($carObject->getOData()['car']) . "<br>";}
				
				// if user has only one car, means only have one SN_IU 
				if (sizeof($carObject->getOData()['car']) == 1){
					if ($debug) {echo "Car_IU_SN: " . $carObject->getOData()['car'][0] . "<br>";}
					if ($carObject->getOData()['car'][0] == $iu){
						$valid_IU_SN_flag = false;
					}
				}
				
				// if user has more than one car, they have more than one IU_SN
				else if (sizeof($carObject->getOData()['car']) > 1){
					foreach($carObject->getOData()['car'] as $db_iu){
						if ($debug) {echo "db iu: " . $db_iu . "<br>";} 
						if ($db_iu == $iu){
							$valid_IU_SN_flag = false;
						}
					}
				}
			}
		
			// if user inputs a IU_SN that already exists in DB, returns to modifyCars page with error message
			if (!$valid_IU_SN_flag){
				echo '<script>window.location = "modifyCars2.php?return=0, ' . $carplate . ', ' . $iu . '"</script>';
			}
			
			// update car with user's inputted IU_SN
			else{
				if ($debug){echo("User's car information: <br>");}

				// find the specific car to update
				foreach($record[0]->getOData()['car'] as $dbCarplate){
					
					// if found
					if ($dbCarplate == $carplate){
					
						// REMOVE THAT CAR OBJECT
						$removeTupleQuery = "UPDATE user REMOVE car = car[carplate = '{$carplate}']";
						$client->command($removeTupleQuery);
						
						// ADD A NEW CAR OBJECT with the same carplate but different IU_SN
						$updateQuery = 'UPDATE user ADD car = {"carplate" : "' . $carplate.'", "car_IU_SN" : '.$iu.'} WHERE userID = ' . $userID . ';';	
						$client->command($updateQuery);
					}
				}
				
			// redirect user to modifyCars page
			echo '<script>window.location = "modifyCars.php?return=1"</script>';
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