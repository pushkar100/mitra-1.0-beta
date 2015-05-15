<?php

	//include all function files
	require_once('functions/init.php'); //init includes DBc connection as well

	//all communications are through JSON objects
	header('Content-Type: application/json');//hence, set content type to 'application/json' only

	if(	isset($_GET['imageID']) && $_GET['imageID'] && 
		isset($_GET['image']) && $_GET['image'] ) {	

		$imageID = $_GET['imageID'];
		$image = $_GET['image'];

		$result = generateThumbnail($imageID, $image, $connection);

		if ($result) { 
			$JSON_RESULT_ARRAY['ERROR'] = 0;
			$JSON_RESULT_ARRAY['SUCCESS_MSG'] = 'Thumbnail Generated';
		} else { 
			$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Thumbnail Not Generated.');
		}

	} else {
		//necessary parameters not set
		$JSON_RESULT_ARRAY = array('ERROR' => 1, 'ERROR_MSG' => 'Required Parameters Have Not Been Set');
	}

	echo json_encode($JSON_RESULT_ARRAY);

?>