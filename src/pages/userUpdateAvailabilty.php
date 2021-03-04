<?php
	$username=$_COOKIE['Username'];
	include("../includes/dbConnection.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$query = "SELECT * from Users where Username='$username'";
		$result = mysqli_query($conn, $query);

		$currMon= '';
		$currTue= '';
		$currWed= '';
		$currThur= '';
		$currFri= '';
		$currSat= ''; 
		$currSun = '';

		$row = mysqli_fetch_assoc($result);
			$currMon = $row['Monday'];
			$currTue = $row['Tuesday'];
			$currWed = $row['Wednesday'];
			$currThur = $row['Thursday'];
			$currFri = $row['Friday'];
			$currSat = $row['Saturday'];
			$currSun = $row['Sunday'];

			
		if(!empty($_POST['monday']))
			$monday = $_POST['monday'];
		else
			$monday = $currMon;

		if(!empty($_POST['tuesday']))
			$tuesday = $_POST['tuesday'];
		else
			$tuesday = $currTue;

		if(!empty($_POST['wednesday']))
			$wednesday = $_POST['wednesday'];
		else
			$wednesday = $currWed;
		
		if(!empty($_POST['thursday']))
			$thursday = $_POST['thursday'];
		else
			$thursday = $currThur;

		if(!empty($_POST['friday']))
			$friday = $_POST['friday'];
		else
			$friday = $currFri;

		if(!empty($_POST['saturday']))
			$saturday = $_POST['saturday'];
		else
			$saturday = $currSat;

		if(!empty($_POST['sunday']))
			$sunday = $_POST['sunday'];
		else
			$sunday = $currSun;

		$query = "UPDATE Users SET Monday='$monday', Tuesday='$tuesday', Wednesday='$wednesday', Thursday='$thursday', Friday='$friday', Saturday='$saturday', Sunday='$sunday' WHERE Username='$username'";
		mysqli_query($conn, $query);

		// echo '<script type="text/javascript"> alert("Schedule Updated") </script>';
		// // header() changes the page to the location listed
		// header("Location: userMain.php");
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User Update Availability</title>
		<link rel="stylesheet" type="text/css" href="../style/style.css">

		<style>
			h1{
				padding: 20px 0px;
			}
			input{
				width: 40%;
				height: 5%;
				border: 4px;
				border-radius: 5px;
				padding: 10px 15px;
				margin: 10px;
				box-shadow: 1px 1px 1px 1px grey;
			}
			label{
				font-size: 25px;
			}
			.container{
				width: 500px;
				clear: both;
				align-items:center;
			}
			.container input{
				width: 100%;
				clear: both;
			}
			/*
				This is all the code for the update and cancel buttons
			*/
			a.buttons{
				height: 5%;
				width: 100%;
				border: 4px;
				border-radius: 5px;
				padding: 6px 40% 10px 40%;
				margin: 10px;
				box-shadow: 1px 1px 1px 1px grey;
				background-color: #efefef;
				font-size: 18px;
				text-align: center;
				clear: both;
				text-decoration:none;
				display:inline-block;
			}
			a:visited {
				color:#000000;
			}
			a:hover {
				color: gray;
			}
			
			/*
				This is all the code for the select box styling
			*/
			.select{
				margin: 10px;
			}
			#select{
				width:300px;
				font-size: 15px;
				height:50px;
				text-align-last:center;
			}
			#select option{
			  width:250px;
			  height:100px;   
			}
			
			/*
				This is all the code for the pop ups. Yes it's a lot for a simple pop up...
			*/
			/* Popup container - can be anything you want */
				.popup {
				  position: relative;
				  cursor: pointer;
				  -webkit-user-select: none;
				  -moz-user-select: none;
				  -ms-user-select: none;
				  user-select: none;
				  
				height: 5%;
				width: 100%;
				border: 4px;
				border-radius: 5px;
				padding: 6px 40% 10px 40%;
				margin: 10px;
				box-shadow: 1px 1px 1px 1px grey;
				background-color: #efefef;
				font-size: 18px;
				text-align: center;
				clear: both;
				text-decoration:none;
				display:inline-block;
				}

				/* The actual popup */
				.popup .popuptext {
				  visibility: hidden;
				  width: 160px;
				  background-color: #555;
				  color: #fff;
				  text-align: center;
				  border-radius: 6px;
				  padding: 8px 0;
				  position: absolute;
				  z-index: 1;
				  bottom: 125%;
				  left: 50%;
				  margin-left: -80px;
				}

				/* Popup arrow */
				.popup .popuptext::after {
				  content: "";
				  position: absolute;
				  top: 100%;
				  left: 50%;
				  margin-left: -5px;
				  border-width: 5px;
				  border-style: solid;
				  border-color: #555 transparent transparent transparent;
				}

				/* Toggle this class - hide and show the popup */
				.popup .show {
				  visibility: visible;
				  -webkit-animation: fadeIn 1s;
				  animation: fadeIn 1s;
				}

				/* Add animation (fade in the popup) */
				@-webkit-keyframes fadeIn {
				  from {opacity: 0;} 
				  to {opacity: 1;}
				}

				@keyframes fadeIn {
				  from {opacity: 0;}
				  to {opacity:1 ;}
				}
				popup:hover {
				color: gray;
			}
			.popup:hover{
				color: gray;
			}
		</style>
	</head>
	<script>
	//This is the JavaScript code for the pop up on the update button.
		// When the user clicks on div, open the popup
		function myFunction() {
		  var popup = document.getElementById("myPopup");
		  popup.classList.toggle("show");
		  if(popup.classList.contains("show")) // Check if the popup is shown
		  setTimeout(() => popup.classList.remove("show"), 2000) // If yes hide it after 10000 milliseconds
		}
		</script>
	<body>
		<center>
		<div class="container">
			<h1>Update Your Weekly Work Schedule</h1>
				<form action="userUpdateAvailabilty.php" method="POST" >
					<label for="monday">Monday</label>
						<div class="select">
						  <select name = "select" id="select">
							<option selected disabled>Select your Schedule</option>
							<option value="Option 1">Morning: 8:00am - 2:00pm</option>
							<option value="Option 2">Mid-Shift: 12:00pm - 6:00pm</option>
							<option value="Option 3">Closing Shift: 4:00pm - 10:00pm</option>
						  </select>
						</div>
						<br/>
					<label for="tuesday">Tuesday</label>
						<div class="select">
						  <select name = "select" id="select">
							<option selected disabled>Select your Schedule</option>
							<option value="Option 1">Morning: 8:00am - 2:00pm</option>
							<option value="Option 2">Mid-Shift: 12:00pm - 6:00pm</option>
							<option value="Option 3">Closing Shift: 4:00pm - 10:00pm</option>
						  </select>
						</div>
						<br/>
					<label for="wednesday">Wednesday</label>
						<div class="select">
						  <select name = "select" id="select">
							<option selected disabled>Select your Schedule</option>
							<option value="Option 1">Morning: 8:00am - 2:00pm</option>
							<option value="Option 2">Mid-Shift: 12:00pm - 6:00pm</option>
							<option value="Option 3">Closing Shift: 4:00pm - 10:00pm</option>
						  </select>
						</div>
						<br/>
					<label for="thursday">Thursday</label>
						<div class="select">
						  <select name = "select" id="select">
							<option selected disabled>Select your Schedule</option>
							<option value="Option 1">Morning: 8:00am - 2:00pm</option>
							<option value="Option 2">Mid-Shift: 12:00pm - 6:00pm</option>
							<option value="Option 3">Closing Shift: 4:00pm - 10:00pm</option>
						  </select>
						</div>
						<br/>
					<label for="friday">Friday  </label>
						<div class="select">
						  <select name = "select" id="select">
							<option selected disabled>Select your Schedule</option>
							<option value="Option 1">Morning: 8:00am - 2:00pm</option>
							<option value="Option 2">Mid-Shift: 12:00pm - 6:00pm</option>
							<option value="Option 3">Closing Shift: 4:00pm - 10:00pm</option>
						  </select>
						</div>
						<br/>
					<label for="saturday">Saturday</label>
						<div class="select">
						  <select name = "select" id="select">
							<option selected disabled>Select your Schedule</option>
							<option value="Option 1">Morning: 8:00am - 2:00pm</option>
							<option value="Option 2">Mid-Shift: 12:00pm - 6:00pm</option>
							<option value="Option 3">Closing Shift: 4:00pm - 10:00pm</option>
						  </select>
						</div>
						<br/>
					<label for="sunday">Sunday</label>
						<div class="select">
						  <select name = "select" id="select">
							<option selected disabled>Select your Schedule</option>
							<option value="Option 1">Morning: 8:00am - 2:00pm</option>
							<option value="Option 2">Mid-Shift: 12:00pm - 6:00pm</option>
							<option value="Option 3">Closing Shift: 4:00pm - 10:00pm</option>
						  </select>
						</div>
						<br/>
				</div>
			<div class="container">
					<div class="popup" onclick="myFunction()">UPDATE
						<span class="popuptext" id="myPopup">Updates sent to Manager!</span>
					</div>
					<a class="buttons" href="/capstone-project-mohcamanagement/src/pages/userMain.php">CANCEL</a>
				</form> 
			</div>
		</center>
	</body>
</html>
