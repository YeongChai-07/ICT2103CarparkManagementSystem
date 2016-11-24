<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'checksession.php';
include 'connectionDB.php';

$usernameDisplay = $_SESSION['UName'];
?>
<script>
            function showCarpark(str) {
                if (str == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
                    document.getElementById("txtHint").innerHTML = str;
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
                   
                    <div class="col-md-6">
                        <p></p>
                        <label for="street">Choose a carpark location:</label>
                        <select class="selectpicker" onchange = "showCarpark(this.value)">ALL CARPARKS
                            <option>Select a carpark location</option>
                                    <?php
                                    $host = "ict2103team1server.database.windows.net";
                                    $user = "ict2103Team1";
                                    $pwd = "ict2103!";
                                    $db = "ict2103Team1";

                                    // Connecting to database
                                    try {
                                        $dbh = new PDO("sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
                                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    } catch (Exception $e) {
                                        die(var_dump($e));
                                    }
                                    $sql = "select * from carpark";

                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $result = $query->fetchAll();
//                                    foreach ($result as $row) {
//
//
//                                        echo "<option = value = '" . $row["carparkID"] . "'>" . $row["carparkLocation"] . "</option>";
//                                    }
                                    foreach ($result as $row) {
                                        echo "<option value = '<td>" . $row["SP_Location"] . "</td><td>" . $row["lotsAvailable"] . "</td><td>" . $row["rate"] . "</td>' >" . $row["carparkLocation"]  . "</option>";
//                                    echo "<option value = '" . $row["rate"] . "' >" . $row["carparkLocation"] . "</option>";
                                    }
                                    ?>
                        </select>
                    </div>
                    <table class="table" cellspacing = "10">
                            <thead>
                                <tr>
                                    <th>Carpark Location</th>
                                    <th>Available Lots</th>
                                    <th>Carpark Rate</th>
                                </tr>
                                 <label id = "txtHint">
                                </label>

                            </thead>

                        </table>
                    
                        <div class ="row">
                            <div class ="col-md-10"></div>
                            <div class ="col-md-2">
                                <a href="booking.php" class="btn btn-default" role="button">Back</a>
                            </div>
                        </div>
                    </div>
                      
                </div>
            </div>
        </div>

    </body>
</html>
