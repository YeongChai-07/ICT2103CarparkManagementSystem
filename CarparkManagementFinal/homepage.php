<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
<?php
include 'mysql.php';

$trial = new Mysql_Driver;
$trial->connect();

$sql = "SELECT sector FROM carpark WHERE rate < 2";
$result = $trial->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["sector"];
    }
}
$trial->close();
?>


-->
<html>
    <head>
        <title>Carpark Management - Homepage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="newcss.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h2>Carpark Management System</h2>
                    <div></div>
                    <div class="btn-group btn-group-justified">
                        <a href="addCars.php" class="btn btn-info">Cars</a>
                        <a href="seasonParking.php" class="btn btn-info">Season Parking</a>
                        <a href="booking.php" class="btn btn-info">Bookings</a>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
