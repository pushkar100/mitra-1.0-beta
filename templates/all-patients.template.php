	<form id="addPatientForm">
		<h4 class="heading">Register New Patient</h4>
		<p style="color: blue;" id="addPatientFormError"></p>
		<table>
			<tr>
				<td>First Name</td>
				<td><input type="text" id="firstNameAP" name="firstName"></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input type="text" id="lastNameAP" name="lastName"></td>
			</tr>
			<tr>
				<td>Sex</td>
				<td><input type="text" id="sexAP" name="sex" placeholder="M or F"></td>
			</tr>
			<tr>
				<td>Mobile No</td>
				<td><input type="text" id="mobileNoAP" name="mobileNo"></td>
			</tr>
			<tr>
				<td>Contact No</td>
				<td><input type="text" id="contactNoAP" name="contactNo"></td>
			</tr>
			<tr>
				<td>Date Of Birth</td>
				<td><input type="date" id="dateOfBirthAP" name="dateOfBirth"></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" id="addressAP" name="address"></td>
			</tr>
			<tr>
				<td><input class="button" type="submit" value="Register"></td>
			</tr>
		</table>
	</form>

	<div id="allPatientsDiv">
		<h4 class="heading">My Patients</h4>
		<table id="allPatientsTable">
			<thead>
				<tr>
					<th>Patient ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Sex</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="allPatientsTableBody">
				
			</tbody>
		</table>
		<p id="allPatientsErrorDiv"></p>
	</div>