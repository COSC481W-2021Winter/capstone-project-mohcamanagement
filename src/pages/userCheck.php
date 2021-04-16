<?php 
	// makes connection to the database
	include("../includes/dbConnection.php");

	date_default_timezone_set("America/New_York");
	
	// collecting the variables passed from the post array
	$usernameEntered = $_POST["Username"];
	$pinEntered = $_POST["Pin"];

	// setting the username as a cookie for use in other pages
	setcookie("Username", $usernameEntered);

	// variables for checking if the certain parts are true or false to go to certain pages
	$valid = false;
	$userType = 0;

	// selecting all the users from the user table
	$query = "SELECT * FROM Users";
	$result = mysqli_query($conn, $query);

	// number of rows for the for loop 
	$numOfRows = mysqli_num_rows($result);

	// runs a for loop checking to see if the username entered is in the table or not
	for($i = 0; $i<$numOfRows; $i++) {
		// $row is the current row in the table
		$row = mysqli_fetch_assoc($result);

		// saving the variables from the current row of the table
		$username = $row["Username"];
		$pin = $row["Pin"];
		$isManager = $row["IsManager"];

		// if you do find the username entered in the table we set valid to true
		if($usernameEntered == $username && $pinEntered == $pin) {
			$valid = true;
			$userType = $isManager;
			break;
		}
	}

	// if the userType is 1 then they are a manager and go to the adimMain page
	if($valid == true && $userType == 1) {
		header("Location: adminMain.php");
	}
	// else if the userType is 1 then they are a manager and go to the userMain page
	else if($valid == true && $userType == 0) {
		header("Location: userMain.php");
	}
	// if neither are true then we redo the login page and show an alert message
	else {
?>
<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="../style/style2.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">
	</head>
	<body class="login">
		<?php 

		echo "<script id='failCredCheck'>alert('Credentials entered were invalid.')</script>";
		}
		 ?>

	<form style="margin-top: 5%;" method="post" action="userCheck.php">
		<div class="imgcontainer">
    		<img src="../images/avatar.png" alt="Avatar" class="avatar">
  		</div>

  		<div class="container">
    		<label for="username"><b>Username</b></label>
			<input type="text" name="Username" placeholder="Enter Username" required/>

    		<label for="pin"><b>Pin</b></label>
			<input type="text" name="Pin" placeholder="Enter Pin" required/>
        
			<Button type="Submit" name="Submit">Login</Button>
  		</div>

  		<div class="container" style="background-color:#f1f1f1">
    		<button type="button" class="cancelbtn">Cancel</button>
			<span class="psw">New <a href="companyRegister.php">company?</a></span>
  		</div>
	</form>
	<form class="back" method="post" action="../index.php">
		  <div class="container" style="background-color:#f1f1f1">
			  <Button type="Submit" name="Submit" value="Back" class="backbtn" style="background-color: #343131;  color: #969595;">Back</Button>
		  </div>
	</form>
		
	</body>
</html>