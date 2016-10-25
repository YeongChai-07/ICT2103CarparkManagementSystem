<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Add Cars</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="newcss.css">
    </head>
    <body>
        <h1> Carpark Management System </h1>
        <nav class="navbar navbar-default" style="width:50%; margin:0 auto; text-align: center;">
            <div class="container-fluid" style="width:50%; margin:0 auto; text-align: center;" >
                <ul class="nav navbar-nav" id="nav">
                    <li class="active" ><a href="addCars.php">Cars</a></li>
                    <li><a href="seasonParking.php">Season Parking</a></li>
                    <li><a href="booking.php">Bookings</a></li>
                </ul>
            </div>
        </nav>


        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3>Cars</h3>
                <div></div>
                <div class="btn-group btn-group-justified">
                    <a href="addCars.php" class="btn btn-info active">Add</a>
                    <a href="modifyCars.php" class="btn btn-info">Modify</a>
                    <a href="deleteCars.php" class="btn btn-info">Delete</a>
                </div>
                <div class="jumbotron">
                    <h4>Car Details - Add a Car</h4>
                    <div class="container">
                        <form>
                            <div class="form-group">
                                <label for="iu">IU Serial Number:</label>
                                <input type="text" class="form-control" id="iu">
                            </div>
                            <div class="form-group">
                                <label for="carplate">Car Plate Number:</label>
                                <input type="text" class="form-control" id="carplate">
                            </div>
                            <div class ="row">
                                <div class ="col-md-10"></div>
                                <div class ="col-md-2">
                                    <button type="button" id = "cfmbtn" class="btn btn-default">Confirm</button>
                                </div>
                            </div>
                        </form>
                        <p></p>
                        <div class="alert alert-success">
                            <strong>Success!</strong> Your car has been added successfully!
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
