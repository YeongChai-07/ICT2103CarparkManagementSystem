<?php
session_start();

include 'connectionDB.php';
require realpath(__DIR__.'/PhpOrient-master/vendor/').'\autoload.php';
use PhpOrient\PhpOrient;

// check if DB exists
$database = $client->dbExists('ICT2103Team1', PhpOrient::DATABASE_TYPE_DOCUMENT);

if ($debug){echo("Database status:<br>");}
//if DB exists
if (isset($database) && $database == TRUE){
	if ($debug){echo("ICT2103Team1 DB exists!<br>");}
	
	// open DB
	$cluster_map = $client->dbOpen('ICT2103Team1', 'root', 'ict2103!');
	
	// if DB opens successfully
	if (isset($cluster_map)){
		if ($debug){echo("ICT2103Team1 DB open successfully!<br><br>");}
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			// obtain username and password from user forms
			$uname = $_POST['username'];
			$pword = $_POST['password'];

			if ($debug){echo("Query information: <br>");}
			// query database for login credentials. Returns array of objects
			$query = "SELECT * FROM user WHERE userName = '{$uname}' AND userPassword = '{$pword}'";
			if ($debug) {echo("Query: " . $query . "<br>");}
			$record = $client->query($query);
			if ($debug){echo("Return type: " . gettype($record) . "<br>");}
			if ($debug){echo("Size of array: " . sizeof($record) . "<br>");}
			if ($debug){echo ("Array data: " . implode(" ", $record) . "<br>");}
			
			// there can only be one returned tuple
			if (sizeof($record) == 1){
				
				// save user information to session
				if ($debug){echo("userID: " . $record[0]->getOData()["userID"] . "<br>");}		
				$_SESSION['UID'] = $record[0]->getOData()["userID"];
				if ($debug){echo("userName: " . $record[0]->getOData()["userName"] . "<br>");}				
				$_SESSION['UName'] = $record[0]->getOData()["userName"];
				$_SESSION['statusLogin'] = "1";
				
				// redirect user to homepage
				header("location: homepage.php");
			}
			// no returned tuples
			else{
				$_SESSION['statusLogin'] = "Wrong password!!";
				
				// redirect user to login page
				header("location: login.php");
			}
		}
	}
	
	// if DB fails to open
	else{
		if ($debug){echo("ICT2103Team1 DB failed to open!<br><br>");}
	}
}
// if DB does not exists
else{
	if ($debug){echo("ICT2103Team1 DB does not exists!<br>");}
}
?>