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
$debug = true;
$successfulConnection = true;

if (isset($_GET['return'])){
	if ($_GET['return'] == 1){
		echo "<script type='text/javascript'>alert('hello');</script>";
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
        <script>
            function showCost(str) {
				// split string into array [carparkLocation, rate]
				var array = str.split(", ");
                if (array[1] == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
					// reflect rate on webpage dynamicaly
                    document.getElementById("txtHint").innerHTML = array[1];
					// set rate to hidden form so as to pass data over
					document.getElementById("rate").value = array[1];
                }
            }
        </script>
        <title>Season Parking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="newcss.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel='stylesheet' type='text/css'  href='css/jquery-ui.css' />
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script type="text/javascript">
            $(function () {
                $("#datepicker").datepicker();
            });
        </script>

        <script type="text/javascript">
            $(function () {
                $("#datepicker1").datepicker();
            });
        </script>

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
                <h3>Season Parking</h3>
                <p></p>

                <div class="jumbotron">
                    <div class ="row">
                        <div class ="col-md-8"></div>
                        <div class ="col-md-3"> 
                            <a href ="seasonParkingHistory.php" id="history">View Season Parkings</a>
                        </div>
                    </div>
                    <div class="container">
                        <form method="post" action='seasonParking2.php'>
                            <div class ="col-md-5">
                                <div class="form-group">
                                    <label for="iu">Carpark:</label>
                                </div>
                                <p></p>
                                <div class="form-group">
                                    <label for="carplate">Cost:</label>
                                </div>
                                <div class="form-group">
                                    <label for="startdate">Start Date:</label>
                                </div>
                                <div class="form-group">
                                    <label for="enddate">End Date:</label>
                                </div>

                            </div> 
                            <div class ="col-md-2">
								<div class="form-group">
									<select name="carpark" class="selectpicker" id = "carpark" onchange="showCost(this.value)">Carpark Name
										<option>Select a carpark location</option>
										<?php
										if ($successfulConnection){

											// query database for all carpark information. Returns array of objects
											$query = "SELECT * FROM carpark LIMIT 150";
											$record = $client->query($query);
											
											// DEBUG
											if ($debug){echo("<option>Query information: </option>");}
											if ($debug) {echo("<option>Query: " . $query . "</option>");}
											if ($debug){echo("<option>Return type: " . gettype($record) . "</option>");}
											if ($debug){echo("<option>Size of array: " . sizeof($record) . "</option>");}
											if ($debug){echo ("<option>Array data: " . implode(" ", $record) . "</option>");}
											
											foreach ($record as $tuple){
												// capture both carpark location and rate together as a string
												// rate is reflected dynamically on webpage after selection of carpark (javascript)
												echo "<option value = '" . $tuple->getOData()["carparkLocation"] . ", " . $tuple->getOData()["rate"] ."' >" . $tuple->getOData()["carparkLocation"]. "</option>";
											}
										}
										?>
									</select>
								</div>
                                <p></p>
								<div class="form-group">
									<label id = "txtHint"></label>
									<input name="rate" id="rate" type="hidden"/>
								</div>
                                <p></p>
								<div class="form-group">
                                <input name="startDate" type="text" id="datepicker" name="datepicker">
                                </div>
								<p></p>
								<div class="form-group">
                                <input name="endDate" type="text" id="datepicker1" name="datepicker">
								</div>
                            </div>
							<div class="form-group">
								<div class ="row">
									<div class ="col-md-9"></div>
									<div class ="col-md-2">
										<input type="submit" name="submitSeasonParking" id="submitSeasonParking" class="form-control btn btn-success" value="Book now!">
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
