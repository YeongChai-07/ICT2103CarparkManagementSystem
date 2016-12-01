<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'checksession.php';
include 'connectionDB.php';
require realpath(__DIR__.'/PhpOrient-master/vendor/').'\autoload.php';
use PhpOrient\PhpOrient;

$usernameDisplay = $_SESSION['UName'];
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

if (isset($_GET['return'])){
	
	// as get returns a string of "1,carparkLocation", explode it to convert to array
	$array = explode(",", $_GET['return']);
	if ($array[0] == 1){
		echo "<script type='text/javascript'>alert('You have already booked ({$array[1]}) at {$array[2]}!');</script>";
	}
}
?>
<script>
            function showCarparkInformation(str) {
		
				// string consists of carpark location, available lots and rate. Split them into array
				var array = str.split(", ");
				
				// extract Carpark location from array
                if (array[0] == "") {
                    document.getElementById("bookingCarparkLocation").innerHTML = "";
                    return;
                } else {
					// reflect rate on webpage dynamicaly
                    document.getElementById("bookingCarparkLocation").innerHTML = array[0];
					document.getElementById("location").value = array[0];
                }
				
				// extract avaialble lots from array
				if (array[1] == "") {
                    document.getElementById("bookingAvailableLots").innerHTML = "";
                    return;
                } else {
					// reflect rate on webpage dynamicaly
                    document.getElementById("bookingAvailableLots").innerHTML = array[1];
					document.getElementById("lots").value = array[1];
                }
				
				// extract rate from array
				if (array[2] == "") {
                    document.getElementById("bookingCarparkRate").innerHTML = "";
                    return;
                } else {
					// reflect rate on webpage dynamicaly
                    document.getElementById("bookingCarparkRate").innerHTML = array[2];
					document.getElementById("rate").value = array[2];
					document.getElementById("bookingTotalCost").innerHTML = Math.round(array[2] * 2 * 24);
					document.getElementById("totalCost").value = Math.round(array[2] * 2 * 24);
                }

            }
</script>
<html>
    <head>
        <title>Booking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="newcss.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
		
    </head>
    <body>
        <h1> Carpark Management System </h1>
        <nav class="navbar navbar-default" style="width:50%; margin:0 auto; text-align: center;">
            <div class="container-fluid" style="width:50%; margin:0 auto; text-align: center;" >
                <ul class="nav navbar-nav" id="nav">
                    <li><a href="addCars.php">Cars</a></li>
                    <li><a href="seasonParking.php">Season Parking</a></li>
                    <li class="active"><a href="booking.php">Bookings</a></li>
                </ul>
            </div>
        </nav>


        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3>Book a Carpark Lot</h3>
                <div class="jumbotron">
                    <div class ="row">
                        <div class ="col-md-8"></div>
                        <div class ="col-md-3"> 
                            <a href ="bookingHistory.php" id="history">View Booking History</a>
                        </div>
                    </div>
                    <div class ="row"></div>
                    <div class ="col-md-2"></div>
					<form method="post" action='bookingConfirm.php'>
						<div class="col-md-6">
							<p></p>
							<label for="street">Choose a carpark location:</label>
							<div class="form-group">
								<select  class="selectpicker" onchange = "showCarparkInformation(this.value)" required>ALL CARPARKS
									<option selected disabled>Select a carpark location</option>
											<?php
												if ($successfulConnection){

													// query database for all carpark information. Returns array of objects
													$query = "SELECT distinct(carparkLocation) AS carparkLocation, rate, lotsAvailable FROM carpark  ORDER BY carparkLocation ASC LIMIT 150";
													$record = $client->query($query);
													
													// DEBUG
													if ($debug){echo("<option>Query information: </option>");}
													if ($debug) {echo("<option>Query: " . $query . "</option>");}
													if ($debug){echo("<option>Return type: " . gettype($record) . "</option>");}
													if ($debug){echo("<option>Size of array: " . sizeof($record) . "</option>");}
													if ($debug){echo ("<option>Array data: " . implode(" ", $record) . "</option>");}
													
													foreach ($record as $tuple){
														
														// isset as there are duplicate carpark locations in our datasets
														if (isset($tuple->getOData()["carparkLocation"])){
														// capture both carpark location and rate together as a string
														// rate is reflected dynamically on webpage after selection of carpark (javascript)
														echo "<option value = '" . $tuple->getOData()["carparkLocation"] . ", " . $tuple->getOData()["lotsAvailable"]. ", " . $tuple->getOData()["rate"]. "'>" . $tuple->getOData()["carparkLocation"] . "</option>";
														}
													}
												}	
												$client->dbClose();
											?>
								</select>
								
									<?php
									
									// DISPLAY error message if user books the same location at the same date
										if (isset($_GET['return'])){
											if ($_GET['return'] == 1){
												echo "<label><font color='red'>{$array[1]} is already booked!</font></label>";
											}
										}
									?>
							</div>
							<p></p>
							<label for="startdate">Start Date:</label>
							<div class="form-group">
								<input name="startDate" type="text" id="datepicker" name="datepicker" required>
									<?php
									// DISPLAY error message if user books the same location at the same date
										if (isset($_GET['return'])){
											if ($_GET['return'] == 1){
												echo "<label><font color='red'>{$array[2]} is already booked!</font></label>";
											}
										}
									?>
							</div>

						</div>
						<table class="table" cellspacing = "10">
								<thead>
									<tr>
										<th>Carpark Location</th>
										<th>Available Lots</th>
										<th>Carpark Rate (per half an hour)</th>
										<th>Total cost (24h)</th>
									</tr>
									<tr>
										<td id = "bookingCarparkLocation"></td>
										<div class="form-group">
											<input name="bookingCarparkLocation" id="location" type="hidden"/>
										</div>
										<td id = "bookingAvailableLots"></td>
										<div class="form-group">
											<input name="bookingAvailableLots" id="lots" type="hidden"/>
										</div>
										<td id = "bookingCarparkRate"></td>
										<div class="form-group">
											<input name="bookingCarparkRate" id="rate" type="hidden"/>
										</div>
										<td id = "bookingTotalCost"></td>
										<div class="form-group">
											<input name="bookingTotalCost" id="totalCost" type="hidden"/>
										</div>
									</tr>
									 <label id = "txtHint"></label>
								</thead>
						</table>
						<div class ="row">
							<div class ="col-md-9"></div>
							<div class ="col-md-2">
								<div class="form-group">
									<input type="submit" name="submitBooking" id="submitBooking" class="form-control btn btn-success" value="Book now!">
								</div>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>

    </body>
</html>
