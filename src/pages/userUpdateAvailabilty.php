<?php
	$userCookie = $_COOKIE["Username"];
	session_start();
	include("../includes/dbConnection.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add'])) {
		$pin = $_SESSION['Pin'];

		$query = "SELECT * FROM ShiftTimes";
		$result = mysqli_query($conn, $query);
		$numOfRows = mysqli_num_rows($result);

		
		if(!empty($_POST['DaySelection']) && !empty($_POST['shift'])) {
			$daySelected = $_POST['DaySelection'];

			$query = "DELETE FROM Availability WHERE Pin = '$pin' AND Day = '$daySelected'"; 
			mysqli_query($conn, $query);

			$check = $_POST['shift'];
			$size = count($check);

			for($i = 0; $i<$size; $i++) {
				$shiftToInsert = $check[$i];
				$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
				mysqli_query($conn, $query);

				if($shiftToInsert == "Off") {
					$query = "DELETE FROM Availability WHERE Pin = '$pin' AND Day = '$daySelected'"; 
					mysqli_query($conn, $query);

					$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
					mysqli_query($conn, $query);
				}
			}
		}
		else {
			echo "<script id='failCheck'>alert('Error both selection need input.')</script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User Update Availability</title>
		<link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">
		
		<style>

			table {
				margin-left: auto;
				margin-right: auto;
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 25%;
			}

			a {
				color: #000000;
			}

			h3 {
				text-align: center;
			}

			.table1{
				margin-left: auto;
				margin-right: auto;
				font-family: arial, sans-serif;
				border-collapse: collapse;
				height: 200px;
				width: 65%;
			}

			td, th {
			  border: 1px solid #dddddd;
			  text-align: center;
			  padding: 8px;
			  width:500px;
			}

			.container {
				width: 400px;
				height: 650px;
			}

			a.buttons {
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
			/*
				This is all the code for the update and cancel buttons
			*/
			a.buttons {
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
			.select {
				margin: 10px;
			}

			#select {
				width:300px;
				font-size: 15px;
				height:100px;
				text-align-last:center;
			}

			#select option {
			  width:250px;
			  height:30px;   
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
				  from {
				  	opacity: 0;
				  } 
				  to {
				  	opacity: 1;
				  }
			}

			@keyframes fadeIn {
			 	from {
			 		opacity: 0;
			  	}
			  	to {
			  		opacity:1 ;
			  	}
			}

			popup:hover {
				color: gray;
			}

			.popup:hover {
				color: gray;
			}
		</style>
		<script>
		//This is the JavaScript code for the pop up on the update button.
		// When the user clicks on div, open the popup
			function myFunction() {
			  var popup = document.getElementById("myPopup");
			  popup.classList.toggle("show");
			  if(popup.classList.contains("show")) // Check if the popup is shown
			  setTimeout(() => popup.classList.remove("show"), 2000) // If yes hide it after 10000 milliseconds
			  //PHP code to send information to database here
			}
		</script>
	</head>

	<body>
		<br>
		<h1><u>Update Your Weekly Work Schedule</u></h1>
		<br>

		<!-- Displays the shift times which are generated from the shiftTimes table -->
		<h3>Shift Information</h3>
		<table style="margin-top: 6px; margin-bottom: 10px;">
			<tr>
				<th>Shifts</th>
				<th>In</th>
				<th>Out</th>
			</tr>
			<?php 
				$query = "SELECT * from ShiftTimes";
				$result = mysqli_query($conn, $query);
				$numOfRows = mysqli_num_rows($result);

				for($i = 0; $i<$numOfRows; $i++) {
					$row = mysqli_fetch_assoc($result);

					$shiftName = $row['ShiftName'];

					$startTime = $row['StartTime'];
					$endTime = $row['EndTime'];

					echo "<tr>";
					echo "<td>$shiftName</td>";
					echo "<td>$startTime</td>";
					echo "<td>$endTime</td>";
					echo "</tr>";

				}
			 ?>
		</table>

		<!-- Fills the correct arrays with the availability for each day. For sorting purposes. -->
		<h3>Current Availability</h3>
		<table style="margin-top: 10px; margin-bottom: 10px;">
			<tr>
				<th>Day</th>
				<th>Availability</th>
			</tr>
			<?php 
				$query = "SELECT * from Users where Username='$userCookie'";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$userPin = $row['Pin'];
				$_SESSION['Pin'] = $userPin;

				$query = "SELECT * from Availability where Pin='$userPin'";
				$result = mysqli_query($conn, $query);
				$numOfRows = mysqli_num_rows($result);
				$monArr = array();
				$tueArr = array();
				$wedArr = array();
				$thurArr = array();
				$friArr = array();
				$satArr = array();
				$sunArr = array();

				for($i = 0; $i<$numOfRows; $i++) {
					$row = mysqli_fetch_assoc($result);

					$day = $row['Day'];
					$shiftName = $row['ShiftName'];
					if($day == 'Monday'){
						array_push($monArr, $shiftName);
					}
					else if($day == 'Tuesday'){
						array_push($tueArr, $shiftName);
					}
					else if($day == 'Wednesday'){
						array_push($wedArr, $shiftName);
					}
					else if($day == 'Thursday'){
						array_push($thurArr, $shiftName);
					}
					else if($day == 'Friday'){
						array_push($friArr, $shiftName);
					}
					else if($day == 'Saturday'){
						array_push($satArr, $shiftName);
					}
					else if($day == 'Sunday'){
						array_push($sunArr, $shiftName);
					}
				}

				// Each of the days are printed in the table with the respective availability for each day. If the day array is empty then we just output off.
				echo "<tr>";
				echo "<td>Monday</td>";
				echo "<td>";
				if(count($monArr) != 0){
					for($i = 0; $i < count($monArr); $i++) {
						echo "$monArr[$i]<br>";
					}
				}
				else
					echo "Off";

				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Tuesday</td>";
				echo "<td>";
				if(count($tueArr) != 0){
					for($i = 0; $i < count($tueArr); $i++) {
						echo "$tueArr[$i]<br>";
					}
				}
				else
					echo "Off";

				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Wednesday</td>";
				echo "<td>";
				if(count($wedArr) != 0){
					for($i = 0; $i < count($wedArr); $i++) {
						echo "$wedArr[$i]<br>";
					}
				}
				else
					echo "Off";

				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Thursday</td>";
				echo "<td>";
				if(count($thurArr) != 0){
					for($i = 0; $i < count($thurArr); $i++) {
						echo "$thurArr[$i]<br>";
					}
				}
				else
					echo "Off";

				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Friday</td>";
				echo "<td>";
				if(count($friArr) != 0){
					for($i = 0; $i < count($friArr); $i++) {
						echo "$friArr[$i]<br>";
					}
				}
				else
					echo "Off";

				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Saturday</td>";
				echo "<td>";
				if(count($satArr) != 0){
					for($i = 0; $i < count($satArr); $i++) {
						echo "$satArr[$i]<br>";
					}
				}
				else
					echo "Off";

				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td>Sunday</td>";
				echo "<td>";
				if(count($sunArr) != 0){
					for($i = 0; $i < count($sunArr); $i++) {
						echo "$sunArr[$i]<br>";
					}
				}
				else
					echo "Off";

				echo "</td>";
				echo "</tr>";
			 ?>
		</table>

		<!-- Lets a User update their availability -->
		<h3>Choose your personal availability</h3>
		<form method='post' action='userUpdateAvailabilty.php'>
			<table style="margin-top: 10px; padding: 2px;">
				<tr>
					<th>Select Day</th>
					<th>Select Shifts</th>
				</tr>

				<tr>
					<td>
						<select name="DaySelection">
							<option selected disabled>Day Selection</option>
							<option value="Monday">Monday</option>
							<option value="Tuesday">Tuesday</option>
							<option value="Wednesday">Wednesday</option>
							<option value="Thursday">Thursday</option>
							<option value="Friday">Friday</option>
							<option value="Saturday">Saturday</option>
							<option value="Sunday">Sunday</option>
						</select>
					</td>

					<td>
					<?php
						$query = "SELECT * FROM ShiftTimes";
						$result = mysqli_query($conn, $query);
						$numOfRows = mysqli_num_rows($result);

						for($i = 1; $i<$numOfRows+1; $i++) {
							$row = mysqli_fetch_assoc($result);
							$shiftName = $row['ShiftName'];
							echo "<input type='checkbox' id='shift$i' name='shift[]' value='$shiftName'>$shiftName<br></input>";
							// can have a tag that lets the box be checked or unchecked
						}
					?>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						<input type="Submit" name="Add" value="Add to Availability"></input>
					</td>
				</tr>
			</form>	

			<form method="post" action="userMain.php">
				<tr>
					<td>
						<input type="Submit" name="Back" value="Back"></input>
					</td>
				</tr>
			</form>
		</table>

	</body>
</html>
