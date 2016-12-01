<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

// configurations
include 'checksession.php';
include 'connectionDB.php';
require realpath(__DIR__.'/PhpOrient-master/vendor/').'\autoload.php';
use PhpOrient\PhpOrient;

// variable declarations
$usernameDisplay = $_SESSION['UName'];
$userID = $_SESSION['UID'];
$successfulConnection = true;

// connect to DB
// check if DB exists
$database = $client->dbExists('ICT2103Team1', PhpOrient::DATABASE_TYPE_DOCUMENT);

if ($debug){echo("Database status:<br>");}
//if DB exists
if (isset($database) && $database == TRUE){

	// open DB
	$cluster_map = $client->dbOpen('ICT2103Team1', 'root', 'ict2103!');
	
	if ($debug){echo("ICT2103Team1 DB exists!<br>");}
	
	// if DB opens successfully
	if (isset($cluster_map)){
		if ($debug){echo("ICT2103Team1 DB open successfully!<br><br>");}
	}
	// if DB fails to open
	else{
		if ($debug){echo("ICT2103Team1 DB failed to open!<br><br>");}
		
		$successfulConnection = false;
	}
}
// if DB does not exists
else{
	if ($debug){echo("ICT2103Team1 DB does not exists!<br>");}
	
	$successfulConnection = false;
}

$modifyFailFlag = false;
// failed alert
if (isset($_GET['return'])){
	
	// as get returns a string of "0, carplate, IU_SN", explode it to convert to array
	$array = explode(", ", $_GET['return']);
	if ($array[0] == 0){
		echo "<script type='text/javascript'>alert('The IU_SN ({$array[2]}) you added is already in the database.');</script>";
		$modifyFailFlag = true;
	}
}
?>

<html>
    <head>
        <title>Add Cars</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="newcss.css">
    </head>
    <body>
        <h1> Carpark Management System </h1>
        <nav class="navbar navbar-default" style="width:50%; margin:0 auto; text-align: center;">
            <div class="container-fluid" style="width:50%; margin:0 auto; text-align: center;" >
                <ul class="nav navbar-nav" id="nav">
                    <li class="active"><a href="addCars.php">Cars</a></li>
                    <li><a href="seasonParking.php">Season Parking</a></li>
                    <li><a href="booking.php">Bookings</a></li>
                </ul>
            </div>
        </nav>


        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3>Cars</h3>
                <div></div>
                <div class="btn-group btn-group-justified">
                    <a href="addCars.php" class="btn btn-info">Add</a>
                    <a href="modifyCars.php" class="btn btn-info active">Modify</a>
                    <a href="deleteCars.php" class="btn btn-info">Delete</a>
                </div>
                <div class="jumbotron">
                    <h4>Car Details - Modify</h4>
                    <p></p>
                    <div class="container">
                        <form method="post" action="modifyingCars.php">
                            <div class="form-group">
                                <label for="iu">IU Serial Number:</label>
                                <input type="text" class="form-control" id="iu" name="iu" required>
                            </div>
                            <div class="form-group">
                                <label for="carplate">Car Plate Number:</label>
								<?php
								
								if ($successfulConnection){

									if ($modifyFailFlag){
										echo '<input type="text" class="form-control" name="carplate" value="' . $array[1] . '" readonly>';
									}
									else{
										// query database for all carpark information. Returns array of objects
										$query = "SELECT car FROM user WHERE userID = {$userID}";
										$record = $client->query($query);
										
										// DEBUG
										if ($debug) { echo "Query: " . $query . "<br>";}
										if ($debug) {echo "<br>sizeOf returned data: " . sizeof($record) . "<br>";}
										if ($debug) {echo "Data type of returned data: " . gettype($record) . "<br>";}
										if ($debug) {echo "Returned query data: " . implode(" ", $record) . "<br><br>";}					
										
										foreach($record[0]->getOData()['car'] as $car){
											if($car['carplate'] == $_POST['carplate']){
												echo '<input type="text" class="form-control" name="carplate" value="' . $_POST['carplate'] . '" readonly>';
											}	
										}	
									}
								}
								$client->dbClose();

								
								?>
                            </div>
                            <div class ="row">
                                <div class ="col-md-10"></div>
                                <div class ="col-md-2">
								<div class="form-group">
									<input type="submit" name="modifyCar" id="modifyCar" class="form-control btn btn-success" value="Modify now!">
								</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
