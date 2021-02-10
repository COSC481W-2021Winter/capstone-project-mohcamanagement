<?php
	/*Insert Code here*/
	include("../includes/dbConnection.php");

	// Checks the request method so that the error will only show if the request method is POST
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(!empty($_POST['Monday']))
				$monday = $_POST['Monday'];
			else
				$monday = "Off";

			if(!empty($_POST['Tuesday']))
				$tuesday = $_POST['Tuesday'];
			else
				$tuesday = "Off";

			if(!empty($_POST['Wednesday']))
				$wednesday = $_POST['Wednesday'];
			else
				$wednesday = "Off";

			if(!empty($_POST['Thursday']))
				$thursday = $_POST['Thursday'];
			else
				$thursday = "Off";

			if(!empty($_POST['Friday']))
				$friday = $_POST['Friday'];
			else
				$friday = "Off";

			if(!empty($_POST['Saturday']))
				$saturday = $_POST['Saturday'];
			else
				$saturday = "Off";

			if(!empty($_POST['Sunday']))
				$sunday = $_POST['Sunday'];
			else
				$sunday = "Off";

			// Use the saved variables to insert into the Users table
			$query = "INSERT INTO Users VALUES('$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sunday')";
			mysqli_query($conn, $query);

			// header() changes the page to the location listed
			header("Location: userMain.php");
		
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User Update Availability</title>

		<link rel="stylesheet" type="text/css" href="../style/style.css">
	</head>

	<body>
		<!-- Form to collect the info -->
		<table class="userCreationTable">
			<form method="post" action="userUpdateAvailabilty.php">
				<tr>	
					<td style="padding: 2px;">
						<input size="22px" type="text" name="Monday" placeholder="Enter Hours for Monday" class="inputBox"></input>
					</td>
				</tr>	

				<tr>
					<td style="padding: 2px;">
						<input size="22px" type="text" name="Tuesday" placeholder="Enter Hours for Tuesday" class="inputBox"></input>
					</td>
				</tr>

				<tr>
					<td style="padding: 2px;">
						<input size="22px" type="text" name="Wednesday" placeholder="Enter Hours for Wednesday" class="inputBox"></input>
					</td>
				</tr>

				<tr>
					<td style="padding: 2px;">
						<input size="22px" type="text" name="Thursday" placeholder="Enter Hours for Thursday" class="inputBox"></input>
					</td>
				</tr>

				<tr>
					<td style="padding: 2px;">
						<input size="22px" type="text" name="Friday" placeholder="Enter Hours for Friday" class="inputBox"></input>
					</td>
				</tr>

				<tr>
					<td style="padding: 2px;">
						<input size="22px" type="text" name="Saturday" placeholder="Enter Hours for Saturday" class="inputBox"></input>
					</td>
				</tr>

				<tr>
					<td style="padding: 2px;">
						<input size="22px" type="text" name="Sunday" placeholder="Enter Hours for Sunday" class="inputBox"></input>
					</td>
				</tr>
				<tr>
					<td style="text-align: center; padding: 2px;">
						<input style="background-color: #343131;  color: #969595;" type="Submit" name="Submit"></input>
					</td>
				</tr>
			</form>
		</table>
</body>
</html>