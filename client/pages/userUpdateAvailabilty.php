<?php
	$username=$_COOKIE['Username'];
	include("../includes/dbConnection.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$query = "SELECT * from Users where Username='$username'";
		$result = mysqli_query($conn, $query);

		$currMon= '';
		$currTue= '';
		$currWed= '';
		$currThur= '';
		$currFri= '';
		$currSat= ''; 
		$currSun = '';

		$row = mysqli_fetch_assoc($result);
			$currMon = $row['Monday'];
			$currTue = $row['Tuesday'];
			$currWed = $row['Wednesday'];
			$currThur = $row['Thursday'];
			$currFri = $row['Friday'];
			$currSat = $row['Saturday'];
			$currSun = $row['Sunday'];

			
		if(!empty($_POST['monday']))
			$monday = $_POST['monday'];
		else
			$monday = $currMon;

		if(!empty($_POST['tuesday']))
			$tuesday = $_POST['tuesday'];
		else
			$tuesday = $currTue;

		if(!empty($_POST['wednesday']))
			$wednesday = $_POST['wednesday'];
		else
			$wednesday = $currWed;
		
		if(!empty($_POST['thursday']))
			$thursday = $_POST['thursday'];
		else
			$thursday = $currThur;

		if(!empty($_POST['friday']))
			$friday = $_POST['friday'];
		else
			$friday = $currFri;

		if(!empty($_POST['saturday']))
			$saturday = $_POST['saturday'];
		else
			$saturday = $currSat;

		if(!empty($_POST['sunday']))
			$sunday = $_POST['sunday'];
		else
			$sunday = $currSun;

		$query = "UPDATE Users SET Monday='$monday', Tuesday='$tuesday', Wednesday='$wednesday', Thursday='$thursday', Friday='$friday', Saturday='$saturday', Sunday='$sunday' WHERE Username='$username'";
		mysqli_query($conn, $query);

		echo '<script type="text/javascript"> alert("Schedule Updated") </script>';
		// header() changes the page to the location listed
		header("Location: userMain.php");
		
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User Update Availability</title>
		<link rel="stylesheet" type="text/css" href="../style/style.css">

		<style>
			h1{
				padding: 30px 15px;
			}
			input{
				width: 40%;
				height: 5%;
				border: 4px;
				border-radius: 5px;
				padding: 10px 15px;
				margin: 10px;
				box-shadow: 1px 1px 1px 1px grey;
			}
			label{
				font-size: 25px;
			}
			.container{
				width: 500px;
				clear: both;
				align-items:center;
			}
			.container input{
				width: 100%;
				clear: both;
			}
		</style>
	</head>
	<body>
		<center>
		<div class="container">
		
			<h1>Update Your Weekly Work Schedule</h1>
				<form action="userUpdateAvailabilty.php" method="POST" >
					<label for="monday">Monday</label>
					<input type="text" name="monday" placeholder="Update Hours"/><br/>
					<label for="tuesday">Tuesday</label>
					<input type="text" name="tuesday" placeholder="Update Hours"/><br/>
					<label for="wednesday">Wednesday</label>
					<input type="text" name="wednesday" placeholder="Update Hours"/><br/>
					<label for="thursday">Thursday</label>
					<input type="text" name="thursday" placeholder="Update Hours"/><br/>
					<label for="friday">Friday  </label>
					<input type="text" name="friday" placeholder="Update Hours"/><br/>
					<label for="saturday">Saturday</label>
					<input type="text" name="saturday" placeholder="Update Hours"/><br/>
					<label for="sunday">Sunday</label>
					<input type="text" name="sunday" placeholder="Update Hours"/><br/>

					<input type="submit" name="update" value="UPDATE SCHEDULE"/>
				</form> 
		</div>
		</center>
	</body>
</html>
