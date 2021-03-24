<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');
	// $conn is the conection to database

	// checking to see if the cookie array is empty
	if(isset($_COOKIE["Username"])) {
		// if not empty then we store the cookie into a variable
		$userCookie = $_COOKIE["Username"];
	}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
	<title>User main page</title>
	<link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">
 </head>

 	<!-- CSS might want to add this to the style sheet -->
	<style>
	h1{text-align: center;}
	
	.centerHorz {
		display: flex;
		justify-content: center;
	}
	
	.vertical-center {
		margin: 0;
		position: absolute;
		top: 50%;
		-ms-transform: translateY(-50%);
		transform: translateY(-50%);
	}

	.square1 {
		text-align:center;
		margin-left: auto;
		margin-right: auto;
		height: 500px;
		width: 750px;
		background-color: #555;
		border: 3px solid black;
	}
	.square2 {
		text-align:center;
		margin-left: auto;
		margin-right: auto;
		height: 50px;
		width: 300px;
		background-color: #555;
		margin-top: 10px;
		border: 3px solid black;
	}
	.button {
		border: none;
		color: white;
		padding: 16px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 17px;
		margin: 10px 5px;
		transition-duration: 0.4s;
		cursor: pointer;
	}
	.button1 {
		background-color: white; 
		color: black; 
		border: 2px solid #800000;
	}
	.button2  {
		background-color: white; 
		color: black; 
		border: 2px solid #800000;
		position: absolute;
		left: 250px;
		top: 100px
	}
	.button1:hover {
		background-color: #671D00;
		color: black;
	}
	</style>

	<!-- Navbar -->
	<header>
		<img class="logo" src="../../resources/OverseerTransparent.png" style="width: 10%;" alt="logo">
			<form method="post" action="/capstone-project-mohcamanagement/src/pages/userUpdateAvailabilty.php">
				<button class="button NavButton" >Update Availability</button>
			</form>

			<form method="post" action="/capstone-project-mohcamanagement/src/pages/userRequestOff.php">
				<button class="button NavButton" >Request Off</button>
			</form>

			<form method="post" action="/capstone-project-mohcamanagement/src/index.html">
				<button class="button button0">Log Out</button>
			</form>
	</header>

	<body>
		<?php 
		echo "<h1>Welcome $userCookie</h1>";
		 ?>
		<div class="square1">Schedule Placeholder</div>
		<div class="square2">Suggested Inventory / Writeoffs Placeholder</div>
	</body>
</html>
