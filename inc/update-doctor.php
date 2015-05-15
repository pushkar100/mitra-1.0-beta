<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_GET['doctorID']) && $_GET['doctorID'] &&
		isset($_GET['firstName']) && $_GET['firstName'] &&
		isset($_GET['lastName']) && $_GET['lastName'] &&
		isset($_GET['mobileNo']) && $_GET['mobileNo'] &&
		isset($_GET['contactNo']) && 		//can be empty
		isset($_GET['address']) && 			//can be empty
		isset($_GET['specialization']) ) {	//can be empty

		$doctorID = $_GET['doctorID'];
		$firstName = $_GET['firstName'];
		$lastName = $_GET['lastName'];
		$mobileNo = $_GET['mobileNo'];
		$contactNo = $_GET['contactNo'];
		$address = $_GET['address'];
		$specialization = $_GET['specialization'];

		if ( updateDoctor ($doctorID, $firstName, $lastName, $mobileNo, $contactNo, $address, $specialization, $connection) ) {
			$JSON_RESULT_ARRAY['ERROR'] = 0;
			$JSON_RESULT_ARRAY['SUCCESS_MSG'] = 'Doctor Profile Updated';

			//start session
			if (!session_id()) {
				session_start();
			}

			$_SESSION['firstName'] = $firstName;
			$_SESSION['lastName'] = $lastName;
			$_SESSION['mobileNo'] = $mobileNo;
			$_SESSION['contactNo'] = $contactNo;
			$_SESSION['address'] = $address;
			$_SESSION['specialization'] = $specialization;


		} else { //failure  - no doctor exists with same password and email
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Unable To Update Doctor Profile');
		}

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');
	}

	echo json_encode($JSON_RESULT_ARRAY);

?>