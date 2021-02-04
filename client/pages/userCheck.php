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
	</head>
	<body>
		<?php 

		echo "<script>alert('Credentials entered were invalid.')</script>";
		}
		 ?>
		<form method="post" action="userCheck.php">
			<input type="text" name="Username" placeholder="Enter Username"></input>
			<input type="text" name="Pin" placeholder="Enter Pin"></input>
			<input type="Submit" name="Submit"></input>
		</form>
		<form method="post" action="../index.html">
			<input type="Submit" name="Submit" value="Back"></input>
		</form>
	</body>
</html>