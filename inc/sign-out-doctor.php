<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if ( signOutDoctor() ) {

		$JSON_RESULT_ARRAY['ERROR'] = 0;
		$JSON_RESULT_ARRAY['SUCCESS_MSG'] = 'Doctor Sign Out Successful';

	} else { 

		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Doctor Sign Out Was Unsuccessful');

	}

	echo json_encode($JSON_RESULT_ARRAY);

?>