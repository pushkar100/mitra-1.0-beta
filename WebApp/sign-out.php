<?php

	//start session
	if (!session_id()) {
		session_start();
	}

	require_once('inc/functions/init.php');

	if (signOutDoctor()) 
		header('location: sign-in.php');
	else 
		header('location: index.php');

?>