<?php
	/*Insert Code here*/
	include("../includes/dbConnection.php");

	// checking to see if the username info was passed to the page from the form
	if(!empty($_POST["Username"]) && !empty($_POST['Pin'])){
		// if POST array has the variables in it then we save the variables 
		$username = $_POST['Username'];
		$pin = $_POST['Pin'];
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
		$query = "INSERT INTO Users VALUES($pin, '$username', 1, '$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sunday', $yearsWorked)";
		mysqli_query($conn, $query);

		// header() changes the page to the location listed
		header("Location: adminMain.php");
	}
	else{
		echo "<script>alert('Error Username and Pin must be entered.')</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Creation Page</title>
	</head>
<body>

	<!-- Form to collect the info -->
	<form method="post" action="adminCreation.php">
			<input type="text" name="Username" placeholder="Enter Username"></input>
			<input type="text" name="Pin" placeholder="Enter Pin"></input>
			<input type="text" name="Monday" placeholder="Enter Hours for Monday"></input>
			<input type="text" name="Tuesday" placeholder="Enter Hours for Tuesday"></input>
			<input type="text" name="Wednesday" placeholder="Enter Hours for Wednesday"></input>
			<input type="text" name="Thursday" placeholder="Enter Hours for Thursday"></input>
			<input type="text" name="Friday" placeholder="Enter Hours for Friday"></input>
			<input type="text" name="Saturday" placeholder="Enter Hours for Saturday"></input>
			<input type="text" name="Sunday" placeholder="Enter Hours for Sunday"></input>
			<input type="text" name="YearsWorked" placeholder="Enter Years Worked"></input>
			<input type="Submit" name="Submit"></input>
	</form>
</body>
</html>