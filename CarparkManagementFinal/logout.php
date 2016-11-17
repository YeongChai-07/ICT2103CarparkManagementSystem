<?php

session_start();
$_SESSION['status'] = "";
session_destroy();
header("location: login.php");
?>
