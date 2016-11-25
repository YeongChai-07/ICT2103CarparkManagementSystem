<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
                <h3>My Carpark Bookings</h3>
                <div class="jumbotron">
                <div class="row"></div>
                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Reserved Lots</th>
                                    <th>Carpark Location</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>89</td>
                                    <td>Blk...</td>
                                    <td>16/10/2016</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>89</td>
                                    <td>Blk...</td>
                                    <td>16/10/2016</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>89</td>
                                    <td>Blk...</td>
                                    <td>16/10/2016</td>
                                </tr>
                                <tr>
                                    
                                </tr>
                            </tbody>
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
