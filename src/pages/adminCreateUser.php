<?php
	/*Insert Code here*/
	include("../includes/dbConnection.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["Create"])){


		if(!empty($_POST["Username"]) && !empty($_POST['Pin'])){
			// if POST array has the variables in it then we save the variables 
			$username = $_POST['Username'];
			$pin = $_POST['Pin'];

			// Two bools for checking to see if user already in table (assuming that entry is unique)
			// 1 == true, 0 == false
			$userUnique = 1;
			$pinUnique = 1;

			// Run a query to check the table and see if the entry is already in the table
			$query = "SELECT * FROM Users";
			$result = mysqli_query($conn, $query);
			$numOfRows = mysqli_num_rows($result);

			for($i = 0; $i<$numOfRows; $i++) {
				$row = mysqli_fetch_assoc($result);

				// Finding that the entries are already in the table so set the bools to false
				if($row["Username"] == $username && $row["Pin"] == $pin){
					$userUnique = 0;
					$pinUnique = 0;
					break;
				}
			}
			// If entries are unique we can add them to the table
			if($userUnique == 1 && $pinUnique == 1) {
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

				if(!empty($_POST['YearsWorked']))
					$yearsWorked = $_POST['YearsWorked'];
				else
					$yearsWorked = 0;

				// Use the saved variables to insert into the Users table
				$query = "INSERT INTO Users VALUES($pin, '$username', 0, '$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sunday', $yearsWorked)";
				mysqli_query($conn, $query);

				// header() changes the page to the location listed
				header("Location: adminMain.php");
			}
			// Else print error saying that the entry is not unique
			else {
				echo "<script>alert('Error Username and Pin already in database.')</script>";
			}
		}
		else {
			echo "<script>alert('Error Username and Pin must be entered.')</script>";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>AdminCreateUser</title>
		
		<link rel="stylesheet" type="text/css" href="../style/style.css">
	</head>

	<body>
		<h2 align="center">Create User</h2>
		<hr />
		<div style="width: 40%; margin: auto;">
			<table class="userCreationTable">
				<form method="post" action="adminCreateUser.php">
					<tr>
						<td style="padding: 2px;">
							<input size="22px" type="text" name="Username" placeholder="Enter Username" class="inputBox"></input>
						</td>

						<td class="required">
							<span>*</span>
						</td>
					</tr>

					<tr>
						<td style="padding: 2px;">
							<input size="22px" type="text" name="Pin" placeholder="Enter Pin" class="inputBox"></input>
						</td>

						<td class="required">
							<span>*</span>
						</td>
					</tr>

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
						<td style="padding: 2px;">
							<input size="22px" type="text" name="YearsWorked" placeholder="Enter Years Worked" class="inputBox"></input>
						</td>
					</tr>

					<tr>
						<td style="text-align: center; padding: 2px;">
							<input style="background-color: #343131;  color: #969595;" type="Submit" name="Create" value="Create"></input>
						</td>
					</tr>	
				</form>

				<form method="post" action="adminMain.php">
					<tr>
						<td style="text-align: center; padding: 2px;">
							<input type="Submit" name="Submit" value="Back" style="background-color: #343131;  color: #969595;"></input>
						</td>
					</tr>
				</form>
			</table>	
		</div>
	</body>
</html>
