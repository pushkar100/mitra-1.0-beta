<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_GET['doctorID']) && $_GET['doctorID'] && 
		isset($_GET['orderBy']) && $_GET['orderBy'] ) {	

		$doctorID = $_GET['doctorID'];
		$orderBy = $_GET['orderBy'];

		$result = getMyDiagnoses ($doctorID, $orderBy, $connection);

		if ($result) { //success
			$JSON_RESULT_ARRAY = $result;
			$JSON_RESULT_ARRAY['ERROR'] = 0;
			$JSON_RESULT_ARRAY['SUCCESS_MSG'] = 'Details Of My Diagnoses Received';
		} else { //failure  
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Unable To Fetch My Diagnoses');
		}

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');
	}

	echo json_encode($JSON_RESULT_ARRAY);

?>