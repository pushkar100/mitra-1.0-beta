<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_GET['doctorID']) && $_GET['doctorID'] &&
		isset($_GET['patientID']) && $_GET['patientID'] && 
		isset($_GET['symptoms']) &&			//symptoms can be empty
		isset($_GET['diagnosis']) ) {			//diagnosis can be empty

		$doctorID = $_GET['doctorID'];
		$patientID = $_GET['patientID'];
		$symptoms = $_GET['symptoms'];
		$diagnosis = $_GET['diagnosis'];

		if( createDiagnosis($doctorID, $patientID, $symptoms, $diagnosis, $connection) ) {
			//successful
			$JSON_RESULT_ARRAY = array(	'ERROR' => 0, 
										'SUCCESS_MSG' => 'Diagnosis Successfully Added' );

		} else {
			//unsuccessful
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Could Not Execute Query');

		}

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');

	}

	echo json_encode($JSON_RESULT_ARRAY);

?>