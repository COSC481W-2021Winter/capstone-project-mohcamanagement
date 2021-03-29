<?php
	/*Insert Code here*/
	include("../includes/dbConnection.php");
	
	/*These are the entries from the last page so we can access them later.*/
	// $companyName = $_COOKIE['companyName'];
	// $companyType = $_COOKIE['companyType'];
	// $email = $_COOKIE['email'];
	// $irsNum = $_COOKIE['irsNum'];
	// $phoneNo = $_COOKIE['phoneNo'];
	// $address = $_COOKIE['address'];
	// $city = $_COOKIE['city'];
	// $state = $_COOKIE['state'];
	// $zipCode = $_COOKIE['zipCode'];

	// Checks the request method so that the error will only show if the request method is POST
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["Create"])){
		// checking to see if the username info was passed to the page from the form
		if(!empty($_POST["Username"]) && !empty($_POST['Pin'])){
			// if POST array has the variables in it then we save the variables
			$username = $_POST['Username'];
			$pin = $_POST['Pin'];
			setcookie("Username", $username);

			// regex that checks to see if the username is a string and the pin is number
			if(preg_match("/^[A-Z]{2}[a-z]+$/", $username) == 0 && preg_match("/^[0-9]{4}$/",$pin) == 0) {
				echo "<script>alert('Error Username must be only letters following format \"AAb+\" where A is a capitol letter and b is one or more lowercase letters. Pin must follow format \"xxxx\"')</script>";
			}

			elseif(preg_match("/^[A-Z]{2}[a-z]+$/", $username) == 0) {
				echo "<script>alert('Error Username must be only letters following format \"AAb+\" where A is a capitol letter and b is one or more lowercase letters.')</script>";
			}

			elseif(preg_match("/^[0-9]{4}$/",$pin) == 0) {
				echo "<script>alert('Error pin must follow format \"xxxx\"')</script>";
			}

			else {
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
					if(preg_match("/^[0-9]{2}$/", $yearsWorked) == 0) {
						echo "<script>alert('Error years worked need to be a number.</script>";
					}
				else
					$yearsWorked = 0;

				// Use the saved variables to insert into the Users table
				$query = "INSERT INTO Users VALUES($pin, '$username', 1, '$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sunday', $yearsWorked)";
				mysqli_query($conn, $query);

				// header() changes the page to the location listed
				header("Location: adminMain.php");
			}
		}
		else{
			echo "<script id='requireEntries'>alert('Error Username and Pin must be entered.')</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Creation Page</title>

		<link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">
	</head>

	<body>
		<!-- Form to collect the info -->
		<table class="userCreationTable">
			<form method="post" action="adminCreation.php">
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

			<form method="post" action="../index.html">
				<tr>
					<td style="text-align: center; padding: 2px;">
						<input type="Submit" name="Submit" value="Back" style="background-color: #343131;  color: #969595;"></input>
					</td>
				</tr>
			</form>
		</table>
</body>
</html>