<?php

session_start();

include 'connectionDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    unset($_SESSION['statusLogin']);
    $userID = $_POST['username'];
    $pword = $_POST['password'];
    
    $sql_login = "SELECT * FROM dbo.userRelation WHERE userName = '{$userID}' AND userPassword ='{$pword}'";
    $user = $conn->query($sql_login);
    $userprofile = $user->fetchAll();

    if (count($userprofile) == 1) {
        $_SESSION['username'] = $userprofile[0]['userName'];
        $_SESSION['userID'] = $userID;
        $_SESSION['status'] = "1";
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

$stmt->close();
?>