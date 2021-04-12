<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');
	// $conn is the conection to database
	
	// checking to see if the cookie array is empty
	if(isset($_COOKIE["Username"])) {
		// if not empty then we store the cookie into a variable
		$userCookie = $_COOKIE["Username"];
		
		// checking to see if the user is allowed to be on the page.
		$query = "SELECT * FROM Users WHERE Username = '$userCookie'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$isManagerCheck = $row['IsManager'];

		if($isManagerCheck == 0) {
			header("Location: userMain.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Main Page</title>
		<link rel="stylesheet" href="../style/style1.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="../style/style6.css?<?php echo time(); ?>">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
	</head>


<!-- Navbar -->
<header>
    <ul>
		<li><a href="adminMain.php">Admin Main</a></li>
      	<li><a href="/capstone-project-mohcamanagement/src/pages/inventoryLog.php">Inventory Log</a></li>
      	<li><a href="/capstone-project-mohcamanagement/src/pages/scheduleGeneration.php">Schedule Generation</a></li>
	  	<li><a href="/capstone-project-mohcamanagement/src/pages/adminCreateUser.php">Create Users</a></li>
      	<li style="float:right"><a class="active1" onclick="location.href='/capstone-project-mohcamanagement/src/index.php'">Log out</a></li>
    </ul>
</header>
	
<body>
	<?php 
	echo "<h1>Welcome $userCookie</h1>";
	 ?>
	<div class="square1">
		<p>Schedule Placeholder</p>
	</div>

	<div class="square2">
		<p>Suggested Inventory / Writeoffs Placeholder</p>
	</div>

	<div class="square2">
		<p>Employee Updates / Request Offs Placeholder</p>
	</div>
</body>
</html>
