<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_POST['doctorID']) && $_POST['doctorID'] &&
		isset($_POST['password']) && $_POST['password'] ) {	//can be empty

		$doctorID = $_POST['doctorID'];
		$password = sha1($_POST['password']);

		if ( updateDoctorPassword ($doctorID, $password, $connection) ) {
			$JSON_RESULT_ARRAY['ERROR'] = 0;
			$JSON_RESULT_ARRAY['SUCCESS_MSG'] = 'Doctor Password Updated';
		} else { //failure  - no doctor exists with same password and email
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Unable To Update Doctor Password');
		}

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');
	}

	echo json_encode($JSON_RESULT_ARRAY);

?>