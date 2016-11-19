<?php

session_start();

include 'connectionDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //unset($_SESSION['statusLogin']);

    $uname = $_POST['username'];
    $pword = $_POST['password'];

    $sql_login = "SELECT * FROM userRelation WHERE userName = '{$uname}' AND userPassword ='{$pword}'";
    $user = $conn->query($sql_login);
    $userprofile = $user->fetchAll();

    if (count($userprofile) == 1) {
        $_SESSION['UID'] = $userprofile[0]['userID'];
        $_SESSION['UName'] = $userprofile[0]['userName'];
        $_SESSION['statusLogin'] = "1";
        header("location: homepage.php");
    } else {
        echo "PASSWORD WRONG";
        $_SESSION['statusLogin'] = "Wrong password!!";
        header("location: login.php");
    }
} else {
    $_SESSION['statusLogin'] = "No account found or wrong password please check again!!";
    header("location: login.php");
}
?>