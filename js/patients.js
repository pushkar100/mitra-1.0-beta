$(document).ready( function () {

	var doctorID = $('#doctorID').text();
	var firstName = $('#firstName').text();
	var lastName = $('#lastName').text();
	var email = $('#email').text();
	var mobileNo = $('#mobileNo').text();
	var contactNo = $('#contactNo').text();
	var level = $('#level').text();
	var sex = $('#sex').text();
	var address = $('#address').text();
	var specialization = $('#specialization').text();
	var hospitalID = $('#hospitalID').text();

	//get all patients
	getMyPatients();

	//get patient diagnoses
	getPatientDetailsAndDiagnoses();


	//delete patient
	$('#deletePat').click(function () { 

		var patID = $('#viewPatientPID').text();

		var url = 'inc/delete-patient.php';
		var urlData = 'patientID=' + patID;

		$.getJSON(url, urlData, delPatCB);
		function delPatCB (data) {

			if (!data.ERROR) {
				$('#viewPatient').html("<h4 class='heading'>Patient Deleted</h4><tr><td>" + data.SUCCESS_MSG + " <a href='patients.php'>Back To Patients</a></td></tr>")
			}
			else {
				$('#viewPatient table').html("<tr><td>" + data.ERROR_MSG + " <a href='view-patient.php?patientID=" + patID + "'>View Patient</a></td></tr>")
			}
		}

	});


	$('#addPatientForm').submit( function(e) {

		e.preventDefault();

		var url = 'inc/register-patient.php';
		var urlData = $('#addPatientForm').serialize();

		$.getJSON(url, urlData, processRegisterPatient);
		function processRegisterPatient (data) {

			if (data.ERROR) {
				$('#addPatientFormError').text(data.ERROR_MSG);
			} else {
				$('#addPatientFormError').text(data.SUCCESS_MSG);
				var msg = '<tr><td>Added. Patient ID = ' + data.patientID + '</td>/<tr>';
				$('#addPatientForm table').html(msg);

				var newURL = 'inc/create-diagnosis.php';
				var newURLData = 'doctorID=' + doctorID + '&patientID=' + data.patientID + '&symptoms=&diagnosis=';

				$.getJSON(newURL, newURLData, processMakeDiagnosis);
				function processMakeDiagnosis (newData) {
					
					if (newData.ERROR) {
						$('#addPatientForm table').append('<tr><td>' + newData.ERROR_MSG + '</td></tr>');
					} else {
						$('#addPatientForm table').append('<tr><td>' + newData.SUCCESS_MSG + '</td></tr>');
					}

				}

			}

		}

	});





//---------------------------------------------------------------------------------------------------------
function getMyPatients () {

	//~~~~get recent patients~~~~
	var doctorID = $('#doctorID').text();
	var orderBy = 'patientID';

	var url = 'inc/get-my-patients.php';
	var data = 'doctorID=' + doctorID + "&orderBy=" + orderBy;

	$.getJSON(url, data, processPatients);//end json
	function processPatients(data) {

		if (!data.ERROR) {

			$.each(data, function (patient, patientInfo) {

				if( patient != 'ERROR' && patient != 'SUCCESS_MSG' ) {

					var tableRow = "<tr><td>" + patientInfo.patientID + "</td>";
					tableRow += "<td>" + patientInfo.firstName + "</td>"; 
					tableRow += "<td>" + patientInfo.lastName + "</td>"; 
					tableRow += "<td>" + patientInfo.sex + "</td>"; 
					tableRow += "<td> <a href='view-patient.php?patientID=" + patientInfo.patientID + "'>View</a> </td>"; 
					tableRow += "</tr>";
					$('#allPatientsTableBody').append(tableRow);

				}

			});//end each

		} else {

			$('#allPatientsTable').hide();
			$('#allPatientsErrorDiv').html(data.ERROR_MSG);

		}

	}//end fn

	//~~~~~~~~~~~~~~~~~~~~~~~~~~~

}//end of getmypatients
//--------------------------------------------------------------------------------------------------------











//---------------------------------------------------------------------------------------------------------

function getPatientDetailsAndDiagnoses() {

	var patID = $('#viewPatientPID').text();
	var url = 'inc/get-patient-details.php';
	var urlData = 'patientID=' + patID;

	$.getJSON(url, urlData, processPatient);
	function processPatient (data) {
		if (!data.ERROR) {
			$('#viewPatientName').text(data.firstName + " " + data.lastName);
			$('#viewPatientMN').text(data.mobileNo);
			$('#viewPatientCN').text(data.contactNo);

			var newURL = 'inc/get-patient-all-diagnoses.php';
			var newURLData = 'patientID=' + patID;

			$.getJSON(newURL, newURLData, getDiag);
			function getDiag (newData) {
				
				if(!newData.ERROR) {

					$.each(newData, function(diag, diagInfo) {
						if (diag != 'ERROR' && diag != 'SUCCESS_MSG') {
							$('#viewPatientALLDIAG').append("<a style='margin: 5px 15px;' class='button' href='view-diagnosis.php?diagnosisID=" + diagInfo.diagnosisID + "'>" + diagInfo.diagnosisID + " </a>");
						}
					});

				} else {
					$('#viewPatientALLDIAG').text(newData.ERROR_MSG);
				}

			}

		} else {
			$('#viewPatient table').html('<tr><td>' + data.ERROR_MSG + '</td></tr>');
		}
	}

}

//----------------------------------------------------------------------------------------------------------











});//end of doc ready