<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_POST['firstName']) && $_POST['firstName'] &&
		isset($_POST['lastName']) && $_POST['lastName'] && 
		isset($_POST['password']) && $_POST['password'] && 
		isset($_POST['email']) && $_POST['email'] &&
		isset($_POST['mobileNo']) && $_POST['mobileNo'] &&
		isset($_POST['contactNo']) && $_POST['contactNo'] && 
		isset($_POST['level']) && 					//level can be 0
		isset($_POST['sex']) && $_POST['sex'] && 
		isset($_POST['address']) && 				//address can be empty / NULL value
		isset($_POST['specialization']) && 		//specialization can be empty / NULL value
		isset($_POST['hospitalID']) ) {			//hospitalID can be empty / NULL value

		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$password = sha1($_POST['password']);
		$email = $_POST['email'];
		$mobileNo = $_POST['mobileNo'];
		$contactNo = $_POST['contactNo'];
		$level = $_POST['level'];
		$sex = $_POST['sex'];
		$address = $_POST['address'];
		$specialization = $_POST['specialization'];
		$hospitalID = $_POST['hospitalID'];

		if( addDoctor($firstName, $lastName, $password, $email, $mobileNo, $contactNo, $level, $sex, $address, $specialization, $hospitalID, $connection) ) {
			//successful
			$JSON_RESULT_ARRAY = array(	'ERROR' => 0, 
										'SUCCESS_MSG' => 'DOCTOR Successfully Added',
										'firstName' => $firstName, 
										'lastName' => $lastName, 
										'email' => $email,
										'level' => $level,
										'sex' => $sex, 
										'mobileNo' => $mobileNo, 
										'contactNo' => $contactNo, 
										'address' => $address, 
										'specialization' => $specialization,
										'hospitalID' => $hospitalID );

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