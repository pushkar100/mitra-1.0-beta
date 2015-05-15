$(document).ready(function () {

//-------------home page stuff--------------

	//get recent patients
	getMyRecentPatients();

	//get recent diagnoses
	getMyRecentDiagnoses();


//----------end of home page stuff----------

});//end of doc ready





//---------------------------------------------------------------------------------------------------------
function getMyRecentPatients () {

	//~~~~get recent patients~~~~
	var doctorID = $('#doctorID').text();
	var orderBy = 'patientID';

	var url = 'inc/get-my-patients.php';
	var data = 'doctorID=' + doctorID + "&orderBy=" + orderBy;

	$.getJSON(url, data, processRecentPatients);//end json
	function processRecentPatients(data) {

		if (!data.ERROR) {

			$.each(data, function (patient, patientInfo) {

				if( patient != 'ERROR' && patient != 'SUCCESS_MSG' ) {

					var tableRow = "<tr><td>" + patientInfo.patientID + "</td>";
					tableRow += "<td>" + patientInfo.firstName + "</td>"; 
					tableRow += "<td>" + patientInfo.lastName + "</td>"; 
					tableRow += "<td>" + patientInfo.sex + "</td>"; 
					tableRow += "<td> <a href='view-patient.php?patientID=" + patientInfo.patientID + "'>View</a> </td>"; 
					tableRow += "</tr>";
					$('#recentPatientsTableBody').append(tableRow);

				}

			});//end each

		} else {

			$('#recentPatientsTable').hide();
			$('#recentPatientsErrorDiv').html(data.ERROR_MSG);

		}

	}//end fn

	//~~~~~~~~~~~~~~~~~~~~~~~~~~~

}//end of getmyrecentpatients
//--------------------------------------------------------------------------------------------------------













//---------------------------------------------------------------------------------------------------------
function getMyRecentDiagnoses () {

	//~~~~get recent Diagnoses~~~~
	var doctorID = $('#doctorID').text();
	var orderBy = 'diagnosisID';

	var url = 'inc/get-my-diagnoses.php';
	var data = 'doctorID=' + doctorID + "&orderBy=" + orderBy;

	$.getJSON(url, data, processRecentDiagnoses);//end json
	function processRecentDiagnoses(data) {

		if (!data.ERROR) {

			$.each(data, function (diagnosis, diagnosisInfo) {

				if( diagnosis != 'ERROR' && diagnosis != 'SUCCESS_MSG' ) {

					var tableRow = "<tr><td>" + diagnosisInfo.diagnosisID + "</td>";

					if (!diagnosisInfo.symptoms) {
						tableRow += "<td>Edit &#9998;</td>"; 
					} else {
						tableRow += "<td>" + diagnosisInfo.symptoms.substr(0, 10) + "..</td>"; 
					}
					if (!diagnosisInfo.diagnosis) {
						tableRow += "<td>Edit &#9998;</td>"; 
					} else {
						tableRow += "<td>" + diagnosisInfo.diagnosis.substr(0, 10) + "..</td>"; 
					}
					tableRow += "<td> <a href='view-diagnosis.php?diagnosisID=" + diagnosisInfo.diagnosisID + "'>View</a> </td>"; 
					//$('#recentDiagnosesTableBody').append(tableRow);

					var newURL = 'inc/get-patient-details.php';
					var newURLData = 'patientID=' + diagnosisInfo.patientID;

					$.getJSON(newURL, newURLData, processPatientDetails);
					function processPatientDetails (newData) {
						tableRow += "<td>" + newData.firstName + " " + newData.lastName + "</td></tr>";
						$('#recentDiagnosesTableBody').append(tableRow);
					}

				}

			});//end each

		} else {

			$('#recentDiagnosesTable').hide();
			$('#recentDiagnosesErrorDiv').html(data.ERROR_MSG);

		}

	}//end fn

	//~~~~~~~~~~~~~~~~~~~~~~~~~~~

}//end of getmyrecentDiagnoses
//--------------------------------------------------------------------------------------------------------


