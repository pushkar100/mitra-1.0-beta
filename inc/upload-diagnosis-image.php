<?php

	//include all function files
	require_once('functions/init.php'); //init includes DB connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_POST['diagnosisID']) && $_POST['diagnosisID'] && 
		isset($_POST['description']) ) {			//description can be empty

		$diagnosisID = $_POST['diagnosisID'];
		$description = $_POST['description'];

		//=================================
		//Upload image to directory and DB
		//=================================
		$imageID = uploadImage($diagnosisID, $description, $connection);
		if ( $imageID )
		{
			$JSON_RESULT_ARRAY = array('ERROR' => 0, 'SUCCESS_MSG' => 'Image Has Been Uploaded Successfully');
			$JSON_RESULT_ARRAY['imageID'] = $imageID;

			$image = 'images/' . basename($_FILES["image"]["name"]);
			$JSON_RESULT_ARRAY['image'] = $image;

		} else {
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Image Could Not Be Uploaded. Maybe Duplicate Image');
		}
		/*=================================
		=================================*/

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');

	}

	echo json_encode($JSON_RESULT_ARRAY);

?>