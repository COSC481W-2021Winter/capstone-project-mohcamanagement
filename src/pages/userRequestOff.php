<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');
	// $conn is the conection to database
	if(isset($_COOKIE["Username"])) {
		// if not empty then we store the cookie into a variable
		$userCookie = $_COOKIE["Username"];
	}

	// TODO finsih connection to database upon table creation for requests off
	if (isset($_POST['send']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$query = "SELECT * FROM Users WHERE Username = '$userCookie'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$userPin = $row['Pin'];
		
		if(!empty($_POST['from']) && !empty($_POST['until']) && !empty($_POST['type'])){
			$from = $_POST['from'];
			$until = $_POST['until'];
			$mandatory = $_POST['type'];
			if($mandatory == 'mandatory'){
				$mandatory = 1;
			}
			else{
				$mandatory = 0;
			}
			$query = "INSERT INTO RequestOff VALUES ('$from', '$until', $mandatory,'$userPin')";
			mysqli_query($conn, $query);
		}
	}
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<title>Request Off</title>
		<link rel="stylesheet" type="text/css" href="../style/style.css">
	</head>


	<body>
		<h1 style="text-align:center;">Request Off <?php echo "$userCookie";?></h1>

		<table style="margin-top: 10px;" class="userCreationTable">
			<?php
			//TODO be changed to whoever is logged in
			$query = "SELECT * FROM Users";
			$result = mysqli_query($conn, $query);
			$numOfRows = mysqli_num_rows($result);

				//grabs the current row of data so you can display or manipulate
				$row = mysqli_fetch_assoc($result);
			// }
			?>
			<!-- TODO fix placment of form on screen -->
			<form action="userRequestOff.php" method="post">
				<tr>
					<td style="text-align: center;">Start Date</td>
				</tr>

				<tr>
					<td>
						<input id="from" name="from" type="date" value="<?php echo date('Y-m-d');?>" class="inputBox"/>
					</td>
				</tr>

				<tr>
					<td style="text-align: center;">End Date</td>
				</tr>

				<tr>
					<td>
						<input id="until" name="until" type="date" value="<?php echo date('Y-m-d');?>" class="inputBox"/>
					</td>
				</tr>

				<tr>
					<td style="text-align: center;">
						<input type="radio" checked name="type" value="mandatory">&nbsp;Mandatory</input>
					</td>
				</tr>

				<tr>
					<td style="text-align: center;">
						<input type="radio" name="type" value="optional">&nbsp;Optional</input>
					</td>
				</tr>

				<tr>
					<td style="text-align: center;">
						<input type="Submit" name="send" value="Submit"/>
					</td>
				</tr>
			</form>

			<form method="post" action="userMain.php">
				<tr>
					<td style="text-align: center;">
						<input type="Submit" name="back" value="Back"/>
					</td>
				</tr>
			</form>
		</table>
	 </body>
 </html>
