<?php

	//start session
	if (!session_id()) {
		session_start();
	}

	if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName']) || !isset($_SESSION['email'])) {
        header('location: sign-in.php');
    }

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Mitra Beta Version</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!--css-->
    <link rel="stylesheet" type="text/css" href="css/custom.css" />

    <!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>

    <!--scripts-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>
<body>

<?php

    //store the session variables in html span contents so that they can be accessed by javascript
    //these span elements will be hidden or display:none'd ....

    echo "<span class='hideIt' id='doctorID'>".$_SESSION['doctorID']."</span>";
    echo "<span class='hideIt' id='firstName'>".$_SESSION['firstName']."</span>";
    echo "<span class='hideIt' id='lastName'>".$_SESSION['lastName']."</span>";
    echo "<span class='hideIt' id='email'>".$_SESSION['email']."</span>";
    echo "<span class='hideIt' id='mobileNo'>".$_SESSION['mobileNo']."</span>";
    echo "<span class='hideIt' id='contactNo'>".$_SESSION['contactNo']."</span>";
    echo "<span class='hideIt' id='level'>".$_SESSION['level']."</span>";
    echo "<span class='hideIt' id='sex'>".$_SESSION['sex']."</span>";
    echo "<span class='hideIt' id='address'>".$_SESSION['address']."</span>";
    echo "<span class='hideIt' id='specialization'>".$_SESSION['specialization']."</span>";
    echo "<span class='hideIt' id='hospitalID'>".$_SESSION['hospitalID']."</span>";

?>

    <div id="header">
    	<a href="index.php"><img src="support/mitra-logo.jpg" id="logo"></a>
    	<h4 id="welcome">Welcome, <b>Dr. <?php echo $_SESSION['firstName']." ".$_SESSION['lastName']; ?></b></h4>
    	<form id="searchForm" action="search.php" method="get">
    		<input type="text" name="searchKey" id="searchKey" size="20" maxlength="20" placeholder="Search">
    		<input type="submit" value="&#128269;" class="button"> 
    	</form>
    	<a href="sign-out.php" class="anchorButton" id="signOut">Sign Out</a>
    </div>

    <div id="navAndMain">
    	<div id="nav">
    		<h3>Navigation</h3>
    		<a href="index.php">&#127968; Home</a>
    		<a href="diagnoses.php">&#10010; Diagnoses</a>
    		<a href="patients.php">&#128113; Patients</a>
    		<a href="">&#128247; Images</a>
    		<a href="my-account.php">&#128187; My Account</a>
    	</div>
    	<div id="main">