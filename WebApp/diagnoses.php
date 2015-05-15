<?php

	//include header
	include_once('templates/header.template.php');

	?>

<form id="addDiagnosisForm">
	<h4 class="heading">Create New Diagnosis</h4>
	<p style="color: #ccc;" id="addDiagnosisFormInformation">Only For 'My Patients'. New Patient Diagnosis? Create New Patient</p>
	<p style="color: blue;" id="addDiagnosisFormError"></p>
	<table>
		<tr>
			<td>Patient</td>
			<td><select id="patientSelect"></select></td>
		</tr>
		<tr>
			<td>Symptoms</td>
			<td><textarea name="symptoms" id="symptomsAD" rows="3" cols="50" placeholder="Can Be Edited Later"></textarea></td>
		</tr>
		<tr>
			<td>Diagnosis</td>
			<td><textarea name="diagnosis" id="diagnosisAD" rows="3" cols="50" placeholder="Can Be Edited Later"></textarea></td>
		</tr>
		<tr>
			<td><input class="button" type="submit" value="Create Diagnosis"></td>
		</tr>
	</table>
</form>

	<?php

	//include recent patients
	include_once('templates/all-diagnoses.template.php');

	//include footer
	include_once('templates/footer.template.php');

?>
    		
