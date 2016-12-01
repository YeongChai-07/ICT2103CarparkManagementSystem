<?php

$debug = FALSE;

// enable PHP to work with OrientDB
require realpath(__DIR__.'/PhpOrient-master/vendor/').'\autoload.php';
use PhpOrient\PhpOrient;

// connect to OrientDB server
$client = new PhpOrient('52.187.72.97', 2424);
$client->username = 'root';
$client->password = 'ict2103!';
$client->connect();

// DEBUG: print if connection to OrientDB is successful
if ($debug){
	echo("OrientDB status:<br>");
	if (!isset($client)) {
		print_r("Unable to connect to OrientDB!<br>");
	} else {
		print_r("Connection to OrientDB sucessful!<br>");
	}	
	echo("<br>");
}
?>