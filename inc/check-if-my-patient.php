<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_GET['patientID']) && $_GET['patientID'] && 
		isset($_GET['doctorID']) && $_GET['doctorID'] ) {	

		$patientID = $_GET['patientID'];
		$doctorID = $_GET['doctorID'];

		$result = isMyPatient ($patientID, $doctorID, $connection);

		if ($result) { 
			$JSON_RESULT_ARRAY['ERROR'] = 0;
			$JSON_RESULT_ARRAY['SUCCESS_MSG'] = 'Yes, My Patient';
		} else { 
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Not My Patient.');
		}

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');
	}

	echo json_encode($JSON_RESULT_ARRAY);

?>