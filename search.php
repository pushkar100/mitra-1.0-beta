<?php

	//include header
	include_once('templates/header.template.php');

	$searchKey = $_GET['searchKey'];

?>

	<div id="searchItemDiv">
		<?php echo "<h4>Search Key:</h4><p>$searchKey</p>";?>
	</div>

	<div id="matchingPatientsDiv">
		<h4 class="heading">Patient Search</h4>
	</div>

	<div id="matchingDiagnosesDiv">
		<h4 class="heading">Diagnoses Search</h4>
	</div>
	
<?php

	//include footer
	include_once('templates/footer.template.php');

?>
    		
