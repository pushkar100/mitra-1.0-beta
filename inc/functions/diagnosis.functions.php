<?php

	function searchDiagnosis($diagnosisKey, $connection)
	{
		$diagnosisKey = mysqli_real_escape_string($connection, $diagnosisKey);

		$sql = "SELECT *
				FROM diagnosis
				WHERE symptoms LIKE '%$diagnosisKey%' OR diagnosis LIKE '%$diagnosisKey%' ";
		$result = mysqli_query($connection, $sql);

		//single dimensional array enough to return the result
		$result_2d_arr = array();

		if ( mysqli_num_rows($result) ) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'diagnosisID' => $row['diagnosisID'],
		        							'patientID' => $row['patientID'],
		        							'doctorID' => $row['doctorID'],
		        							'symptoms' => $row['symptoms'],
		        							'diagnosis' => $row['diagnosis'] );
		    }//End While
		}//End If

		return $result_2d_arr;

	} // end of function

	function deleteDiagnosis ($diagnosisID, $connection) {

		$diagnosisID = mysqli_real_escape_string($connection, $diagnosisID);

		$sql = "DELETE 
				FROM diagnosis 
				WHERE diagnosisID = $diagnosisID";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function

	function getDiagnosisDetails ($diagnosisID, $connection) {

		$diagnosisID = mysqli_real_escape_string($connection, $diagnosisID);

		$sql = "SELECT *
				FROM diagnosis
				WHERE diagnosisID = $diagnosisID";
		$result = mysqli_query($connection, $sql);

		//single dimensional array enough to return the result
		$result_arr;

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_arr = array (	'diagnosisID' => $row['diagnosisID'],
		        							'doctorID' => $row['doctorID'],
		        							'patientID' => $row['patientID'],
		        							'symptoms' => $row['symptoms'],
		        							'diagnosis' => $row['diagnosis'] );
		    }//End While
		}//End If

		return $result_arr;

	}//End of Function*/

	function getUneditedDiagnoses ($doctorID, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);

		$sql = "SELECT *
				FROM diagnosis
				WHERE doctorID = $doctorID
					AND symptoms = ''
					AND diagnosis = ''";
		$result = mysqli_query($connection, $sql);

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

	function getOriginalImage ($diagnosisID, $connection) {

		$diagnosisID = mysqli_real_escape_string($connection, $diagnosisID);

		$sql = "SELECT * 
				FROM images
				WHERE diagnosisID = $diagnosisID
					AND originalID IS NULL";
		$result = mysqli_query($connection, $sql);

		$result_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_arr = array (	'imageID' => $row['imageID'],
		        						'originalID' => $row['originalID'],
		        						'diagnosisID' => $row['diagnosisID'],
		        						'image' => $row['image'],
		        						'description' => $row['description'] );
		    }//End While
		}//End If

		return $result_arr;

	}

	function getImages ($diagnosisID, $connection) {

		$diagnosisID = mysqli_real_escape_string($connection, $diagnosisID);

		$sql = "SELECT imageID, image, diagnosisID
				FROM images
				WHERE diagnosisID = $diagnosisID";

		$result = mysqli_query($connection, $sql);

		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while( $row = mysqli_fetch_assoc($result) ) {
		        $result_2d_arr[] = array (	'imageID' => $row['imageID'],
		        						'diagnosisID' => $row['diagnosisID'],
		        						'image' => $row['image'] );
		    }//End While
		}//End If

		return $result_2d_arr;

	}

	function updateDiagnosis ($diagnosisID, $symptoms, $diagnosis, $connection) {

		$diagnosisID = mysqli_real_escape_string($connection, $diagnosisID);
		$symptoms = mysqli_real_escape_string($connection, $symptoms);
		$diagnosis = mysqli_real_escape_string($connection, $diagnosis);

		$sql = "UPDATE diagnosis
				SET symptoms = '".$symptoms."' , diagnosis = '".$diagnosis."'
				WHERE diagnosisID = $diagnosisID";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function

	function createDiagnosis ($doctorID, $patientID, $symptoms, $diagnosis, $connection) {

		$doctorID = mysqli_real_escape_string($connection, $doctorID);
		$patientID = mysqli_real_escape_string($connection, $patientID);
		$symptoms = mysqli_real_escape_string($connection, $symptoms);
		$diagnosis = mysqli_real_escape_string($connection, $diagnosis);

		$sql = "INSERT INTO 
				diagnosis (doctorID,
						patientID,
						symptoms,
						diagnosis)
				VALUES ($doctorID,
						$patientID,
						'$symptoms',
						'$diagnosis')";

		if (mysqli_query($connection, $sql)) {
		    return 1; //successfully executed query
		}
		else 
			return 0; //Error in executing query

	}//End of Function

?>