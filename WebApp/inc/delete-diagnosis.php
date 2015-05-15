<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_GET['diagnosisID']) && $_GET['diagnosisID'] ) {	

		$diagnosisID = $_GET['diagnosisID'];

		if ( deleteDiagnosis ($diagnosisID, $connection) ) {
			$JSON_RESULT_ARRAY['ERROR'] = 0;
			$JSON_RESULT_ARRAY['SUCCESS_MSG'] = 'Diagnosis Deleted';
		} else { //failure  - no doctor exists with same password and email
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Unable To Delete Diagnosis');
		}

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');
	}

	echo json_encode($JSON_RESULT_ARRAY);

?>