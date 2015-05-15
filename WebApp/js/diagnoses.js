$(document).ready(function () {

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


	//get all diagnoses
	getMyDiagnoses ();

	//display patients in select option of add diagnosis
	selectOptionMyPatients ();

	//display this while viewing/editing a diagnosis
	getDiagnosisDetails ();

	//display diagnosis images
	getDiagnosisImages();

	//delete diagnosis
	$('#deleteDiag').click(function () { 

		var diagnosisID = $('#diagnosisID').val();

		var url = 'inc/delete-diagnosis.php';
		var urlData = 'diagnosisID=' + diagnosisID;

		$.getJSON(url, urlData, delDiagCB);
		function delDiagCB (data) {

			if (!data.ERROR) {
				$('#diagnosisDiv').html("<h4 class='heading'>Diagnosis Deleted</h4><tr><td>" + data.SUCCESS_MSG + " <a href='diagnoses.php'>Back To Diagnoses</a></td></tr>")
			}
			else {
				$('#viewDiagnosis table').html("<tr><td>" + data.ERROR_MSG + " <a href='view-diagnosis.php?diagnosisID=" + diagID + "'>View Diagnosis</a></td></tr>")
			}
		}

	});

	//toggle show the big image
	$('#fullImage').click(function () {
		$('#fullImage').fadeOut(100);
	});


	//upload diagnosis image
	$('#addImageToDiagnosis').submit( function(e) {
		

		//disable the default form submission
		  e.preventDefault();
		 
		  //grab all form data  
		  var formData = new FormData($(this)[0]);
		 
		  $.ajax({
		    url: 'inc/upload-diagnosis-image.php',
		    type: 'POST',
		    data: formData,
		    async: false,
		    cache: false,
		    contentType: false,
		    processData: false,
		    success: function (returndata) {
		    	if(returndata.ERROR)
		      		$('#message').text(returndata.ERROR_MSG);
		      	else {
		      		$('#message').text(returndata.SUCCESS_MSG);

		      		var newURL = 'inc/generate-thumbnail.php';
		      		var newURLData = 'imageID=' + returndata.imageID + '&image=' + returndata.image;

		      		$.getJSON(newURL, newURLData, thumbCB);
		      		function thumbCB (newData) {
		      			if (newData.ERROR) {
		      				$('#thumbMessage').text(newData.ERROR_MSG);
		      			} else {
		      				$('#thumbMessage').text(newData.SUCCESS_MSG);
		      				getDiagnosisImages();
		      			}
		      		}

		      	}
		    }
		  });
	 
	  return false;

	});

	$('#addDiagnosisForm').submit(function(e) {
		e.preventDefault();

		var selected = $('#patientSelect :selected').val();
		selected = selected.split(" ");
		var patientID = selected[0];

		var url = 'inc/create-diagnosis.php';
		var urlData = $('#addDiagnosisForm').serialize() + '&doctorID=' + doctorID + '&patientID=' + patientID;

		$.getJSON(url, urlData, callbackFN);
		function callbackFN (data) {
			
			if (data.ERROR) {
				$('#addDiagnosisFormError').text(data.ERROR_MSG);
			} else {
				$('#addDiagnosisFormError').text(data.SUCCESS_MSG);
				$('#addDiagnosisForm table').html("<tr><td><a href='diagnoses.php'>Reload Page</a></td></tr>");
			}
		}

	});



//---------------------------------------------------------------------------------------------------------
function selectOptionMyPatients () {

	url = 'inc/get-my-patients.php';
	urlData = 'doctorID=' + doctorID + '&orderBy=patientID';

	$.getJSON(url, urlData, processPatients);
	function processPatients (data) {

		if(!data.ERROR) {
			$.each(data, function(patient, patientInfo) {
				if(patient != 'ERROR' && patient != 'SUCCESS_MSG')
					$('#patientSelect').append('<option>' + '<span>' + patientInfo.patientID + '</span> ' + patientInfo.firstName + '</option>');
			});
		}

	}

}
//---------------------------------------------------------------------------------------------------------













//---------------------------------------------------------------------------------------------------------
function getMyDiagnoses () {

	//~~~~get all Diagnoses~~~~
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

					var newURL = 'inc/get-patient-details.php';
					var newURLData = 'patientID=' + diagnosisInfo.patientID;

					$.getJSON(newURL, newURLData, processPatientDetails);
					function processPatientDetails (newData) {
						tableRow += "<td>" + newData.firstName + " " + newData.lastName + "</td></tr>";
						$('#allDiagnosesTableBody').append(tableRow);
					}

				}

			});//end each

		} else {

			$('#allDiagnosesTable').hide();
			$('#allDiagnosesErrorDiv').html(data.ERROR_MSG);

		}

	}//end fn

	//~~~~~~~~~~~~~~~~~~~~~~~~~~~

}//end of getDiagnoses
//--------------------------------------------------------------------------------------------------------


});





//---------------------------------------------------
function getDiagnosisDetails () {

	var url = 'inc/get-diagnosis-details.php';
	var diagID = $('#displayDiagnosisID').text();
	var urlData = 'diagnosisID=' + diagID;

	$.getJSON(url, urlData, callbackFN);
	function callbackFN (data) {

		if(!data.ERROR) {
			$('#displayPatientID').text(data.patientID);
			$('#displaySymptoms').text(data.symptoms);
			$('#displayDiagnosis').text(data.diagnosis);

			$('#symptomsEdit').val(data.symptoms);
			$('#diagnosisEdit').val(data.diagnosis);

			var newURL = 'inc/get-patient-details.php';
			var newURLData = 'patientID=' + data.patientID;
			$.getJSON(newURL, newURLData, processPatient);
			function processPatient (newData) {
			  	if(!newData.ERROR) 
			  		$('#displayPatientName').text(newData.firstName);
			  	else
			  		$('#displayPatientName').text(data.ERROR_MSG);
			}
		}

	}

	$('#editDiagnosisForm').submit(function (e) {
		e.preventDefault();

		var symp = $('#symptomsEdit').val();
		var diag = $('#diagnosisEdit').val();

		var url = 'inc/update-diagnosis.php';
		var urlData = 'diagnosisID=' + diagID + '&symptoms=' +  symp + '&diagnosis=' + diag;

		$.getJSON(url, urlData, callbackFN);
		function callbackFN (data) {
			if (data.ERROR) {
				$('#diagnosisDiv').html('<p>' + data.ERROR_MSG + '</p>');
			} else {
				$('#diagnosisDiv').html('<p>' + data.SUCCESS_MSG + '</p>' + "<p><a href='view-diagnosis.php?diagnosisID=" + diagID + "'>View Diagnosis</a></p>");
			}
		}

	});

}
//------------------------------------------------------









//----------------------------------------------------------


function getDiagnosisImages() {

	$('#slider').text('');

	var url = 'inc/get-diagnosis-images.php';
	var diagID = $('#displayDiagnosisID').text();
	var urlData = 'diagnosisID=' + diagID;
	
	$.getJSON(url, urlData, imageCB);
	function imageCB(data) {
		if(data.ERROR) {
			$('#slider').text(data.ERROR_MSG);
		} else {

			$.each(data, function(image, imageInfo) {
				if(image != 'ERROR' && image != 'SUCCESS_MSG') {
					var split = imageInfo.image.split("/");
					var basename = split[split.length - 1];
					$('#slider').append("<img onclick=\"showImage(\'" + basename + "\');\" style='max-width: 100px;cursor: pointer;margin: 5px 10px; border: 2px solid #fff; box-shadow: 2px 2px 2px #000;' src='inc/thumbnails/" + basename + "'/>");
				}
			});
		}
	}

}

//----------------------------------------------------------









//----------------------------------------------------------
function showImage(image) {

	$('#fullImage').fadeIn(100);
	$('#fullImage').attr('src', 'inc/images/' + image);

}
//----------------------------------------------------------










