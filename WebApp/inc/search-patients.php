<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_GET['patientKey']) && $_GET['patientKey'] ) {	

		$patientKey = $_GET['patientKey'];

		$result = searchPatient($patientKey, $connection);

		if ($result) { //success
			$JSON_RESULT_ARRAY = $result;
			$JSON_RESULT_ARRAY['ERROR'] = 0;
			$JSON_RESULT_ARRAY['SUCCESS_MSG'] = 'Matching Patients Have Been Listed';
		} else { //failure  
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'No Results.');
		}

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');
	}

	echo json_encode($JSON_RESULT_ARRAY);

?>