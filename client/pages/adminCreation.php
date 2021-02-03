<?php
	/*Insert Code here*/
	include("../includes/dbConnection.php");

	// checking to see if the username info was passed to the page from the form
	if(!empty($_POST["Username"]))
		$username = $_POST['Username'];

	// checking to see if the pin info was passed to the page from the form
	if(!empty($_POST['Pin']))
		$pin = $POST['Pin'];

	$query = "INSERT INTO Users VALUES($pin, '$Username', 1)";
	$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Creation Page</title>
	</head>
<body>

	<!-- Insert Code here -->
	<form method="post" action="adminCreation.php">
			<input type="text" name="Username" placeholder="Enter Username"></input>
			<input type="text" name="Pin" placeholder="Enter Pin"></input>
			<input type="Submit" name="Submit"></input>
	</form>

</body>
</html>