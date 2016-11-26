<?php
$debug = true;

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
		
			// determine if user has prior season parkings
			$priorSeasonParkingFlag = "true";
			if ($record[0]->getOData()["seasonParking"] == null){
				$priorSeasonParkingFlag = "false";
			}

			if ($debug){echo("User's season parking information: <br>");}
			if ($debug){echo("Have prior season parking? " . $priorSeasonParkingFlag. "<br>");}
			
			if($priorSeasonParkingFlag == "false"){
				
				// PARSER TO EXTRACT ALL USER DATA FOR UPDATE SINCE WE NEED TO INCLUDE ALL USER DATA
				// $string = "[";
				// $size = sizeof($record[0]->getOData());
				// foreach ($record[0]->getOData() as $key => $value){
					
					// // if not array
					// if (gettype($value) != "array"){
						// if ($debug) {echo "key: " . $key . ", value: " . $value . "<br>";}
						// $string .= "'" . $key . "' =>";
						
						// // if value is not a string
						// if (gettype($value) != "string"){
							// if ($size == 1){
								// $string .= "'" . $value . "' ";
							// }
							// else{
								// $string .= "'" . $value . "', ";
							// }
						// }
						
						// // if value is a string
						// else{
							// if ($size == 1){
								// $string .= "'" . $value . "' ";
							// }
							// else{
								// $string .= "'" . $value . "', ";
							// }
						// }
					// }
					
					// // if array
					// else{
						// if ($debug){echo "Array<br>";}
						
						// // we do not want to include seasonParking into string YET
						// if ($key == "seasonParking"){
							// $size -= 1;
							// continue;
						// }
						// $string .= "'" . $key . "' => [";
						// $arraySize = sizeof($record[0]->getodata()[$key]);
						
						// // if array has an array of objects in it
						// foreach($record[0]->getodata()[$key] as $tuple){
							// $string .= "{";
							// $objectSize = sizeof($record[0]->getodata()[$key][0]);
							
							// // if there are more than one object
							// foreach($tuple as $subkey => $subvalue){
								// if ($debug){echo "subkey: " . $subkey . ", subvalue: " . $subvalue . "<br>";}
								// $string .= "'" . $subkey . "' =>";
								// if (gettype($subvalue) != "string"){
									// if ($objectSize == 1){
										// $string .= "'" . $subvalue . "' ";
									// }
									// else{
										// $string .= "'" . $subvalue . "', ";
									// }
								// }
								// else{
									// if ($objectSize == 1){
										// $string .= "'" . $subvalue . "' ";
									// }
									// else{
										// $string .= "'" . $subvalue . "', ";
									// }
								// }
								// $objectSize -= 1;
							// }	
							// if ($arraySize == 1){
								// $string .= "}";
							// }
							// else{
								// $string .= "},";
							// }
							// $arraySize -= 1;
						// }

						// if ($size == 1){
							// $string .= "]";
						// }
						// else{
							// $string .= "],";
						// }
					// }
					// $size -= 1;
				// }
				// $string .= "]";
				// echo $string;
				
				// $string .= [ 'seasonParking' =>  "[{'location' : '{$carpark}', 'rate' : {$rate}, 'startDate' : {$startDate}, 'endDate' : {$endDate}}]"];
				// $recUp = $record[0]->setOData($recordContent);
				// $updated = $client->recordUpdate( $recUp );
				// if($debug) {echo "User in datbase updated with the following data: " . $updated . "<br>";}

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

?>