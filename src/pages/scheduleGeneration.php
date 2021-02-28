<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');
	// $conn is the conection to database
?>
 <html>
 <head>
	<title>Work Schedule</title>
	<link rel="stylesheet" href="../style/style.css">
 </head>
 <body>
	<h1>Work Schedule</h1>
	<table style="center">
		<?php
		// plan to add an automated date with the weekdays to make shcdule easier to read
		//ex Monday 15
		// $startDate=strtotime("Monday") ;
		// $endDate=strtotime("+1 days","Sunday");
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
		$query = "SELECT * FROM Users";
		//makes the connection to the database with the query and returns the result
		$result = mysqli_query($conn, $query);
		//how many rows of data was retunred from the database
		$numOfRows = mysqli_num_rows($result);
		// or you can put it into the loop directly
		// while($row=mysqli_fetch_assoc($result))
		//which will iterate over every row

		for($i = 0; $i<$numOfRows; $i++) {
			//grabs the current row of data so you can display or manipulate
			$row = mysqli_fetch_assoc($result);
			echo "<tr>";
			echo "<td class='schedBorder'name='user'>".($row['Username'])."</td>";
			echo "<td class='schedBorder'>".$row['Monday']."</td>";
			echo "<td class='schedBorder'>".$row['Tuesday']."</td>";
			echo "<td class='schedBorder'>".$row['Wednesday']."</td>";
			echo "<td class='schedBorder'>".$row['Thursday']."</td>";
			echo "<td class='schedBorder'>".$row['Friday']."</td>";
			echo "<td class='schedBorder'>".$row['Saturday']."</td>";
			echo "<td class='schedBorder'>".$row['Sunday']."</td>";
			echo "</tr>";
		}
		?>
	</table>

	<form method="post" action="adminMain.php">
			<input type="Submit" name="Submit" value="Back"></input>
	</form>
 </body>
 </html>