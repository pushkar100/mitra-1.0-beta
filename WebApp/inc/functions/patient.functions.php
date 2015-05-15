<?php

	function searchPatient($patientKey, $connection)
	{
		$patientKey = mysqli_real_escape_string($connection, $patientKey);

		$sql = "SELECT *
				FROM patients
				WHERE firstName LIKE '%$patientKey%' OR lastName LIKE '%$patientKey%' ";
		$result = mysqli_query($connection, $sql);

		//single dimensional array enough to return the result
		$result_2d_arr = array();

		if ( mysqli_num_rows($result) ) {
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

	} // end of function

	function deletePatient ($patientID, $connection) {

		$patientID = mysqli_real_escape_string($connection, $patientID);

		$sql = "DELETE 
				FROM patients 
				WHERE patientID = $patientID";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function

	function getPatientDetails ($patientID, $connection) {

		$patientID = mysqli_real_escape_string($connection, $patientID);

		$sql = "SELECT *
				FROM patients
				WHERE patientID = $patientID";
		$result = mysqli_query($connection, $sql);

		//single dimensional array enough to return the result

		if (mysqli_num_rows($result) == 1) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_arr = array (	'patientID' => $row['patientID'],
		        							'firstName' => $row['firstName'],
		        							'lastName' => $row['lastName'],
		        							'sex' => $row['sex'],
		        							'mobileNo' => $row['mobileNo'],
		        							'contactNo' => $row['contactNo'],
		        							'dateOfBirth' => $row['dateOfBirth'],
		        							'address' => $row['address'] );
		    }//End While
		}//End If

		return $result_arr;

	}//End of Function



	function getPatientAllDiagnoses ($patientID, $connection) {

		$patientID = mysqli_real_escape_string($connection, $patientID);

		$sql = "SELECT *
				FROM diagnosis
				WHERE patientID = $patientID";
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

?>