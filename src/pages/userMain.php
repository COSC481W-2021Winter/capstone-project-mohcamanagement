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
	<link rel="stylesheet" href="../style/style7.css?<?php echo time(); ?>">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
 </head>

<!-- Navbar -->
<header>
    <ul>
		<li><a href="userMain.php">User Main</a></li>
      	<li><a href="/capstone-project-mohcamanagement/src/pages/userUpdateAvailabilty.php">Update Availability</a></li>
      	<li><a href="/capstone-project-mohcamanagement/src/pages/userRequestOff.php">Request Off</a></li>
      	<li style="float:right"><a class="active1" onclick="location.href='/capstone-project-mohcamanagement/src/index.php'">Log out</a></li>
    </ul>
</header>
	

	<body>
		<?php 
		echo "<h1>Welcome $userCookie</h1>";
		$query = "SELECT * FROM CurrentSchedule WHERE Username='$userCookie'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		
		$user = $row['Username'];
		$monday = $row['Monday'];
		$tuesday = $row['Tuesday'];
		$wednesday = $row['Wednesday'];
		$thursday = $row['Thursday'];
		$friday = $row['Friday'];
		$saturday = $row['Saturday'];
		$sunday = $row['Sunday'];
		 ?>
		 
		<h3>Shift Information</h3>
		<div class="inside-table">
			<table style="margin-top: 6px; margin-bottom: 10px;">
				<tr>
					<th>Shifts</th>
					<th>In</th>
					<th>Out</th>
				</tr>
				<?php 
					$query = "SELECT * from ShiftTimes";
					$result = mysqli_query($conn, $query);
					$numOfRows = mysqli_num_rows($result);

					for($i = 0; $i<$numOfRows; $i++) {
						$row = mysqli_fetch_assoc($result);

						$shiftName = $row['ShiftName'];

						$startTime = $row['StartTime'];
						$endTime = $row['EndTime'];

						echo "<tr>";
						echo "<td>$shiftName</td>";
						echo "<td>$startTime</td>";
						echo "<td>$endTime</td>";
						echo "</tr>";

					}
				 ?>
			</table>
			
			<h3>Your Work Week</h3>
			<table>
				<tr>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
					<th>Sunday</th>
				</tr>
				<tr>
				<?php
					echo "<td>$monday</td>";
					echo "<td>$tuesday</td>";
					echo "<td>$wednesday</td>";
					echo "<td>$thursday</td>";
					echo "<td>$friday</td>";
					echo "<td>$saturday</td>";
					echo "<td>$sunday</td>";
				?>
				</tr>
			</table>
			<h3>Suggested Inventory / Writeoffs Placeholder</h3>
		</div>
	</body>
</html>
