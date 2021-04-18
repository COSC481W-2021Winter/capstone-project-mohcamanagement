<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');

	date_default_timezone_set("America/New_York");

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

	// Suggested Inventory form
	if (isset($_POST['send']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		// Grab variables from form 
		$suggestedInventory = $_POST['suggestedInventory'];
		$type = $_POST['type'];

		// Query to get the userCookie
		$query = "SELECT * FROM Users WHERE Username = '$userCookie'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$userPin = $row['Pin'];
	
		// Query to insert what the user entered for suggestions
		if(!empty($_POST['suggestedInventory']) && !empty($_POST['type'])){
			$query = "INSERT INTO InventorySuggestions VALUES ('$suggestedInventory', '$type', 'Songbird', '$userPin')";
			mysqli_query($conn, $query);
		}
	}

	// Write Offs form
	if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		// Grab variables from form
		$writeoffs = $_POST['writeoffs'];
		$dateExpired = $_POST['dateExpired'];
	
		// Query to get the userCookie
		$query = "SELECT * FROM Users WHERE Username = '$userCookie'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$userPin = $row['Pin'];

		// Query to insert what the user entered for writeoffs
		if(!empty($_POST['writeoffs']) && !empty($_POST['dateExpired'])){
			$query = "INSERT INTO WriteOffs VALUES ('$writeoffs', '$dateExpired', '$userPin')";
			mysqli_query($conn, $query);
		}
	}

	// Copy and pasted from inventoryLog.php to generate drop down for inventory type
	function getInclude() {
		$dbHost = "localhost";
		$dbUser = "root";
		$dbPass = "";
		$db = "Overseer";

		return mysqli_connect($dbHost, $dbUser, $dbPass, $db);
	}
	// Copy and pasted from inventoryLog.php to generate drop down for inventory type
	function generateOptionsForAddItem() {
		$conn = getInclude();

		$sql = "SELECT * FROM InventoryType";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) {
			echo'<option value="'.str_replace("_", " ", $row["Type"]).'">'.str_replace("_", " ", $row["Type"]).'</option>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
	<title>User main page</title>
	<link rel="stylesheet" href="../style/style1.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="../style/style2.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="../style/style6.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="../style/style8.css?<?php echo time(); ?>">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
 </head>

<!-- Navbar -->
<header>
    <ul>
		<li><a href="userMain.php">User Main</a></li>
      	<li><a href="userUpdateAvailabilty.php">Update Availability</a></li>
      	<li><a href="userRequestOff.php">Request Off</a></li>
      	<li style="float:right"><a class="active1" onclick="location.href='../index.php'">Log out</a></li>
    </ul>
</header>
	

	<body>
	<div class="wrapper content inside-table">
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
				<tr class="a" :hover>
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

						echo "<tr class='a' :hover>";
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
				<tr class="a" :hover>
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
			<h3>Suggested Inventory / Write Offs</h3>
			<!-- Every first <td> is for suggestedInvetory table, and every second <td> is for writeOffs. -->
			<!-- In webpage, suggestedInventory displays on the left side of the table, and writeOffs on the right. -->
			<table>
			<form action="userMain.php" method="post">
				<tr>
					<th>Inventory Suggestions</th>
					<th>Write Offs</th>
				</tr>
				<tr>
					<td class="a" :hover><input size="22px" type="text" name="suggestedInventory" placeholder="Suggested Inventory" class="inputBox"></input></td>
					<td class="a" :hover><input size="22px" type="text" name="writeoffs" placeholder="Write Offs" class="inputBox"></input></td>
				</tr>
				<tr>
					<td class="a" :hover>
						<select name="type" id="type">
							<option selected disabled>Select Item Category</option>
							<?php
								generateOptionsForAddItem();
							?>
						</select>
					</td>
					<td class="a" :hover>
						<input size="22px" type="date" name="dateExpired" value="<?php echo date('Y-m-d');?>" class="inputBox"></input>
					</td>
				</tr>
				<tr>
					<!-- Submit button for suggestedInventory -->
					<td class="a" :hover style="text-align: center;">
						<input type="Submit" name="send" value="Submit"/></input> 
					</td>
					<!-- Submit button for writeOffs -->
					<td class="a" :hover style="text-align: center;">
						<input type="Submit" name="submit" value="Submit"/></input> 
					</td>
				</tr>
			</form>
			</table>
		</div>

		<!-- Footer -->
		<div class="push"></div>
  		</div>
		<footer class="footer3 center">&#169 2021 Overseer</footer>	
	</body>
</html>
