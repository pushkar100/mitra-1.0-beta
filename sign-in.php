<?php 

	//start session
	if (!session_id()) {
		session_start();
	}

	require_once('inc/functions/init.php');

	if (isset($_POST['email']) && isset($_POST['password'])) {

		$email = $_POST['email'];
		$password = sha1($_POST['password']);

		$result_arr = signInDoctor($email, $password, $connection);

		if ($result_arr['doctorID']) 
			header('location: index.php');
		else {
			unset($_POST['email']);
			unset($_POST['password']);

			header('location: sign-in.php');
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Mitra Sign In(Beta)</title>

	<!--css-->
	<link rel="stylesheet" type="text/css" href="css/custom.css">

	<!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>

    <!--custom style for sign-in page-->
	<style type="text/css">

body {
	background-color: #C30000;
	font-family: 'Arvo', serif;
}

form {
	width: 200px;
	position: relative;
	margin: 100px auto;
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

	<form action="sign-in.php" method="post">
		<h5 style="color: #c30000;">Beta Release</h5>
		<img src="support/mitra-logo.jpg">
		<input type="email" id="email" name="email" placeholder="Enter Email"><br><br>
		<input type="password" id="password" name="password" placeholder="Enter Password"><br><br>
		<input type="submit" class="button" value="Sign In"><br><br>
		<a href="register.php">Register</a><br><br>
	</form>

</body>
</html>