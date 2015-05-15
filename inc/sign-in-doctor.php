<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_POST['email']) && $_POST['email'] &&
		isset($_POST['password']) && $_POST['password'] ) {	

		$email = $_POST['email'];
		$password = sha1($_POST['password']);

		$result = signInDoctor($email, $password, $connection);

		if ($result) {
			$JSON_RESULT_ARRAY = $result;
			$JSON_RESULT_ARRAY['ERROR'] = 0;
			$JSON_RESULT_ARRAY['SUCCESS_MSG'] = 'Doctor Has Been Authenticated and Signed In';
		} else { //failure  - no doctor exists with same password and email
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Email or Password Is Incorrect');
		}

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');
	}

	echo json_encode($JSON_RESULT_ARRAY);

?>