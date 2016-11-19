<?php

session_start();


if ($_SESSION['statusLogin'] == "") {
    header("location: login.php");
}
?>