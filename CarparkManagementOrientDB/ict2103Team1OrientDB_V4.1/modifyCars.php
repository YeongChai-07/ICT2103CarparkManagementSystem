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

// success alert 
if (isset($_GET['return'])){
	if ($_GET['return'] == 1){
		echo "<script type='text/javascript'>alert('Car modified successfully!');</script>";
	}
}

?>
<html>
    <head>
        <title>Modify Cars</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class = "container-fluid" style = "width:50%; margin:0 auto; text-align: center;" >
            <div class = "btn-group btn-group-justified">
                <a href = "car.php" class = "btn btn-info active" >Cars</a>
                <a href = "seasonParking.php" class = "btn btn-info">Season Parking</a>
                <a href = "booking.php" class = "btn btn-info" >Bookings</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3>CARS</h3>
                <div></div>
                <div class = "btn-group btn-group-justified">
                    <a href = "addCars.php" class = "btn btn-success">Add</a>
                    <a href = "modifyCars.php" class = "btn btn-warning active">Modify</a>
                    <a href = "deleteCars.php" class = "btn btn-danger">Delete</a>
                </div>
                <div class="jumbotron">
                    <h4>Car Details - Modify</h4>
                    <p></p>
					<table class="table table-bordered table-hover table-striped shrink">
						<thead>
							<tr>
								<th>Car Plate Number</th>
								<th>Car IU Serial Number</th>
								<th>Modify</th>
							</tr>
						</thead>
						<tbody>
						<form method="post" action="modifyCars2.php">
						<?php
						
						 if ($successfulConnection){

							// query database for all carpark information. Returns array of objects
							$query = "SELECT car FROM user WHERE userID = {$userID}";
							$record = $client->query($query);
							
							// DEBUG
							if ($debug) { echo "Query: " . $query . "<br>";}
							if ($debug) {echo "<br>sizeOf returned data: " . sizeof($record) . "<br>";}
							if ($debug) {echo "Data type of returned data: " . gettype($record) . "<br>";}
							if ($debug) {echo "Returned query data: " . implode(" ", $record) . "<br><br>";}					
							
							foreach($record[0]->getOData()['car'] as $car){
								echo "<tr><td>" . $car['carplate'] . "</td><td>" . $car['car_IU_SN'] . "</td><td><div class='form-group'><button type='submit' class='btn btn-warning' name='carplate' value='{$car['carplate']}'>Modify</button></td></tr>";
								
							}
						}
						$client->dbClose();
						?>
						</form>
						</tbody>
					<table>
                </div>
            </div>
        </div>
    </body>
</html>
