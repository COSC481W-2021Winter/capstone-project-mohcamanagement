<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');


	function isValidDateCheck(){
		$fromCheck = $_POST['from'];
		$untilCheck = $_POST['until'];
		return preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $fromCheck) == 0 || preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $untilCheck) == 0;
	}

	// $conn is the conection to database
	if(isset($_COOKIE["Username"])) {
		// if not empty then we store the cookie into a variable
		$userCookie = $_COOKIE["Username"];
	}

	if (isset($_POST['send']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		
		// grabbing start and end dates from the form
		

		// This regular expression sends an error if the user doen not enter the correct date format
		if(isValidDateCheck()) {
			echo "<script id='invalidEntry'>alert('Entries needs to be a date in format \"yyyy-mm-dd\".')</script>";
		}

		else {
			$from = new DateTime($_POST['from']);

			// new date
			$date = new DateTime(date('Y-m-d' ));

			// adding a week to date
			$one_week = DateInterval::createFromDateString('1 week');
			$date->add($one_week);

			// if start date is not a week in advance
			if(($date) > ($from))
			{
				echo "<script id='invalidDate'>alert('Date needs to be one week in advance.')</script>";
			}
			// if end date is before start date
			elseif($untilCheck < $fromCheck)
			{
				echo "<script id='invalidDate1'>alert('Ending date can not be before start date.')</script>";
			}
			// if we got to this point, the dates are valid and can be entered into the database
			else{
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
				echo "<script id='validDate'>alert('Manager will be notified.')</script>";
			}
		}
	}

?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<title>Request Off</title>
		<link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">
	</head>

	<body>
		<h1 style="text-align:center;">Request Off <?php echo "$userCookie";?></h1>

		<table class="userCreationTable">
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
						<input type="Submit" name="send" value="Submit"/></input> 
					</td>
				</tr>
			</form>

			<form method="post" action="userMain.php">
				<tr>
					<td style="text-align: center;">
						<input type="Submit" name="back" value="Back"/></input>
					</td>
				</tr>
			</form>
		</table>
	 </body>
 </html>
