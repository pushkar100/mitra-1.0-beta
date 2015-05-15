<?php

	include_once 'inc/functions/init.php';

	$diagnosisID = 11;

	$array = getImages ($diagnosisID, $connection);

	print_r($array);

?>