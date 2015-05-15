<?php

	//include header
	include_once('templates/header.template.php');

	$patientID = $_GET['patientID'];

	//include view patient template
	include_once('templates/view-patient.template.php');
	
	//include footer
	include_once('templates/footer.template.php');

?>