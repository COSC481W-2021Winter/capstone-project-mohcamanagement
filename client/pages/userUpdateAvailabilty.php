<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User Update Availability</title>
		<link rel="stylesheet" type="text/css" href="../style/style.css">

		<style>
			input{
				width: 40%;
				height: 5%;
				border: 4px;
				border-radius: 5px;
				padding: 10px 15px;
				margin: 10px;
				box-shadow: 1px 1px 1px 1px grey;
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
				<form action="" method="POST" >
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
<?php
	/*Insert Code here*/
	

	// Checks the request method so that the error will only show if the request method is POST
	// if($_SERVER['REQUEST_METHOD'] == 'POST'){
	// 	if(!empty($_POST['Monday']))
	// 		$monday = $_POST['Monday'];

	// 	if(!empty($_POST['Tuesday']))
	// 		$tuesday = $_POST['Tuesday'];

	// 	if(!empty($_POST['Wednesday']))
	// 		$wednesday = $_POST['Wednesday'];
	// 	else
	// 		$wednesday = "Off";

	// 	if(!empty($_POST['Thursday']))
	// 		$thursday = $_POST['Thursday'];
	// 	else
	// 		$thursday = "Off";

	// 	if(!empty($_POST['Friday']))
	// 		$friday = $_POST['Friday'];
	// 	else
	// 		$friday = "Off";

	// 	if(!empty($_POST['Saturday']))
	// 		$saturday = $_POST['Saturday'];
	// 	else
	// 		$saturday = "Off";

	// 	if(!empty($_POST['Sunday']))
	// 		$sunday = $_POST['Sunday'];
	// 	else
	// 		$sunday = "Off";

	include("../includes/dbConnection.php");
	if(isset($_POST['update'])){
		$query = "UPDATE 'Users' SET monday='$_POST[monday], tuesday='$_POST[tuesday], wednesday='$_POST[wednesday], thursday='$_POST[thursday], friday='$_POST[friday], saturday='$_POST[saturday], sunday='$_POST[sunday]";
		$query_run = mysqli_query($conn, $query);

		if($query_run){
			echo '<script type="text/javascript"> alert("Schedule Updated") </script>';
			// header() changes the page to the location listed
			header("Location: userMain.php");
		}else{
			echo '<script type="text/javascript"> alert("Schedule NOT Updated") </script>';
		}
		
	}
?>