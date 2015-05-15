<!DOCTYPE html>
<html>
<head>
	<title>Mitra Sign In(Beta)</title>

	<!--css-->
	<link rel="stylesheet" type="text/css" href="css/custom.css">

	<!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>

    <!--scripts-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!--custom style for sign-in page-->
	<style type="text/css">

body {
	background-color: #C30000;
	font-family: 'Arvo', serif;
}

form {
	width: 200px;
	position: relative;
	margin: 20px auto;
	padding: 20px;
	border-radius: 10px;
	box-shadow: 3px 3px 3px #000;
	background-color: #fff;
}

form h5 {
	position: absolute;
	top: 10px;
	right: 10px;
}

form img {
	margin: 20px 0;
}

	</style>
</head>
<body>

	<form id="registerForm">
		<img src="support/mitra-logo.jpg">
		<table>
			<tr>
				<td><input type="text" name="firstName" id="firstName" placeholder="First Name"> </td>
			</tr>
			<tr>
				<td><input type="text" name="lastName" id="lastName" placeholder="Last Name"></td>
			</tr
			<tr>
				<td><input type="password" name="password" id="password" placeholder="Password"></td>
			</tr>
			<tr>
				<td><input type="text" name="email" id="email" placeholder="Email ID"></td>
			</tr>
			<tr>
				<td><input type="text" name="mobileNo" id="mobileNo" placeholder="Mobile No"></td>
			</tr>
			<tr>
				<td><input type="text" name="contactNo" id="contactNo" placeholder="Contact No"></td>
			</tr>
			<tr>
				<td><input type="text" name="sex" id="sex" placeholder="sex: Type M or F"></td>
			</tr>
			<tr>
				<td><input type="text" name="address" id="address" placeholder="Address(can be left unfilled)"></td>
			</tr>
			<tr>
				<td><input type="text" name="specialization" id="specialization" placeholder="Specialization(can be left unfilled)"></td>
			</tr>
			<tr>
				<td><input type="text" name="code" id="code" placeholder="Enter CODE"></td>
			</tr>
			<tr>
				<td><input class="button" type="submit" value="Register"></td>
			</tr>
			<tr>
				<td id="formError" style="color: red;"></td>
			</tr>
		</table>
	</form>

	<script type="text/javascript">

$(document).ready(function() {

	$('#registerForm').submit(function(e) {
		e.preventDefault();

		var code = $('#code').val();
		if(code == 'betareleasecode965') {

			var urlData = $('#registerForm').serialize();
			urlData += '&level=0&hospitalID=0';

			var url = 'inc/register-doctor.php';

			$.post(url, urlData, function(data) {
				if(!data.ERROR)
					$('#registerForm table').html('<tr><td>' + data.SUCCESS_MSG + " <a href='sign-in.php'>Sign In</a></td></tr>");
				else {
					$('#formError').text(data.ERROR_MSG);
				}
			});

		} else {
			$('#formError').text('Code Does Not Match');
		}

	});

});

	</script>
</body>
</html>
