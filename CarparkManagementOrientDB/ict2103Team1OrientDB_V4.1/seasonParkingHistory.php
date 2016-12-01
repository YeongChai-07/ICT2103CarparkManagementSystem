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

$usernameDisplay = $_SESSION['UName'];
$userID = $_SESSION['UID'];
$successfulConnection = true;

if (isset($_GET['return'])){
	if ($_GET['return'] == 1){
		echo "<script type='text/javascript'>alert('Season parking added successfully!');</script>";
	}
}

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
?>

<html>
    <head>
        <title>View Season Parking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="newcss.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h1> Carpark Management System </h1>
        <nav class="navbar navbar-default" style="width:50%; margin:0 auto; text-align: center;">
            <div class="container-fluid" style="width:50%; margin:0 auto; text-align: center;" >
                <ul class="nav navbar-nav" id="nav">
                    <li><a href="addCars.php">Cars</a></li>
                    <li  class="active" ><a href="seasonParking.php">Season Parking</a></li>
                    <li><a href="booking.php">Bookings</a></li>
                </ul>
            </div>
        </nav>

        
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3>My Season Parking Bookings</h3>
                <div class="jumbotron">
                <div class="row"></div>
                    <div class="container">
                        <table class="table" cellspacing = "10">
                            <thead>
                                <tr>
                                    <th>Carpark Location</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                                 <?php
								 
								 if ($successfulConnection){

									// query database for all carpark information. Returns array of objects
									$query = "SELECT seasonParking FROM user WHERE userID = {$userID}";
									$record = $client->query($query);
									
									// DEBUG
									if ($debug) { echo "Query: " . $query . "<br>";}
									if ($debug) {echo "<br>sizeOf returned data: " . sizeof($record) . "<br>";}
									if ($debug) {echo "Data type of returned data: " . gettype($record) . "<br>";}
									if ($debug) {echo "Returned query data: " . implode(" ", $record) . "<br><br>";}					
									
									foreach($record[0]->getOData()['seasonParking'] as $seasonParking){
										echo "<tr><td>" . $seasonParking['location'] . "</td><td>" . $seasonParking['startDate']->format('Y-m-d') . "</td><td>" . $seasonParking['endDate']->format('Y-m-d') . "</td></tr>";
									}
								}
								$client->dbClose();
								?>
                            </thead>
                        </table>
                        
                        <div class ="row">
                            <div class ="col-md-10"></div>
                            <div class ="col-md-2">
                               <a href="seasonParking.php" class="btn btn-default" role="button">Back</a>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>

    </body>
</html>