<?php
	/*Insert Code here*/
	include("../includes/dbConnection.php");


	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["update"])) {
		// checking to see if the user is updating their info.
		if(isset($_POST['isManager']))
			$isManager = $_POST['isManager'];
		else
			$isManager = 1;

		$selectedUser = $_POST['userToUpdate'];
		$yearsWorked = $_POST['yearsWorked']; 
		// regex for correct number input
		if(preg_match("/^([0-9]|[0-9]{2})$/", $yearsWorked) == 0){
			echo "<script>alert('Error years worked has to be a number from 0-99!')</script>";
		}
		else{
			$query = "UPDATE Users SET IsManager=$isManager, YearsWorked = '$yearsWorked' WHERE Username = '$selectedUser'";
			mysqli_query($conn, $query);

			echo "<script>alert('User $selectedUser Information was Updated')</script>";
		}
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["delete"])) {
		$selectedUser = $_POST['userToDelete'];

		$query = "SELECT * FROM Users WHERE Username = '$selectedUser'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$userPin = $row['Pin'];
		$query = "DELETE FROM WriteOffs WHERE Pin = '$userPin'";
		mysqli_query($conn, $query);
		$query = "DELETE FROM RequestOff WHERE Pin = '$userPin'";
		mysqli_query($conn, $query);
		$query = "DELETE FROM InventorySuggestions WHERE Pin = '$userPin'";
		mysqli_query($conn, $query);
		$query = "DELETE FROM Availability WHERE Pin = '$userPin'";
		mysqli_query($conn, $query);


		$query = "DELETE FROM Users WHERE Username = '$selectedUser'";
		mysqli_query($conn, $query);

		echo "<script>alert('User $selectedUser was Deleted')</script>";
	}

	// checking to see if the user is allowed to be on the page.
	if(isset($_COOKIE["Username"])) {
		// if not empty then we store the cookie into a variable
		$userCookie = $_COOKIE["Username"];
		$query = "SELECT * FROM Users WHERE Username = '$userCookie'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$isManagerCheck = $row['IsManager'];

		if($isManagerCheck == 0) {
			header("Location: userMain.php");
		}
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["Create"])){


		if(!empty($_POST["Username"]) && !empty($_POST['Pin'])){
			// if POST array has the variables in it then we save the variables 
			$username = $_POST['Username'];
			$pin = $_POST['Pin'];

			if(preg_match("/^[A-Z]{2}[a-z]+$/", $username) == 0 && preg_match("/^[0-9]{4}$/",$pin) == 0) {
				echo "<script>alert('Error Username must be only letters following format \"AAb+\" where A is a capitol letter and b is one or more lowercase letters. Pin must follow format \"xxxx\"')</script>";
			}

			elseif(preg_match("/^[A-Z]{2}[a-z]+$/", $username) == 0) {
				echo "<script>alert('Error Username must be only letters following format \"AAb+\" where A is a capitol letter and b is one or more lowercase letters.')</script>";
			}

			elseif(preg_match("/^[0-9]{4}$/",$pin) == 0) {
				echo "<script>alert('Error pin must follow format \"xxxx\"')</script>";
			}

			else {

				// Two bools for checking to see if user already in table (assuming that entry is unique)
				// 1 == true, 0 == false
				$userUnique = 1;
				$pinUnique = 1;

				// Run a query to check the table and see if the entry is already in the table
				$query = "SELECT * FROM Users";
				$result = mysqli_query($conn, $query);
				$numOfRows = mysqli_num_rows($result);

				for($i = 0; $i<$numOfRows; $i++) {
					$row = mysqli_fetch_assoc($result);

					// Finding that the entries are already in the table so set the bools to false
					if($row["Username"] == $username && $row["Pin"] == $pin) {
						$userUnique = 0;
						$pinUnique = 0;
						break;
					}

					elseif($row["Username"] == $username) {
						$userUnique = 0;
						break;
					}
					elseif($row["Pin"] == $pin) {
						$pinUnique = 0;
						break;
					}
				}
				// If entries are unique we can add them to the table
				if($userUnique == 1 && $pinUnique == 1) {
					// check to see if the years worked value is null or not
					// if not then save the post value in variable
					if(!empty($_POST['YearsWorked']))
						$yearsWorked = $_POST['YearsWorked'];

					else
						$yearsWorked = 0;

	/************Use the saved variables to insert into the Users table********************/
					if(preg_match("/^[0-9][0-9]?$/",$yearsWorked) == 0) {
						echo "<script>alert('Error years worked need to be a number with either one or two digits.')</script>";
					}
					else {
						$query = "INSERT INTO Users VALUES('$username', '$pin', 0, '$yearsWorked', 'Songbird')";
						mysqli_query($conn, $query);
		/**************************************************************************************/
						$query = "INSERT INTO WorkingSchedule VALUES ('$username','Off','Off','Off','Off','Off','Off','Off')";
						mysqli_query($conn, $query);
		/****************************For Monday Availability**********************************/
						//day selected is for each day of the week
						$daySelected = 'Monday'; 

						if(!empty($_POST['monShift'])) {
							$check = $_POST['monShift'];
							$size = count($check);

							for($i = 0; $i<$size; $i++) {
								$shiftToInsert = $check[$i];
								$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
								mysqli_query($conn, $query);

								// checks to see if off is selected. If so removes all for that day and just puts off instead.
								if($shiftToInsert == "Off") {
									$query = "DELETE FROM Availability WHERE Pin = '$pin' AND Day = 'Monday'"; 
									mysqli_query($conn, $query);

									$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
									mysqli_query($conn, $query);
								}
							}
						}	
						// if post array is empty then just insert off into table.
						else {
							$shiftToInsert = 'Off';
							$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
							mysqli_query($conn, $query);
						}
		/**************************************************************************************/
						
		/****************************For Tuesday Availability**********************************/
						//day selected is for each day of the week
						$daySelected = 'Tuesday';	

						if(!empty($_POST['tueShift'])) {
							$check = $_POST['tueShift'];
							$size = count($check);

							for($i = 0; $i<$size; $i++) {
								$shiftToInsert = $check[$i];
								$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
								mysqli_query($conn, $query);

								// checks to see if off is selected. If so removes all for that day and just puts off instead.
								if($shiftToInsert == "Off") {
									$query = "DELETE FROM Availability WHERE Pin = '$pin' AND Day = 'Monday'"; 
									mysqli_query($conn, $query);

									$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
									mysqli_query($conn, $query);
								}
							}
						}	
						// if post array is empty then just insert off into table.
						else {
							$shiftToInsert = 'Off';
							$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
							mysqli_query($conn, $query);
						}
		/**************************************************************************************/

		/****************************For Wednesday Availability*******************************/
						//day selected is for each day of the week
						$daySelected = 'Wednesday';	

						if(!empty($_POST['wedShift'])) {
							$check = $_POST['wedShift'];
							$size = count($check);

							for($i = 0; $i<$size; $i++) {
								$shiftToInsert = $check[$i];
								$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
								mysqli_query($conn, $query);

								// checks to see if off is selected. If so removes all for that day and just puts off instead.
								if($shiftToInsert == "Off") {
									$query = "DELETE FROM Availability WHERE Pin = '$pin' AND Day = 'Monday'"; 
									mysqli_query($conn, $query);

									$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
									mysqli_query($conn, $query);
								}
							}
						}	
						// if post array is empty then just insert off into table.
						else {
							$shiftToInsert = 'Off';
							$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
							mysqli_query($conn, $query);
						}
		/**************************************************************************************/

		/****************************For Thursday Availability*********************************/
						//day selected is for each day of the week
						$daySelected = 'Thursday';

						if(!empty($_POST['thurShift'])) {
							$check = $_POST['thurShift'];
							$size = count($check);

							for($i = 0; $i<$size; $i++) {
								$shiftToInsert = $check[$i];
								$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
								mysqli_query($conn, $query);

								// checks to see if off is selected. If so removes all for that day and just puts off instead.
								if($shiftToInsert == "Off") {
									$query = "DELETE FROM Availability WHERE Pin = '$pin' AND Day = 'Monday'"; 
									mysqli_query($conn, $query);

									$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
									mysqli_query($conn, $query);
								}
							}
						}	
						// if post array is empty then just insert off into table.
						else {
							$shiftToInsert = 'Off';
							$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
							mysqli_query($conn, $query);
						}
		/**************************************************************************************/

		/****************************For Friday Availability**********************************/
						//day selected is for each day of the week
						$daySelected = 'Friday';

						if(!empty($_POST['friShift'])) {
							$check = $_POST['friShift'];
							$size = count($check);

							for($i = 0; $i<$size; $i++) {
								$shiftToInsert = $check[$i];
								$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
								mysqli_query($conn, $query);

								// checks to see if off is selected. If so removes all for that day and just puts off instead.
								if($shiftToInsert == "Off") {
									$query = "DELETE FROM Availability WHERE Pin = '$pin' AND Day = 'Monday'"; 
									mysqli_query($conn, $query);

									$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
									mysqli_query($conn, $query);
								}
							}
						}
						// if post array is empty then just insert off into table.	
						else {
							$shiftToInsert = 'Off';
							$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
							mysqli_query($conn, $query);
						}
		/**************************************************************************************/

		/****************************For Saturday Availability*********************************/
						//day selected is for each day of the week
						$daySelected = 'Saturday';	

						if(!empty($_POST['satShift'])) {
							$check = $_POST['satShift'];
							$size = count($check);

							for($i = 0; $i<$size; $i++) {
								$shiftToInsert = $check[$i];
								$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
								mysqli_query($conn, $query);

								// checks to see if off is selected. If so removes all for that day and just puts off instead.
								if($shiftToInsert == "Off") {
									$query = "DELETE FROM Availability WHERE Pin = '$pin' AND Day = 'Monday'"; 
									mysqli_query($conn, $query);

									$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
									mysqli_query($conn, $query);
								}
							}
						}	
						// if post array is empty then just insert off into table.
						else {
							$shiftToInsert = 'Off';
							$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
							mysqli_query($conn, $query);
						}
		/**************************************************************************************/

		/****************************For Sunday Availability***********************************/
						//day selected is for each day of the week
						$daySelected = 'Sunday';

						if(!empty($_POST['sunShift'])) {
							$check = $_POST['sunShift'];
							$size = count($check);

							for($i = 0; $i<$size; $i++) {
								$shiftToInsert = $check[$i];
								$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
								mysqli_query($conn, $query);

								// checks to see if off is selected. If so removes all for that day and just puts off instead.
								if($shiftToInsert == "Off") {
									$query = "DELETE FROM Availability WHERE Pin = '$pin' AND Day = 'Monday'"; 
									mysqli_query($conn, $query);

									$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
									mysqli_query($conn, $query);
								}
							}
						}	
						// if post array is empty then just insert off into table.
						else {
							$shiftToInsert = 'Off';
							$query = "INSERT INTO Availability VALUES ('$daySelected','$pin','$shiftToInsert')";
							mysqli_query($conn, $query);
						}
		/**************************************************************************************/
					}	
				}
				// Else print error saying that the entry is not unique
				else {
					echo "<script>alert('Error Username or Pin already in database.')</script>";
				}
			}
		}
		else {
			echo "<script>alert('Error Username and Pin must be entered.')</script>";
		}
	}

	function generateOption(){
		$query = "SELECT * from Users";
		$result = mysqli_query($conn, $query);
		$numOfRows = mysqli_num_rows($result);
		echo" <option selected disabled>test </option>";
		for($i = 0; $i < $numOfRows; $i++){
			$row = mysqli_fetch_assoc($result);
			$userName = $row['Username'];
			echo "<option value='".$userName."'> ".$userName." </option>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>AdminCreateUser</title>
		
		<link rel="stylesheet" href="../style/style1.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="../style/style2.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="../style/style4.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="../style/tables.css?<?php echo time(); ?>">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
		
	
	</head>
	<!-- Navbar -->
	<header>
    	<ul>
			<li><a href="adminMain.php">Admin Main</a></li>
      		<li><a href="/capstone-project-mohcamanagement/src/pages/inventoryLog.php">Inventory Log</a></li>
      		<li><a href="/capstone-project-mohcamanagement/src/pages/scheduleGeneration.php">Schedule Generation</a></li>
	  		<li><a href="/capstone-project-mohcamanagement/src/pages/adminCreateUser.php">Create Users</a></li>
      		<li style="float:right"><a class="active1" onclick="location.href='/capstone-project-mohcamanagement/src/index.html'">Log out</a></li>
      	
      		
    	</ul>
	</header>

	<body class="image">
		<div class="wrapper">
		<h1 style="text-align: center;">Create User</h1>
		<div style="width: 40%; margin: auto;">
			<table class="userCreationTable">
				<form method="post" action="adminCreateUser.php">
					<tr>
						<td style="text-align: center; padding: 5px;" colspan="3">
							<input size="22px" type="text" name="Username" placeholder="Enter Username" class="inputBox"></input>
							<span class="required">*</span>
						</td>

					
						<td style="text-align: center; padding: 5px;" colspan="4" >
							<input size="22px" type="text" name="Pin" placeholder="Enter Pin" class="inputBox"></input>
							<span class="required">*</span>
						</td>
					</tr>

					<tr>
						<th style="padding-top: 5px; border-top-style: solid;" colspan="7">Availability</th>	
					</tr>

					<tr>	
						<td style="padding: 0px 5px 5px 5px;">Monday</td>
						<td style="padding: 0px 5px 5px 5px;">Tuesday</td>
						<td style="padding: 0px 5px 5px 5px;">Wednesday</td>
						<td style="padding: 0px 5px 5px 5px;">Thursday</td>
						<td style="padding: 0px 5px 5px 5px;">Friday</td>
						<td style="padding: 0px 5px 5px 5px;">Saturday</td>
						<td style="padding: 0px 5px 5px 5px;">Sunday</td>

					</tr>
					<tr style="border-bottom-style: solid;">
						<td style="text-align: left;">
							<?php 
							$query = "SELECT * FROM ShiftTimes";
							$result = mysqli_query($conn, $query);
							$numOfRows = mysqli_num_rows($result);

							for($i = 1; $i<$numOfRows+1; $i++) {
								$row = mysqli_fetch_assoc($result);
								$shiftName = $row['ShiftName'];
								echo "<input type='checkbox' id='shift$i' name='monShift[]' value='$shiftName'>$shiftName<br></input>";
								// can have a tag that lets the box be checked or unchecked
							}
							 ?>
						</td>	

						
						<td style="text-align: left;">
							<?php 
							$query = "SELECT * FROM ShiftTimes";
							$result = mysqli_query($conn, $query);
							$numOfRows = mysqli_num_rows($result);

							for($i = 1; $i<$numOfRows+1; $i++) {
								$row = mysqli_fetch_assoc($result);
								$shiftName = $row['ShiftName'];
								echo "<input type='checkbox' id='shift$i' name='tueShift[]' value='$shiftName'>$shiftName<br></input>";
								// can have a tag that lets the box be checked or unchecked
							}
							 ?>
						</td>
						
						<td style="text-align: left;">
							<?php 
							$query = "SELECT * FROM ShiftTimes";
							$result = mysqli_query($conn, $query);
							$numOfRows = mysqli_num_rows($result);

							for($i = 1; $i<$numOfRows+1; $i++) {
								$row = mysqli_fetch_assoc($result);
								$shiftName = $row['ShiftName'];
								echo "<input type='checkbox' id='shift$i' name='wedShift[]' value='$shiftName'>$shiftName<br></input>";
								// can have a tag that lets the box be checked or unchecked
							}
							 ?>
						</td>
						
						<td style="text-align: left;">
							<?php 
							$query = "SELECT * FROM ShiftTimes";
							$result = mysqli_query($conn, $query);
							$numOfRows = mysqli_num_rows($result);

							for($i = 1; $i<$numOfRows+1; $i++) {
								$row = mysqli_fetch_assoc($result);
								$shiftName = $row['ShiftName'];
								echo "<input type='checkbox' id='shift$i' name='thurShift[]' value='$shiftName'>$shiftName<br></input>";
								// can have a tag that lets the box be checked or unchecked
							}
							 ?>
						</td>
						
						<td style="text-align: left;">
							<?php 
							$query = "SELECT * FROM ShiftTimes";
							$result = mysqli_query($conn, $query);
							$numOfRows = mysqli_num_rows($result);

							for($i = 1; $i<$numOfRows+1; $i++) {
								$row = mysqli_fetch_assoc($result);
								$shiftName = $row['ShiftName'];
								echo "<input type='checkbox' id='shift$i' name='friShift[]' value='$shiftName'>$shiftName<br></input>";
								// can have a tag that lets the box be checked or unchecked
							}
							 ?>
						</td>
						
						<td style="text-align: left;">
							<?php 
							$query = "SELECT * FROM ShiftTimes";
							$result = mysqli_query($conn, $query);
							$numOfRows = mysqli_num_rows($result);

							for($i = 1; $i<$numOfRows+1; $i++) {
								$row = mysqli_fetch_assoc($result);
								$shiftName = $row['ShiftName'];
								echo "<input type='checkbox' id='shift$i' name='satShift[]' value='$shiftName'>$shiftName<br></input>";
								// can have a tag that lets the box be checked or unchecked
							}
							 ?>
						</td>
						
						<td style="text-align: left;">
							<?php 
							$query = "SELECT * FROM ShiftTimes";
							$result = mysqli_query($conn, $query);
							$numOfRows = mysqli_num_rows($result);

							for($i = 1; $i<$numOfRows+1; $i++) {
								$row = mysqli_fetch_assoc($result);
								$shiftName = $row['ShiftName'];
								echo "<input type='checkbox' id='shift$i' name='sunShift[]' value='$shiftName'>$shiftName<br></input>";
								// can have a tag that lets the box be checked or unchecked
							}
							 ?>
						</td>
					</tr>

					<tr>
						<td style="text-align: center; padding: 5px;" colspan="7">
							<input size="22px" type="text" name="YearsWorked" placeholder="Enter Years Worked" class="inputBox"></input>
						</td>
					</tr>

					<tr>
						<td colspan="3" style="text-align: right; padding: 5px;">
							<input style="background-color: #343131;  color: #969595;" type="Submit" name="Create" value="Create"></input>
						</td>	
				</form>

				<form method="post" action="adminMain.php">
						<td colspan="4" style="text-align: left; padding: 5px;">
							<input type="Submit" name="Submit" value="Back" style="background-color: #343131;  color: #969595;"></input>
						</td>
					</tr>
				</form>
			</table>	

			<div style="margin-top: 25px; ">
				
			</div>

	<h2 style="text-align: center;">Edit Employee</h2>
		<table style="margin: auto;"> 
			<tr>
				<td style="text-align: center;">
					<form method="post" action="adminCreateUser.php">
						<select name="username" onchange="this.form.submit()">
						<option selected disabled>Select User To Update </option>
							<?php
								// this calls if the form was submitted with the dropdown menu
								if (isset($_POST['username'])) {
									$query = "SELECT * from Users";
									$result = mysqli_query($conn, $query);
									$numOfRows = mysqli_num_rows($result);

									for($i = 0; $i < $numOfRows; $i++) {
										$row = mysqli_fetch_assoc($result);
										$userName = $row['Username'];

										if($_POST['username'] == $userName) {
											echo "<option selected value='".$userName."'> ".$userName." </option>";
										}
										else {
											echo "<option value='".$userName."'> ".$userName." </option>";
										}
									}

									$selectedUser=$_POST['username'];
									$query = "SELECT * from Users WHERE Username='$selectedUser'";
									$result = mysqli_query($conn, $query);
									$row = mysqli_fetch_assoc($result);
									$yearsWorked=$row['YearsWorked'];
									$isManager=$row['IsManager'];
									?>

								<form method='post' action='adminCreateUser.php'>
									<table>
										<tr>	
											<?php 
												if($userCookie != $selectedUser){
													echo "<th>Years Worked</th>";
													echo "<th>Is Manager</th>";
												}
												else {
													echo "<th>Years Worked</th>";
												}
											 ?>
												
										</tr>

										<tr>
											<td>
												
												<?php
												echo "<input type='text' id='yearsWorked' name='yearsWorked' value=$yearsWorked size='13'></input>";
												?>
											</td>

											

												<?php 
													if($userCookie != $selectedUser){
														echo "<td style='padding: 5px;'>";
														if($isManager == 0){
															echo "<input type='radio' name='isManager' value=1> Yes </input>" ;
															echo " <br>";
															echo "<input checked type='radio' name='isManager' value=0> No </input>";
														}
														else{
															echo "<input checked type='radio' name='isManager' value=1> Yes </input>";
															echo " <br>";
															echo "<input type='radio' name='isManager' value=0> No </input>";
														}
														echo "</td>";
													}
												?>
											
										</tr>
										<tr style="border-top-style: solid;">
											<td style="text-align: right;">
												<?php 
												echo "<input type='Hidden' id='userToUpdate' name='userToUpdate' value='$selectedUser' />";
												?>
												<input type='submit' name='update' value='Update'/>
								</form>
											</td>

												<form method='post' action='adminCreateUser.php'>
													<?php 
													if($userCookie != $selectedUser){
														echo "<td style='text-align: left;'>";
														echo "<input type='Hidden' id='userToDelete' name='userToDelete' value='$selectedUser' />";
														echo "<input type='submit' name='delete' value='Terminate'/>";	
														echo "</td>";
													}
													?>
												</form>
										</tr>
									</table>

							<?php 
								}
								// Else generate the selection menu on the drop down
								else{
									$query = "SELECT * from Users";
									$result = mysqli_query($conn, $query);
									$numOfRows = mysqli_num_rows($result);
									for($i = 0; $i < $numOfRows; $i++){
										$row = mysqli_fetch_assoc($result);
										$userName = $row['Username'];
										echo "<option value='".$userName."'> ".$userName." </option>";
									}
								}
							?>
						</select> 
					</form>
				</td>
			</tr>
		</table>
		</div>
		<div class="push"></div>
  		</div>
		<footer class="footer3 center">&#169 2021 Overseer</footer>
	</body>
</html>
