$(document).ready( function () {

	var searchItem = $('#searchItemDiv p').text();

	var patSearchUrl = 'inc/search-patients.php';
	var patSearchUrlData = 'patientKey=' + searchItem;

	$.getJSON(patSearchUrl, patSearchUrlData, patSearchCB);
	function patSearchCB (data) {
		if(!data.ERROR) {

			$.each(data, function(match, matchInfo) {
				if(match != 'ERROR' && match != 'SUCCESS_MSG')
					$('#matchingPatientsDiv').append("<p style='padding: 5px 10px;margin: 20px 5px;'><a class='button' href='view-patient.php?patientID=" + matchInfo.patientID + "'>" + matchInfo.firstName + "</a></p>");
			});
		}
		else {
			$('#matchingPatientsDiv').append('<p>' + data.ERROR_MSG + '</p>')
		}
	}


	var diagSearchUrl = 'inc/search-diagnosis.php';
	var diagSearchUrlData = 'diagnosisKey=' + searchItem;

	$.getJSON(diagSearchUrl, diagSearchUrlData, diagSearchCB);
	function diagSearchCB (diagData) {
		if(!diagData.ERROR) {

			$.each(diagData, function(match, matchInfo) {
				if(match != 'ERROR' && match != 'SUCCESS_MSG')
					$('#matchingDiagnosesDiv').append("<p style='padding: 5px 10px;margin: 20px 5px;'><a class='button' href='view-diagnosis.php?diagnosisID=" + matchInfo.diagnosisID + "'>" + matchInfo.diagnosisID + "</a></p>");
			});
		}
		else {
			$('#matchingPatientsDiv').append('<p>' + data.ERROR_MSG + '</p>')
		}
	}



});