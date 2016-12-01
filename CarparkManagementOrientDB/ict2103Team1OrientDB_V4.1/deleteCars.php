<?php
include 'checkSession.php';
include 'connectionDB.php';

use PhpOrient\PhpOrient;
$userID_Car = $_SESSION['UID'];
$usernameDisplay = $_SESSION['UName'];

$debug = FALSE;

// check if DB exists
$database = $client->dbExists('ICT2103Team1', PhpOrient::DATABASE_TYPE_DOCUMENT);

$carplate_user = NULL;
$carIU_user =  NULL;

if ($debug){echo("Database status:<br>");}
//if DB exists
if (isset($database) && $database == TRUE){
	if ($debug){echo("ICT2103Team1 DB exists!<br>");}
	
	// open DB
	$cluster_map = $client->dbOpen('ICT2103Team1', 'root', 'ict2103!');
	
	// if DB opens successfully
	if (isset($cluster_map)){
		if ($debug){echo("ICT2103Team1 DB open successfully!<br><br>");}
		
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			//This is a POST method
			if (isset($_POST['deleteCar']) && isset($_POST['carIUValue'])) {
				$carPlateValue = $_POST["carplateValue"];
				$carIUValue = $_POST['carIUValue'];

				//$delcarsql = "DELETE FROM cars WHERE carPlate = '" . $carPlateValue'";
				$delcarsql = 'UPDATE user REMOVE car = car[carplate = "'.$carPlateValue.'"][car_IU_SN='. $carIUValue . '] WHERE userID = ' . $userID_Car . ';';
				if($debug){print_r($delcarsql . '<br/>');}
				$client->command($delcarsql);

			//added successful feedback alerts
				echo '<div class = "alert alert-block alert-success fade in">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				echo "<strong>Success!</strong> You have successfully removed this vehicle, " . $carPlateValue . ".";
				echo "</div >";
			}//End of isset($_POST)
			
		} // End IF
		
		//This is a GET method (which should be processed everytime)
		$sqlCars = "SELECT car.carplate AS carplate, car.car_IU_SN AS IU FROM User WHERE userID = " . $userID_Car.";";
		$result = $client->query($sqlCars);
			
		if($debug){print_r('What Type are you? :' . gettype($result). '<br/>');}
		//if($debug){print_r('My Content is :' . $result[0]. '<br/>');}
			
		if(count($result) > 0)
		{
			if($debug){print_r('My Content is :' . $result[0]. '<br/>');}
				
			//Copy all the information from ResultSet over to the global array variable
			$carplate_user = $result[0]->getOData()["carplate"];
			$carIU_user = $result[0]->getOData()["IU"];
				
			/*print_r("COUNT in CarPlate : " . count($carplate_user). '<br/>');
			print_r("COUNT in CarIU : " . count($carIU_user). '<br/>');
				
			print_r("Carplate[0] = " . $carplate_user[0] .'<br/> Carplate[1] = '. $carplate_user[1] . '<br/>');
			print_r("CarIU[0] = " . $carIU_user[0] .'<br/> Carplate[1] = '. $carIU_user[1] . '<br/>');*/
				
		}
		
	}
}

?>

<html>
    <head>
        <title>Delete Cars</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="deleteCarSuccessful.js"></script>
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
                <a href = "car.php" class = "btn btn-info" >Cars</a>
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
                    <a href = "modifyCars.php" class = "btn btn-warning">Modify</a>
                    <a href = "deleteCars.php" class = "btn btn-danger active">Delete</a>
                </div>

                <div class="jumbotron">
                    <p></p>

                    <?php
					
					if(isset($carplate_user) && isset($carIU_user))
					{
						//This represents that there is at least one record.
						echo "<h2>Cars that are registered:</h2>";
                        echo '<div class="table-responsive">';
                        echo '<table class="table table-bordered table-hover table-striped shrink">';
                        echo '<thead>';
                        echo "<tr><th>Car Plate Number</th>";
                        echo "<th>Car IU Serial Number</th>";
						$arrSize = count($carplate_user);
						//echo $arrSize;
						for($i=0;$i<$arrSize;$i++)
						{							
                            ?>
                            <form method='POST' action='deleteCars.php'>
                                <tr><td><?php echo $carplate_user[$i] ?></td>
                                    <td><?php echo $carIU_user[$i] ?></td>
                                <input type="hidden" name="carplateValue" value="<?php echo $carplate_user[$i]  ?>">
                                <input type="hidden" name="carIUValue" value="<?php echo $carIU_user[$i]  ?>">
                                <td> <input type='submit' name='deleteCar' class='btn btn-danger' value='Delete'> </td>
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
<?php
	//Closes the connection
	$client->dbClose();
?>
