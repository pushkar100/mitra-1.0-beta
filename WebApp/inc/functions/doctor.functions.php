<?php

	function updateDoctorPassword ($doctorID, $password, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);
		$password = mysqli_real_escape_string($connection, $password);

		$sql = "UPDATE doctors
				SET password = '$password' 
				WHERE doctorID = $doctorID";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function

	function updateDoctor ($doctorID, $firstName, $lastName, $mobileNo, $contactNo, $address, $specialization, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);
		$firstName = mysqli_real_escape_string($connection, $firstName);
		$lastName = mysqli_real_escape_string($connection, $lastName);
		$mobileNo = mysqli_real_escape_string($connection, $mobileNo);
		$contactNo = mysqli_real_escape_string($connection, $contactNo);
		$address = mysqli_real_escape_string($connection, $address);
		$specialization = mysqli_real_escape_string($connection, $specialization);

		$sql = "UPDATE doctors
				SET firstName = '$firstName' , 
					lastName = '$lastName', 
					mobileNo = '$mobileNo',
					contactNo = '$contactNo', 
					address = '$address', 
					specialization = '$specialization' 
				WHERE doctorID = $doctorID";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function

	function deleteDoctor ($doctorID, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);

		$sql = "DELETE 
				FROM doctors 
				WHERE doctorID = $doctorID";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function

	function isMyDiagnosis ($diagnosisID, $doctorID, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);
		$diagnosisID = mysqli_real_escape_string($connection, $diagnosisID);

		$sql = "SELECT *
				FROM diagnosis
				WHERE diagnosisID = $diagnosisID
					AND doctorID = $doctorID";

		$result = mysqli_query($connection, $sql);

		if($result) {

			if ( mysqli_num_rows($result) ) {
				return 1; // yes, my diagnosis
			} else {
				return 0; // not my diagnosis
			}

		} else {
			return 0; //unable to run query
		}

	} //end of fn

	function isMyPatient ($patientID, $doctorID, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);
		$patientID = mysqli_real_escape_string($connection, $patientID);

		$sql = "SELECT *
				FROM diagnosis
				WHERE patientID = $patientID
					AND doctorID = $doctorID";

		$result = mysqli_query($connection, $sql);

		if($result) {

			if ( mysqli_num_rows($result) ) {
				return 1; // yes, my patient
			} else {
				return 0; // not my patient
			}

		} else {
			return 0; //unable to run query
		}

	} //end of fn

	function getMyPatients ($doctorID, $orderBy, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);
		$orderBy = mysqli_real_escape_string($connection, $orderBy);

		if ($orderBy != '') {
			$sql = "SELECT DISTINCT patients.*
				FROM patients, diagnosis
				WHERE patients.patientID = diagnosis.patientID
					AND diagnosis.doctorID = $doctorID ORDER BY $orderBy DESC";
		}
		else {
			$sql = "SELECT patients.*
				FROM patients, diagnosis
				WHERE patients.patientID = diagnosis.patientID
					AND diagnosis.doctorID = $doctorID";
		}
		
		$result = mysqli_query($connection, $sql);

		//array to store result set
		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'patientID' => $row['patientID'],
		        							'firstName' => $row['firstName'],
		        							'lastName' => $row['lastName'],
		        							'sex' => $row['sex'],
		        							'mobileNo' => $row['mobileNo'],
		        							'contactNo' => $row['contactNo'],
		        							'dateOfBirth' => $row['dateOfBirth'],
		        							'address' => $row['address'] );
		    }//End While
		}//End If

		return $result_2d_arr;

	}//End of Function



	function getMyRecentPatients ($doctorID, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);

		$sql = "SELECT DISTINCT patients.*
				FROM patients, diagnosis
				WHERE patients.patientID = diagnosis.patientID
					AND diagnosis.doctorID = $doctorID LIMIT 5";
		$result = mysqli_query($connection, $sql);

		//array to store result set
		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'patientID' => $row['patientID'],
		        							'firstName' => $row['firstName'],
		        							'lastName' => $row['lastName'],
		        							'sex' => $row['sex'],
		        							'mobileNo' => $row['mobileNo'],
		        							'contactNo' => $row['contactNo'],
		        							'dateOfBirth' => $row['dateOfBirth'],
		        							'address' => $row['address'] );
		    }//End While
		}//End If

		return $result_2d_arr;

	}//End of Function



	function getMyDiagnoses ($doctorID, $orderBy, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);
		$orderBy = mysqli_real_escape_string($connection, $orderBy);

		if ($orderBy != '') {
			$sql = "SELECT *
				FROM diagnosis
				WHERE doctorID = $doctorID ORDER BY $orderBy DESC";
		}
		else {
			$sql = "SELECT *
				FROM diagnosis
				WHERE doctorID = $doctorID";
		}
		
		$result = mysqli_query($connection, $sql);

		//array to store result set
		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'diagnosisID' => $row['diagnosisID'],
		        							'doctorID' => $row['doctorID'],
		        							'patientID' => $row['patientID'],
		        							'symptoms' => $row['symptoms'],
		        							'diagnosis' => $row['diagnosis'] );
		    }//End While
		}//End If

		return $result_2d_arr;

	}//End of Function


	function getMyRecentDiagnoses ($doctorID, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);

		$sql = "SELECT *
				FROM diagnosis
				WHERE doctorID = $doctorID LIMIT 5";
		$result = mysqli_query($connection, $sql);

		//array to store result set
		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'diagnosisID' => $row['diagnosisID'],
		        							'doctorID' => $row['doctorID'],
		        							'patientID' => $row['patientID'],
		        							'symptoms' => $row['symptoms'],
		        							'diagnosis' => $row['diagnosis'] );
		    }//End While
		}//End If

		return $result_2d_arr;

	}//End of Function



	function getDoctorDetails ($doctorID, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);

		$sql = "SELECT *
				FROM doctors
				WHERE doctorID = $doctorID";
		$result = mysqli_query($connection, $sql);

		//single dimensianal array is enough to store the result.

		if (mysqli_num_rows($result) == 1) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_arr = array (	'doctorID' => $row['doctorID'],
		        							'firstName' => $row['firstName'],
		        							'lastName' => $row['lastName'],
		        							'email' => $row['email'],
		        							'mobileNo' => $row['mobileNo'],
		        							'contactNo' => $row['contactNo'],
		        							'level' => $row['level'],
		        							'sex' => $row['sex'],
		        							'address' => $row['address'],
		        							'specialization' => $row['specialization'],
		        							'hospitalID' => $row['hospitalID'] );
		    }//End While
		}//End If

		return $result_arr;

	}//End of Function

	function signInDoctor($email, $password, $connection) {

		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);

		$sql = "SELECT *
				FROM doctors
				WHERE email = '".$email."'
				AND password = '".$password."'";
		$result = mysqli_query($connection, $sql);

		//single dimensional array is enough

		if ($result) {

			if (mysqli_num_rows($result)) {

				$row = mysqli_fetch_assoc($result);
				$result_arr = array (	'doctorID' => $row['doctorID'],
		        					'firstName' => $row['firstName'],
		        					'lastName' => $row['lastName'],
		        					'email' => $row['email'],
		        					'mobileNo' => $row['mobileNo'],
		        					'contactNo' => $row['contactNo'],
		        					'level' => $row['level'],
		        					'sex' => $row['sex'],
		        					'address' => $row['address'],
		        					'specialization' => $row['specialization'],
		        					'hospitalID' => $row['hospitalID'] );

				if (!session_id()) {
					session_start();
				} //end of start session

				$_SESSION['doctorID'] = $row['doctorID'];
				$_SESSION['firstName'] = $row['firstName'];
				$_SESSION['lastName'] = $row['lastName'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['mobileNo'] = $row['mobileNo'];
				$_SESSION['contactNo'] = $row['contactNo'];
				$_SESSION['level'] = $row['level'];
				$_SESSION['sex'] = $row['sex'];
				$_SESSION['address'] = $row['address'];
				$_SESSION['specialization'] = $row['specialization'];
				$_SESSION['hospitalID'] = $row['hospitalID'];

				return $result_arr;

			} else 
				return 0;

		} else 
			return 0;

	}// end of function

	function signOutDoctor() {
		
		if (!session_id()) {
			session_start();
		} //end of start session

		unset($_SESSION['firstName']);
		unset($_SESSION['lastName']);
		unset($_SESSION['email']);
		unset($_SESSION['mobileNo']);
		unset($_SESSION['contactNo']);
		unset($_SESSION['level']);
		unset($_SESSION['sex']);
		unset($_SESSION['address']);
		unset($_SESSION['specialization']);
		unset($_SESSION['hospitalID']);

		session_destroy();

		return 1;

	} //end of function

?>