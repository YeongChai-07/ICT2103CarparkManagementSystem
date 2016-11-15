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
                <h3>Book a Car</h3>
                <div class="jumbotron">
                    <div class ="row">
                        <div class ="col-md-8"></div>
                        <div class ="col-md-3"> 
                            <a href ="bookingHistory.php" id="history">View Booking History</a>
                        </div>
                    </div>
                    <div class ="row"></div>
                    <div class ="col-md-2"></div>
                    <div class="col-md-4">
                        <p></p>
                        <p></p>
                        <label for="street">Choose a street:</label>
                        <select class="selectpicker">Street Name
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <p></p>
                        <label for="street">Choose a carpark location:</label>
                        <!--<div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">-ALL CARPARKS-
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">1</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">3</a></li>
                            </ul>
                        </div> -->

                        <select class="selectpicker">ALL CARPARKS
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="row"></div>
                    <h4>Available Carparks</h4>
                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Carpark Location</th>
                                    <th>Available Lots</th>
                                    <th>Carpark Rate</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John</td>
                                    <td>1</td>
                                    <td>$10</td>
                                    <td><a href="bookingConfirm.php" class="btn btn-default" role="button">Book</a></td>
                                </tr>
                                <tr>
                                    <td>Mary</td>
                                    <td>10</td>
                                    <td>$40</td>
                                    <td><a href="bookingConfirm.php" class="btn btn-default" role="button">Book</a></td>
                                </tr>
                                <tr>
                                    <td>July</td>
                                    <td>20</td>
                                    <td>$5</td>
                                    <td><a href="bookingConfirm.php" class="btn btn-default" role="button">Book</a></td>
                                </tr>
                                <tr>

                                </tr>
                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
        </div>

    </body>
</html>