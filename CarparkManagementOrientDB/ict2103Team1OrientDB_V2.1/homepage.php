<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.


-->

<?php
include 'checksession.php';
include 'connectionDB.php';
require realpath(__DIR__.'/PhpOrient-master/vendor/').'\autoload.php';
use PhpOrient\PhpOrient;


$usernameDisplay = $_SESSION['UName'];
?>

<html>
    <head>
        <title>Carpark Management - Homepage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href = "css/newcss.css" rel = "stylesheet" type = "text/css"/>
    </head>

    <body background="img/bg/car.jpg">
<!--        <div class = "container">
            <div class = "row">

                <div class = "col-md-6 col-md-offset-3">
                    <h2>Carpark Management System</h2>
                    <h3>Welcome, <?php echo $usernameDisplay ?>!</h3>
                    <div></div>
                    <div class = "btn-group btn-group-justified">
                        <a href = "car.php" class = "btn btn-info" >Cars</a>
                        <a href = "seasonParking.php" class = "btn btn-info">Season Parking</a>
                        <a href = "booking.php" class = "btn btn-info" >Bookings</a>
                    </div>
                    <div class="row">
                        <br></br>
                        <a href="logout.php"<button class="btn btn-warning btn-sm" name="back" type="submit" style="float: right;">Log Out</button></a>
                    </div>
                </div>
            </div>
        </div>-->


<nav class ="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class ="container-fluid" style="color: #fff;">
        <div class ="container">
            <div class = "navbar-header">
                <button type="button" class ="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-ex-collapse" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1 class ="site-title" style ="margin-top: 0px; width: 90px">
                    <a href ="homepage.php">
                        <img class ="img-responsive" src="/img/bg/logo.png" alt="Carpark Management System">
                    </a>
                </h1>
            </div>
            <div id="navbar-ex-collapse" class="navbar-collapse collapse" aria-expanded ="false" style ="height: 0.666667px; color: #fff;">
                <ul id="menu-top-menu" class ="nav navbar-nav navbar-right">
                    <li id="menu-item-235" class="menu-item menu-item-type-post_type menu-item-object-page page_item page-item-234 menu-item-235">
                        <a title="Cars" href="car.php">Cars</a>
                    </li> 
                     <li id="menu-item-203" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-203">
                        <a title="Season Parking" href="seasonParking.php">Season Parking</a>
                    </li>
                    <li id="menu-item-204" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-204">
                        <a title="Booking" href="booking.php">Booking</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<section id ="welcome" class ="hero" style ="background-position: 50% -30px;">
    
    <div class ="blacklayer"></div>
    <div class ="container">
        <div class ="row">
            <div class ="col-md-12">
                <h1>Carpark</h1>
                <h2> Management System</h2>
                <div class ="lead text-center" style="font-size: 24px; 
                     line-height: 32px; color: #fff; font-weight: 400; text-shadow: 0 0 6px rgba(0,0,0,0.75);
                     text-align: center;">
                    <p style="margin-bottom: 5px;">A simple & convenient way to book a carpark lot 
                        <br>
                    or manage your Season Parkings!
                    </p>
                </div>
                <div class ="col-md-6 text-right">
                    <a href ="booking.php" class ="btn btn-lg btn-secondary">BOOK NOW</a>
                </div>
            </div>
        </div>
    </div>
</section>

    </body>
</html>