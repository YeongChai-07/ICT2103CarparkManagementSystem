<?php

session_start();

$_SESSION['statusLogin'] = "";
session_destroy();
header("location: login.php");
?>
