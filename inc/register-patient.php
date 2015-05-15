<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_GET['firstName']) && $_GET['firstName'] &&
		isset($_GET['lastName']) && $_GET['lastName'] &&
		isset($_GET['sex']) && $_GET['sex'] &&
		isset($_GET['mobileNo']) && $_GET['mobileNo'] &&
		isset($_GET['contactNo']) && $_GET['contactNo'] &&
		isset($_GET['dateOfBirth']) && $_GET['dateOfBirth'] &&
		isset($_GET['address']) && $_GET['address']) {

		$firstName = $_GET['firstName'];
		$lastName = $_GET['lastName'];
		$sex = $_GET['sex'];
		$mobileNo = $_GET['mobileNo'];
		$contactNo = $_GET['contactNo'];
		$dateOfBirth = $_GET['dateOfBirth'];
		$address = $_GET['address'];

		$result = addPatient($firstName, $lastName, $sex, $mobileNo, $contactNo, $dateOfBirth, $address, $connection);

		if( $result ) {
			//successful
			$JSON_RESULT_ARRAY = array(	'ERROR' => 0, 
										'SUCCESS_MSG' => 'Patient Successfully Added',
										'firstName' => $firstName, 
										'lastName' => $lastName, 
										'sex' => $sex, 
										'mobileNo' => $mobileNo, 
										'contactNo' => $contactNo, 
										'dateOfBirth' => $dateOfBirth, 
										'address' => $address,
										'patientID' => $result );

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