<?php 
	$usernameEntered = $_POST["Username"];
	$pinEntered = $_POST["Pin"];
	setcookie("Username", $usernameEntered);
	$valid = false;
	$userType = 0;

	include("../includes/dbConnection.php");

	$query = "SELECT * FROM Users";
	$result = mysqli_query($conn, $query);
	$numOfRows = mysqli_num_rows($result);

	for($i = 0; $i<$numOfRows; $i++) {
		$row = mysqli_fetch_assoc($result);

		$username = $row["Username"];
		$pin = $row["Pin"];
		$isManager = $row["isManager"];

		if($usernameEntered == $username && $pinEntered == $pin) {
			$valid = true;
			$userType = $isManager;
			break;
		}
	}

	if($valid == true && $userType == 1) {
		header("Location: adminMain.php");
	}
	else if($valid == true && $userType == 0) {
		header("Location: userMain.php");
	}
	else {
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Login Page</title>

		<link rel="stylesheet" type="text/css" href="../style/style.css">
	</head>
	<body>
		<?php 

		echo "<script>alert('Credentials entered were invalid.')</script>";
		}
		 ?>
		<table class="userCreationTable">
			<form method="post" action="userCheck.php">
				<tr>
					<td style="padding: 2px;">
						<input type="text" name="Username" placeholder="Enter Username" class="inputBox"></input>
					</td>

					<td class="required">
						<span>*</span>
					</td>
				</tr>

				<tr>
					<td style="padding: 2px;">
						<input type="text" name="Pin" placeholder="Enter Pin" class="inputBox"></input>
					</td>

					<td class="required">
						<span>*</span>
					</td>
				</tr>

				<tr>
					<td style="text-align: center; padding: 2px;">
						<input type="Submit" name="Submit" style="background-color: #343131;  color: #969595;"></input>
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