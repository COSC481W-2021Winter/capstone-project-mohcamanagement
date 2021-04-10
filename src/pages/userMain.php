<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');
	// $conn is the conection to database

	// checking to see if the cookie array is empty
	if(isset($_COOKIE["Username"])) {
		// if not empty then we store the cookie into a variable
		$userCookie = $_COOKIE["Username"];

		// This query is used to make sure the user is allowed to be on the page or not.
		$query = "SELECT * FROM Users WHERE Username = '$userCookie'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$isManagerCheck = $row['IsManager'];

		if($isManagerCheck == 1) {
			header("Location: adminMain.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
	<title>User main page</title>
	<link rel="stylesheet" href="../style/style1.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="../style/style6.css?<?php echo time(); ?>">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
 </head>

<!-- Navbar -->
<header>
    <ul>
		<li><a href="userMain.php">User Main</a></li>
      	<li><a href="/capstone-project-mohcamanagement/src/pages/userUpdateAvailabilty.php">Update Availability</a></li>
      	<li><a href="/capstone-project-mohcamanagement/src/pages/userRequestOff.php">Request Off</a></li>
      	<li style="float:right"><a class="active1" onclick="location.href='/capstone-project-mohcamanagement/src/index.html'">Log out</a></li>
    </ul>
</header>
	

	<body>
		<?php 
		echo "<h1>Welcome $userCookie</h1>";
		 ?>
		<div class="square1">Schedule Placeholder</div>
		<div class="square2">Suggested Inventory / Writeoffs Placeholder</div>
	</body>
</html>
