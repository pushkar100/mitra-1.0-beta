<?php

	function startSession () {
		//start a session.
		if (!session_id()) {
		  session_start();
		}
	}

	function getAllDoctors ($connection) {

		$sql = "SELECT * 
				FROM doctors";
		$result = mysqli_query($connection, $sql);

		//array to store result set
		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'doctorID' => $row['doctorID'],
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

		return $result_2d_arr;

	}//End of Function



	function getAllPatients ($connection) {

		$sql = "SELECT * 
				FROM patients";
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



	function getAllDiagnoses ($connection) {

		$sql = "SELECT * 
				FROM diagnosis";
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



	function getAllImages ($connection) {

		$sql = "SELECT * 
				FROM images";
		$result = mysqli_query($connection, $sql);

		//array to store result set
		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'imageID' => $row['imageID'],
		        							'originalID' => $row['originalID'],
		        							'diagnosisID' => $row['diagnosisID'],
		        							'image' => $row['image'],
		        							'description' => $row['description'] );
		    }//End While
		}//End If

		return $result_2d_arr;

	}//End of Function



	function getAllThumbnails ($connection) {

		$sql = "SELECT * 
				FROM thumbnails";
		$result = mysqli_query($connection, $sql);

		//array to store result set
		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'imageID' => $row['imageID'],
		        							'thumbImage' => $row['thumbImage'] );
		    }//End While
		}//End If

		return $result_2d_arr;

	}//End of Function


	function addDoctor ($firstName, $lastName, $password, $email, $mobileNo, $contactNo, $level, $sex, $address, $specialization, $hospitalID, $connection ) {

		$firstName = mysqli_real_escape_string($connection, $firstName);
		$lastName = mysqli_real_escape_string($connection, $lastName);
		$password = mysqli_real_escape_string($connection, $password);
		$email = mysqli_real_escape_string($connection, $email);
		$mobileNo = mysqli_real_escape_string($connection, $mobileNo);
		$contactNo = mysqli_real_escape_string($connection, $contactNo);
		$level = mysqli_real_escape_string($connection, $level);
		$sex = mysqli_real_escape_string($connection, $sex);
		$address = mysqli_real_escape_string($connection, $address);
		$specialization = mysqli_real_escape_string($connection, $specialization);
		$hospitalID = mysqli_real_escape_string($connection, $hospitalID);

		$sql = "INSERT INTO 
				doctors (firstName,
						lastName,
						password,
						email,
						mobileNo,
						contactNo,
						level,
						sex,
						address,
						specialization,
						hospitalID)
				VALUES ('$firstName',
						'$lastName',
						'$password',
						'$email',
						'$mobileNo',
						'$contactNo',
						$level,
						'$sex',
						'$address',
						'$specialization',
						$hospitalID)";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function	



	function addPatient ($firstName, $lastName, $sex, $mobileNo, $contactNo, $dateOfBirth, $address, $connection) {

		$firstName = mysqli_real_escape_string($connection, $firstName);
		$lastName = mysqli_real_escape_string($connection, $lastName);
		$sex = mysqli_real_escape_string($connection, $sex);
		$mobileNo = mysqli_real_escape_string($connection, $mobileNo);
		$contactNo = mysqli_real_escape_string($connection, $contactNo);
		$dateOfBirth = mysqli_real_escape_string($connection, $dateOfBirth);		
		$address = mysqli_real_escape_string($connection, $address);

		$sql = "INSERT INTO 
				patients (firstName,
						lastName,
						sex,
						mobileNo,
						contactNo,
						dateOfBirth,
						address)
				VALUES ('$firstName',
						'$lastName',
						'$sex',
						'$mobileNo',
						'$contactNo',
						'$dateOfBirth',
						'$address')";

		if (mysqli_query($connection, $sql)) {
		    return mysqli_insert_id($connection); //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function

?>