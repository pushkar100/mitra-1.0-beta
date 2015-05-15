<?php 

	function getQuickSearchPatients ($searchItem, $connection) {

		$searchItem = mysqli_real_escape_string($connection, $searchItem);

		$sql = "SELECT x.patientID, x.firstName, x.lastName
				FROM (SELECT patientID, firstName, lastName FROM patients ORDER BY patientID DESC LIMIT 50) AS x
				WHERE firstName LIKE '%$searchItem%'
					OR lastName LIKE '%$searchItem%' ";
		$result = mysqli_query($connection, $sql);

		//2D array enough to return the result
		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'patientID' => $row['patientID'],
		        							'firstName' => $row['firstName'],
		        							'lastName' => $row['lastName']);
		    }//End While
		}//End If

		return $result_2d_arr;

	}//End of Function*/


	function getQuickSearchDiagnosis ($searchItem, $connection) {

		$searchItem = mysqli_real_escape_string($connection, $searchItem);

		$sql = "SELECT x.diagnosisID, x.symptoms, x.diagnosis
				FROM (SELECT diagnosisID, symptoms, diagnosis FROM diagnosis ORDER BY diagnosisID DESC LIMIT 50) AS x
				WHERE symptoms LIKE '%$searchItem%'
					OR diagnosis LIKE '%$searchItem%' ";
		$result = mysqli_query($connection, $sql);

		//2D array enough to return the result
		$result_2d_arr = array();

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $result_2d_arr[] = array (	'diagnosisID' => $row['diagnosisID'],
		        							'symptoms' => $row['symptoms'],
		        							'diagnosis' => $row['diagnosis']);
		    }//End While
		}//End If

		return $result_2d_arr;

	}//End of Function*/

?>