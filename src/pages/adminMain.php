<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');

	date_default_timezone_set("America/New_York");
	
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
	function getInclude() {
		$dbHost = "localhost";
		$dbUser = "root";
		$dbPass = "";
		$db = "Overseer";

		return mysqli_connect($dbHost, $dbUser, $dbPass, $db);
	}

// to generate the writeOffs
	function writeOffs(){
		$conn=getInclude();
		$query = "SELECT * FROM WriteOffs ";
		$result = mysqli_query($conn, $query);
		while($row = $result->fetch_assoc()) {
			echo "<tr>
				<td>
				Item: ".$row['ItemName']."
				</td>
				</tr>
			
			";
		}
	}

// to generate the suggestedInventory
	function suggestedInventory(){
		$conn=getInclude();
		$query = "SELECT * FROM InventorySuggestions ";
		$result = mysqli_query($conn, $query);
		while($row = $result->fetch_assoc()) {
			echo "<tr>
				<td>
				Item: ".$row['ItemName']." Stock: ".$row['Type']."
				</td>
				</tr>
			
			";
			
		}
	}



?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Main Page</title>
		<link rel="stylesheet" href="../style/style1.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="../style/style6.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="../style/style7.css?<?php echo time(); ?>">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
	</head>


<!-- Navbar -->
<header>
    <ul>
		<li><a href="adminMain.php">Admin Main</a></li>
      	<li><a href="/capstone-project-mohcamanagement/src/pages/inventoryLog.php">Inventory Log</a></li>
      	<li><a href="/capstone-project-mohcamanagement/src/pages/scheduleGeneration.php">Schedule Generation</a></li>
	  	<li><a href="/capstone-project-mohcamanagement/src/pages/adminCreateUser.php">Employees</a></li>
      	<li style="float:right"><a class="active1" onclick="location.href='/capstone-project-mohcamanagement/src/index.php'">Log out</a></li>
    </ul>
</header>
	
<body>
<div class="wrapper content inside-table">
	<?php 
		
		echo "<h1>Welcome $userCookie</h1>";

		function createUserShiftTable($result){
			while(($row = mysqli_fetch_assoc($result)) != null){
				echo "<tr>";
				echo "<td>".$row['Username']."</td>";
				echo "<td>".$row['Monday']."</td>";
			    echo "<td>".$row['Tuesday']."</td>";
				echo "<td>".$row['Wednesday']."</td>";
				echo "<td>".$row['Thursday']."</td>";
				echo "<td>".$row['Friday']."</td>";
				echo "<td>".$row['Saturday']."</td>";
				echo "<td>".$row['Sunday']."</td>";
				echo "</tr>";
			}
		}
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
			
			<h3>Current Work Week</h3>
			<table>
				<tr>
					<th>User</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
					<th>Sunday</th>
				</tr>
				<?php
					$query = "SELECT * FROM CurrentSchedule";
					$result = mysqli_query($conn, $query);
					createUserShiftTable($result);
				?>
			</table>
			<h3>Suggested Inventory / Writeoffs Placeholder</h3>
		</div>


	</div>
  
	<!-- to display all of the WriteOffs -->
	<div class="square3">
		<!-- <p>Suggested Inventory / Writeoffs Placeholder</p> -->
	<!-- generate writeoff List -->
	<?php
		echo "<table style='border:solid black 3px'>";
		echo "<tr>Write Offs</tr>";
		writeOffs();
		echo "</table>";
	?>
  
  
  
	<!-- to display all of the suggested inventory -->
	<div class="square3">
		<!-- <p>Employee Updates / Request Offs Placeholder</p> -->
		<!-- generate suggested list -->
	<?php
		
		echo "<table style='border:solid black 3px'>";
		echo "<tr>Suggested Inventory</tr>";
		suggestedInventory();
		echo "</table>";
	?>

	</div>

	<!-- Footer -->
	<div class="push"></div>
  	</div>
	<footer class="footer3 center">&#169 2021 Overseer</footer>	
</body>
</html>