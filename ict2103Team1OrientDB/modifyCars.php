<?php
include 'checkSession.php';
include 'connectionDB.php';

$userID_Car = $_SESSION['UID'];
$usernameDisplay = $_SESSION['UName'];
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
                    <?php
                    $sqlCars = "SELECT a.carPlate, a.carIUsn FROM cars a, customer c WHERE a.custNRIC = c.custNRIC AND c.userID = $userID_Car";
                    $result = $conn->query($sqlCars);
                    $values = $result->fetchAll();


                    if (count($values) > 0) {
                        echo "<h2>Cars that are registered:</h2>";
                        echo '<div class="table-responsive">';
                        echo '<table class="table table-bordered table-hover table-striped shrink">';
                        echo '<thead>';
                        echo "<tr><th>Car Plate Number</th>";
                        echo "<th>Car IU Serial Number</th>";
                        foreach ($values as $value) {
                            ?>
                            <form method='POST' action='deleteCars.php'>
                                <tr><td><?php echo $value['carPlate'] ?></td>
                                    <td><?php echo $value['carIUsn'] ?></td>
                                <input type="hidden" name="carplateValue" value="<?php echo $value['carPlate'] ?>">
                                <td> <input type='submit' name='modifyCar' class='btn btn-warning' value='Modify'> </td>
                            </form>
                            <?php
                        }
                        echo "</table>";
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
