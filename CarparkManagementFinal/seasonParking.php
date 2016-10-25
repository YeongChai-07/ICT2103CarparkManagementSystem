<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Season Parking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="newcss.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel='stylesheet' type='text/css'  href='css/jquery-ui.css' />
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

        <script type="text/javascript">
            $(function () {
                $("#datepicker1").datepicker();
            });
        </script>

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
                <h3>Season Parking</h3>
                <p></p>

                <div class="jumbotron">
                    <div class ="row">
                        <div class ="col-md-8"></div>
                        <div class ="col-md-3"> 
                            <a href ="seasonParkingHistory.php" id="history">View Season Parkings</a>
                        </div>
                    </div>
                    <div class="container">
                        <form>
                            <div class ="col-md-5">
                                <div class="form-group">
                                    <label for="iu">Carpark:</label>
                                </div>
                                <p></p>
                                <div class="form-group">
                                    <label for="carplate">Cost:</label>
                                </div>
                                <div class="form-group">
                                    <label for="startdate">Start Date:</label>
                                </div>
                                <div class="form-group">
                                    <label for="enddate">End Date:</label>
                                </div>

                            </div> 
                            <div class ="col-md-1">
                                <select class="selectpicker">Carpark Name
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>

                                <p> </p>
                                <label for="SPcost">$200</label>
                                <p> </p>
                                <input type="text" id="datepicker" name="datepicker">
                                <input type="text" id="datepicker1" name="datepicker">

                            </div>
                        </form>
                    </div>
                    <div class ="row">
                        <div class ="col-md-9"></div>
                        <div class ="col-md-1">
                            <a href="seasonParking2.php" class="btn btn-default" role="button">Book</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </body>
</html>
