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

                                $sql = "select * from userRelation, customer,manageSeasonParking where userRelation.userID= customer.userID 
                                    and userRelation.userName='$usernameDisplay' and customer.custNRIC=manageSeasonParking.custNRIC";
                                
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $result = $query->fetchAll();
                                foreach ($result as $row) {



                                    echo "<tr><td>" . $row["SP_Location"] . "</td><td>" . $row["startDate"] . "</td><td>" . $row["endDate"] . "</td></tr>";
                                }
                                //td= coloum
                                //tr=row


                                //echo "0 results";

                                $dbh->close();

?>
                            </thead>
<<<<<<< HEAD

=======
<!--                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Blk...</td>
                                    <td>16/10/2016 - 15/11/2016</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Blk...</td>
                                    <td>16/10/2016 - 15/11/2016</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Blk...</td>
                                    <td>16/10/2016 - 15/11/2016</td>
                                </tr>
                                <tr>
                                    
                                </tr>
                            </tbody>-->
>>>>>>> 59e9300f3372268ea7c7bceb59d879a0a9f9ac02
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
<!--Query Database and Display-->
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

$sql = "select SP_Location, startDate, endDate from manageSeasonParking";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($arr as $titleData){
    echo $titleData['SP_Location'];
}
//$result = $dbh->query($sql);

//if($result->num_rows > 0){
//    echo "<table><tr><th>Carpark Location</th><th>Start Date</th><th>End Date</th></tr>";
//    
////    while($row = $result->fetch_assoc()) {
//    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
//    foreach ($rows as $row) {
//        echo $row['sp_loaction'];
//    }
////    foreach ($registrants as $registrant) {
////        echo "<tr><td>".$registrant["SP_Location"]."</td><td>".$registrant["startDate"]."</td><td>".$registrant["endDate"]."</td></tr>";
////        
////    }
//    
//    echo "</table>";
}
else {
    echo "0 results";
}

$dbh->close();

//$stmt = $dbh->query($sql);
//$registrants = $stmt- >fetchAll();
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


?>