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

<html>
 <head>
	<title>User main page</title>
	<link rel="stylesheet" type="text/css" href="../style/style.css">
 </head>
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
	<header>
		<img class="logo" src="" alt="logo">
			<form method="post" action="/capstone-project-mohcamanagement/src/pages/userUpdateAvailabilty.php ">
				<button class="button NavButton" >Update Availability</NavButton>
			</form>

			<form method="post" action="/capstone-project-mohcamanagement/src/pages/userRequestOff.php">
				<button class="button NavButton" >Request Off</button>
			</form>
		</nav>

		<form method="post" action="/capstone-project-mohcamanagement/src/index.html">
			<button class="button button0">Log Out</button>
		</form>
	</header>
 <!-- <header>
		<img class="logo" src="" alt="logo">
		<nav>
			<ul class="nav_links">
				<button class="button NavButton" onclick="location.href='/capstone-project-mohcamanagement/src/pages/userUpdateAvailabilty.php' ">Update Availability</NavButton>
				<button class="button NavButton" onclick="location.href='/capstone-project-mohcamanagement/src/pages/userRequestOff.php' ">Request Off</NavButton>
			</ul>
		</nav>
		<button class="button button0" onclick="location.href='/capstone-project-mohcamanagement/src/index.html'">Log Out</button0>
	</header> -->
	<body>
		<?php 
		echo "<h1>Welcome $userCookie</h1>";
		 ?>
		<div class="square1">Schedule Placeholder</div>
		<div class="square2">Suggested Inventory / Writeoffs Placeholder</div>
		<!-- <div class="centerHorz">
			<button class="button button1">Inventory Suggestions</button>
			<button class="button button1" onclick="location.href='/capstone-project-mohcamanagement/client/pages/userUpdateAvailabilty.php'"> Update Availability</button>
			<button class="button button1" onclick="location.href='/capstone-project-mohcamanagement/client/pages/userRequestOff.php'">Request Off</button>
			<button class="button button1" onclick="location.href='/capstone-project-mohcamanagement/client/index.html'">Log Out</button>
		</div> -->
	</body>
</html>
