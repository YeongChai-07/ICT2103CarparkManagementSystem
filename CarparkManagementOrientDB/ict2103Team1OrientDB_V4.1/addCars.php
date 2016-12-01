<?php
include 'checkSession.php';
include 'connectionDB.php';

use PhpOrient\PhpOrient;

$debug = FALSE;

$userID_Car = $_SESSION['UID'];
$usernameDisplay = $_SESSION['UName'];

//$caruserNRICsql = "SELECT custNRIC FROM customer WHERE userID = $userID_Car";
$caruserNRICsql = "SELECT userID FROM User WHERE userName ='" . $userID_Car . "';";

// check if DB exists
$database = $client->dbExists('ICT2103Team1', PhpOrient::DATABASE_TYPE_DOCUMENT);

if ($debug){echo("Database status:<br>");}
//if DB exists
if (isset($database) && $database == TRUE){
	if ($debug){echo("ICT2103Team1 DB exists!<br>");}
	
	// open DB
	$cluster_map = $client->dbOpen('ICT2103Team1', 'root', 'ict2103!');
	
	// if DB opens successfully
	if (isset($cluster_map)){
		if ($debug){echo("ICT2103Team1 DB open successfully!<br><br>");}
		
		
		//START OF CODE BLOCK
		
		if (isset($_POST['Submit'])) {

			$cP = $_POST["carplate"];
			$upperCP = strtoupper($cP); //change to upper case
			$carIUSN = $_POST["IUSN"];
			
			$failedChecks = TRUE;
			$check = 0; //Error code for indicating that couldn't locate the userID
				
			//$carCustIDsql = "SELECT c.custNRIC, a.carPlate FROM customer c, userRelation r, cars a WHERE c.userID=r.userID AND c.custNRIC = a.custNRIC";
			$carCustIDsql = "SELECT distinct(car.carplate) FROM User";
			//$carCustIDconnresult = $conn->query($carCustIDsql);
			$carCustIDconnresult = $client->query($carCustIDsql);
			$carCustValue = NULL;
			if(count($carCustIDconnresult) > 0)
			{
				foreach($carCustIDconnresult as $carCustID_Tuple)
				{
					if($debug){print_r('LAI! What Type is it now? :' . get_class($carCustID_Tuple). '<br/>');}
							
					foreach($carCustID_Tuple->getOData()["distinct"] as $carCustID_Rec)
					{
						if($debug){print_r('LAI! Tell me more about it :' . $carCustID_Rec . '<br/>');}
						if ($carCustID_Rec == $cP) {
							$failedChecks = TRUE;
							$check = 1;
							break; //Stop once found one car that matches the same car plates
						}//End IF 

					}//End For-Each
							
				}//End Inner For-Each
						
			}
			
			// VALIDATION. Ensure IU_SN is not already in database
			$allCarQuery = "SELECT car.car_IU_SN FROM user";
			$allCarRecord = $client->query($allCarQuery);
			
			if ($debug) {echo "Array data for IU_SN: " .  implode(" ", $allCarRecord) . "<BR>";}
			if ($debug) {echo "Size of Array data for IU_SN: " .  sizeof($allCarRecord)	 . "<BR>";}
			
			if($check == 0){
			
				// loop through each car object
				foreach($allCarRecord as $carObject){
					if ($debug) {echo "Number of car_IU_SN that user have: " . sizeof($carObject->getOData()['car']) . "<br>";}
					
					// if user has only one car, means only have one SN_IU 
					if (sizeof($carObject->getOData()['car']) == 1){
						if ($debug) {echo "Car_IU_SN: " . $carObject->getOData()['car'][0] . "<br>";}
						if ($carObject->getOData()['car'][0] == $carIUSN){
							$check = 2;
						}
					}
					
					// if user has more than one car, they have more than one IU_SN
					else if (sizeof($carObject->getOData()['car']) > 1){
						foreach($carObject->getOData()['car'] as $db_iu){
							if ($debug) {echo "db iu: " . $db_iu . "<br>";} 
							if ($db_iu == $carIUSN){
								$check = 2;
							}
						}
					}
				}
			}


			if ($check == 0) {
				//$addcarsql = "INSERT INTO cars (carPlate, carIUsn, custNRIC) VALUES (?, ?, ?)";
				$addcarsql = 'UPDATE User ADD car ={"carplate": "'. $upperCP . '" , "car_IU_SN": ' . $carIUSN . '} '.
				"WHERE userID = " . $userID_Car . ";";
				
				// echo "UPDATE Statement : " . $addcarsql . '<br/>';
				$client->command($addcarsql);
				/*$stmt = $conn->prepare($addcarsql);
				$stmt->bindValue(1, $upperCP); //Bind value so that it will insert in
				$stmt->bindValue(2, $carIUSN);
				$stmt->bindValue(3, $userNRIC);
				$stmt->execute();*/
				//added successful feedback alerts
				echo '<div class = "alert alert-block alert-success fade in">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				echo "<strong>Success!</strong> You have successfully added this vehicle, " . $upperCP . ".";
				echo "</div >";
			} else if ($check == 1) {
				//error feedback alert for inserting same car
				echo '<div class = "alert alert-block alert-danger fade in">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				echo "<strong>Error!</strong> This vehicle, " . $upperCP . " ALREADY exist!";
				echo "</div >";
			}
			else if ($check == 2) {
				//error feedback alert for inserting same IU_SN
				echo '<div class = "alert alert-block alert-danger fade in">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				echo "<strong>Error!</strong> This IU_SN, " . $carIUSN . " ALREADY exist!";
				echo "</div >";
			}
			else {
				echo '<div class = "alert alert-block alert-warning fade in">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				echo "<strong>Unknown!</strong> Unknown error occured";
				echo "</div >";
			}
	
	
		}
	
			//END OF CODE BLOCK
	}		
		
}


?>


<html>
    <head>
        <title>Add Cars</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href = "css/bootstrap.min.css" rel = "stylesheet" type = "text/css"/>
        <link href = "css/newcss.css" rel = "stylesheet" type = "text/css"/>
        <link href = "css/bootstrap-responsive.min.css" rel = "stylesheet" type = "text/css"/>
        <link href = "css/myModalCSS.css" rel = "stylesheet" type = "text/css"/>
    </head>

    <body>
        <h1> Carpark Management System </h1>
        <h3>Welcome, <?php echo $usernameDisplay ?>!</h3>
        <?php include "logoutBtn.php" ?>
        <!--Navigation Bar-->

        <div class = "container-fluid" style = "width:50%; margin:0 auto; text-align: center;" >
            <div class = "btn-group btn-group-justified">
                <a href = "car.php" class = "btn btn-info" >Cars</a>
                <a href = "seasonParking.php" class = "btn btn-info">Season Parking</a>
                <a href = "booking.php" class = "btn btn-info" >Bookings</a>
            </div>
        </div>



        <div class = "row">
            <div class = "col-md-6 col-md-offset-3">
                <h3>CARS</h3>
                <div></div>
                <div class = "btn-group btn-group-justified">
                    <a href = "addCars.php" class = "btn btn-success active">Add</a>
                    <a href = "modifyCars.php" class = "btn btn-warning">Modify</a>
                    <a href = "deleteCars.php" class = "btn btn-danger">Delete</a>
                </div>

                <div class = "jumbotron">
                    <h4>Add a Car</h4>
                    <div class = "container">

                        <form method = "POST" action = "addCars.php" >
                            <div class = "form-group" >
                                <label for = "carplate">Car Plate Number:</label>
                                <input type = "text" name = "carplate" class = "form-control" id = "carplate" style = "height: 40;" required>
                            </div>
                            <div class = "form-group">
                                <label for = "iu">IU Serial Number:</label>
                                <input type = "text" name = "IUSN" class = "form-control" id = "iu"style = "height: 40;" required>
                            </div>

                            <div class = "container">
                                <!--Trigger the modal with a button -->
                                <input type = "submit" name = "Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php"
        ?>
    </body>
</html>