<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.


-->

<html>
    <head>
        <title>Carpark Management - Homepage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href = "css/newcss.css" rel = "stylesheet" type = "text/css"/>
    </head>
    <body >
        <div class = "container">

            <div class = "row">

                <div class = "col-md-6 col-md-offset-3">
                    <h2>Carpark Management System</h2>
                    <div></div>
                    <div class = "btn-group btn-group-justified">
                        <a href = "addCars.php" class = "btn btn-info" >Cars</a>
                        <a href = "seasonParking.php" class = "btn btn-info">Season Parking</a>
                        <a href = "booking.php" class = "btn btn-info" >Bookings</a>
                    </div>
                    <div class="row">
                        <br></br>
                        <a href="logout.php"<button class="btn btn-warning btn-sm" name="back" type="submit" style="float: right;">Log Out</button></a>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

<!--Query Database and Display-->
//<?php
//$host = "ict2103team1server.database.windows.net";
//$user = "ict2103Team1";
//$pwd = "ict2103!";
//$db = "ict2103Team1";
//
//// Connecting to database
//try {
//    $dbh = new PDO("sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
//    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch (Exception $e) {
//    die(var_dump($e));
//}
//
//$sql = "SELECT * FROM dbo.userRelation WHERE userName = 'Sky'";
//
//$stmt = $dbh->query($sql);
//$registrants = $stmt->fetchAll();
//if (count($registrants) > 0) {
//    echo "<table>";
//    echo "<tr><th>StaffID</th>";
//    echo "<th>Section</th>";
//    foreach ($registrants as $registrant) {
//        echo "<tr><td>" . $registrant['userName'] . "</td>";
//        echo "<td>" . $registrant['userPassword'] . "</td>";
//        echo "</tr>";
//    }
//    echo "</table>";
//} else {
//    echo "<h3>No one is currently registered.</h3>";
//}
//?>