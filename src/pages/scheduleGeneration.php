<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');
	// $conn is the conection to database
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
	<title>Work Schedule</title>
	<link rel="stylesheet" href="../style/style.css">
 </head>
 <body>
	<h1>Edit Next Weeks Schedule</h1>
	<table style="center">
		<?php
		// plan to add an automated date with the weekdays to make shcdule easier to read
		//ex Monday 15
		echo "<tr>";
			echo "<td class='schedBorder'><h3>Employee</h3></td>";					
			echo "<td class='schedBorder' ><h3>Monday </h3></td>";
			echo "<td class='schedBorder'><h3>Tuesday </h3></td>";
			echo "<td class='schedBorder'><h3>Wednesday </h3></td>";
			echo "<td class='schedBorder'><h3>Thursday </h3></td>";
			echo "<td class='schedBorder'><h3>Friday </h3></td>";
			echo "<td class='schedBorder'><h3>Saturday </h3></td>";
			echo "<td class='schedBorder'><h3>Sunday </h3></td>";
		echo "</tr>";
		//Selects all the data from the Users Table for use in getting the schedules
		$query = "SELECT * FROM Users JOIN WorkingSchedule";
		//makes the connection to the database with the query and returns the result
		$result = mysqli_query($conn, $query);
		//how many rows of data was retunred from the database
		$numOfRows = mysqli_num_rows($result);
		// or you can put it into the loop directly
		// while($row=mysqli_fetch_assoc($result))
		//which will iterate over every row
		$temp=null;
		while($row = $result->fetch_assoc()) {
			//grabs the current row of data so you can display or manipulate
			if($temp==$row["Username"])
				break;
			echo "<tr>";
			echo "<td class='schedBorder'name='user'>".($row['Username'])."</td>";
			echo "<td class='schedBorder'><h3>".($row['Monday'])."</h3></td>";					
			echo "<td class='schedBorder' ><h3>".($row['Tuesday'])." </h3></td>";
			echo "<td class='schedBorder'><h3>".($row['Wednesday'])." </h3></td>";
			echo "<td class='schedBorder'><h3>".($row['Thursday'])." </h3></td>";
			echo "<td class='schedBorder'><h3>".($row['Friday'])." </h3></td>";
			echo "<td class='schedBorder'><h3>".($row['Saturday'])." </h3></td>";
			echo "<td class='schedBorder'><h3>".($row['Sunday'])." </h3></td>";
			echo "<td class='schedBorder'><form method='post' action='adminUpdateScedule.php'>
											<input type='Hidden' name='userName'id='".($row['Username'])."' value='".($row['Username'])."'></input>
											<input type='Submit' value='Edit'></input>
										</form></td>";
			echo "</tr>";
			$temp=$row["Username"];
		}
		?>
	</table>

	<form method="post" action="adminMain.php">
			<input type="Submit" name="Submit" value="Back"></input>
	</form>
 </body>
 </html>