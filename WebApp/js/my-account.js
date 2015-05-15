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

	//set form values----
	$('#firstNameMA').val(firstName);
	$('#lastNameMA').val(lastName);
	$('#mobileNoMA').val(mobileNo);
	$('#contactNoMA').val(contactNo);
	$('#addressMA').val(address);
	$('#specializationMA').val(specialization);
	//-------------------

	$('#myAccountForm').submit( function(e) {
		e.preventDefault();

		var url = 'inc/update-doctor.php';
		var urlData = $('#myAccountForm').serialize() + '&doctorID=' + doctorID;

		$.getJSON(url, urlData, processSaveChanges);
		function processSaveChanges (data) {
			if (data.ERROR) {
				$('#myAccountFormError').text(data.ERROR_MSG);
			} else {
				$('#myAccountFormError').text(data.SUCCESS_MSG);
				$('#myAccountForm table').html("<a href='my-account.php'>Reload Page</a>");
			}
		}


	});


	$('#changePasswordForm').submit( function(e) {

		e.preventDefault();

		var pass = $('#passwordMA').val();
		var confPass = $('#confirmedPasswordMA').val();

		if(pass != confPass) {
			$('#changePasswordFormError').text('Passwords Do Not Match');
			return;
		}

		var url = 'inc/update-doctor-password.php';
		var urlData = 'doctorID=' + doctorID + '&password=' + pass;

		$.post(url, urlData, processChangePassword);
		function processChangePassword (data) {

			if(data.ERROR) {
				$('#changePasswordFormError').text(data.ERROR_MSG);
			} else {
				$('#changePasswordFormError').text(data.SUCCESS_MSG);
				$('#changePasswordForm table').html("<a href='my-account.php'>Reload Page</a>");
			}
		}

	});


});//end of doc ready