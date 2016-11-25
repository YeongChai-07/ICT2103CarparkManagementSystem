<?php
include 'checkSession.php';
include 'connectionDB.php';

$userID_Car = $_SESSION['UID'];
$usernameDisplay = $_SESSION['UName'];

$caruserNRICsql = "SELECT custNRIC FROM customer WHERE userID = $userID_Car";
$caruserNRICsqlquery = $conn->query($caruserNRICsql);
$caruserNRICsqlresult = $caruserNRICsqlquery->fetchAll();

$userNRIC = $caruserNRICsqlresult[0]['custNRIC'];

if (isset($_POST['Submit'])) {

    $cP = $_POST["carplate"];
    $upperCP = strtoupper($cP); //change to upper case
    $carIUSN = $_POST["IUSN"];
    $check = 0; //by default cannot add

    $carCustIDsql = "SELECT c.custNRIC, a.carPlate FROM customer c, userRelation r, cars a WHERE c.userID=r.userID AND c.custNRIC = a.custNRIC";
    $carCustIDconnresult = $conn->query($carCustIDsql);
    $carCustValue = $carCustIDconnresult->fetchAll();

    foreach ($carCustValue as $carCustValueB) {

        if ($carCustValueB['carPlate'] == $cP) {
            $check = 1;
            break; //Stop once found one car that matches the same car plates
        } else {
            $check = 0;
        }
    }

    if ($check == 0) {
        $addcarsql = "INSERT INTO cars (carPlate, carIUsn, custNRIC) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($addcarsql);
        $stmt->bindValue(1, $upperCP); //Bind value so that it will insert in
        $stmt->bindValue(2, $carIUSN);
        $stmt->bindValue(3, $userNRIC);
        $stmt->execute();
        //added successful feedback alerts
        echo '<div class = "alert alert-block alert-success fade in">';
        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "<strong>Success!</strong> You have successfully added this vehicle, " . $upperCP . ".";
        echo "</div >";
    } else if ($check == 1) {
        //error feedback alert for inserting same car
        echo '<div class = "alert alert-block alert-danger fade in">';
        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "<strong>Error!</strong> This vehicle, " . $upperCP . " ALREADY exist!";
        echo "</div >";
    } else {
        echo '<div class = "alert alert-block alert-warning fade in">';
        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo "<strong>Unknown!</strong> Unknown error occured";
        echo "</div >";
    }
}
?>


<html>
    <head>
        <title>Add Cars</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
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
        <!--Navigation Bar-->

        <div class = "container-fluid" style = "width:50%; margin:0 auto; text-align: center;" >
            <div class = "btn-group btn-group-justified">
                <a href = "car.php" class = "btn btn-info" >Cars</a>
                <a href = "seasonParking.php" class = "btn btn-info">Season Parking</a>
                <a href = "booking.php" class = "btn btn-info" >Bookings</a>
            </div>
        </div>



        <div class = "row">
            <div class = "col-md-6 col-md-offset-3">
                <h3>CARS</h3>
                <div></div>
                <div class = "btn-group btn-group-justified">
                    <a href = "addCars.php" class = "btn btn-success active">Add</a>
                    <a href = "modifyCars.php" class = "btn btn-warning">Modify</a>
                    <a href = "deleteCars.php" class = "btn btn-danger">Delete</a>
                </div>

                <div class = "jumbotron">
                    <h4>Add a Car</h4>
                    <div class = "container">

                        <form method = "POST" action = "addCars.php" >
                            <div class = "form-group" >
                                <label for = "carplate">Car Plate Number:</label>
                                <input type = "text" name = "carplate" class = "form-control" id = "carplate" style = "height: 40;">
                            </div>
                            <div class = "form-group">
                                <label for = "iu">IU Serial Number:</label>
                                <input type = "text" name = "IUSN" class = "form-control" id = "iu"style = "height: 40;">
                            </div>

                            <div class = "container">
                                <!--Trigger the modal with a button -->
                                <input type = "submit" name = "Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php"
        ?>
    </body>
</html>