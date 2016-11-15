<?php

$host = "ict2103team1server.database.windows.net";
$user = "ict2103Team1";
$pwd = "ict2103!";
$db = "ict2103Team1";

// Connecting to database
try {
    $conn = new PDO("sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die(var_dump($e));
}
?>