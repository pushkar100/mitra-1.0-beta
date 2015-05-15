<div id="diagnosisDiv">

	<div id="viewDiagnosis">
		<h4 class="heading">View Diagnosis <button class="button" id="deleteDiag">Delete Diagnosis</button></h4>
		<table>
			<tr>
				<td>Diagnosis ID</td>
				<td id="displayDiagnosisID"><?php echo $diagnosisID; ?></td>
			</tr>
			<tr>
				<td>Patient ID</td>
				<td id="displayPatientID"></td>
			</tr>
			<tr>
				<td>Patient Name</td>
				<td id="displayPatientName"></td>
			</tr>
			<tr>
				<td>Symptoms</td>
				<td id="displaySymptoms"></td>
			</tr>
			<tr>
				<td>Diagnosis</td>
				<td id="displayDiagnosis"></td>
			</tr>
		</table>
	</div>

	<form id="editDiagnosisForm">
		<h4 class="heading">Edit Diagnosis</h4> 
		<table>
			<tr>
				<td>Symptoms</td>
				<td><textarea id="symptomsEdit" cols="50" rows="3"></textarea></td>
			</tr>
			<tr>
				<td>Diagnosis</td>
				<td><textarea id="diagnosisEdit" cols="50" rows="3"></textarea></td>
			</tr>
			<tr>
				<td><input class="button" type="submit" value="Update"></td>
			</tr>
		</table>
	</form>

	<h4 class="heading">Capture/Upload Image</h4>
	<h5 style="color: blue;" id="message"></h5>
	<h5 style="color: orange;" id="thumbMessage"></h5>
	<form id="addImageToDiagnosis" method="post" enctype="multipart/form-data">
		  <input class="button" name="image" type="file" accept="image/*" id="capture" capture="camera"/> <br><br>
		  <?php echo "<input type='hidden' id='diagnosisID' name='diagnosisID' value='$diagnosisID'>"; ?><br><br>
		  <textarea rows="3" cols="50" id="description" name="description" placeholder="description"></textarea><br><br>
		  <input class="button" type="submit" value="upload">
	</form>

	<div id="diagnosisImages">
		<h4 class="heading">Diagnosis Images</h4>
		<div id="slider">
		</div>
	</div>

	<img id="fullImage">

</div>