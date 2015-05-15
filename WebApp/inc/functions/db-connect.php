<?php

	/*$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sankaraproject";*/

	$servername = "mysql11.000webhost.com";
	$username = "a1501833_cmrit";
	$password = "cmrit123";
	$dbname = "a1501833_mitra";


	// Create connection
	$connection = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$connection) {
	    die("Connection failed: " . mysqli_connect_error());
	}

?>