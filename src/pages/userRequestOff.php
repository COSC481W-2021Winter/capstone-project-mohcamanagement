<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');
	// $conn is the conection to database
	if(isset($_COOKIE["Username"])) {
		// if not empty then we store the cookie into a variable
		$userCookie = $_COOKIE["Username"];
	}

	// TODO finsih connection to database upon table creation for requests off
	if (!empty($_POST['send'])) {
		header('Location: userMain.php');
   		die();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Request Off</title>
	<link rel="stylesheet" href="../style/style.css">
	<style>
		
	.btn {
		border: none;
		background-color: inherit;
		width:100%;
		height:100%;
		cursor: pointer;
		display: inline-block;
		color:white;
	}
	.btn:hover{
		color: black;
		background-color:black;
	}
	table.center {
    margin-left:auto; 
    margin-right:auto;
  }
	</style>
	

	<link rel="stylesheet" type="text/css" href="../style/style.css">

</head>

<body>
	<h1>Request Off <?php echo "$userCookie";?></h1>
	<!-- <h3 style="text-align:center"><?php 
		// echo "$userCookie";
		?></h3> -->
		<br>
	<table class="userCreationTable">
		<?php
		//TODO be changed to whoever is logged in
		$query = "SELECT * FROM Users";
		$result = mysqli_query($conn, $query);
		$numOfRows = mysqli_num_rows($result);
		// for($i = 0; $i<1; $i++) {
			//grabs the current row of data so you can display or manipulate
			$row = mysqli_fetch_assoc($result);
		// }
		?>
		<!-- TODO fix placment of form on screen -->
		<form onsubmit="myFunction()" method="post">
			<tr>
				<td style="text-align: center;">Start Date</td>
			</tr>

			<tr>
				<td><input id="from" type="date" value="<?php echo date('Y-m-d');?>" class="inputBox"></td>
			</tr>

			<tr>
				<td style="text-align: center;">End Date</td>
			</tr>

			<tr>
				<td><input id="until" type="date" value="<?php echo date('Y-m-d');?>" class="inputBox"></td>
			</tr>

			<tr>
				<td style="text-align: center;"><input type="radio" name="type" value="mandatory">&nbsp;Mandatory</input></td>
			</tr>

			<tr>
				<td style="text-align: center;"><input type="radio" name="type" value="optional">&nbsp;Optional</input></td>
			</tr>

			<tr>
				<td style="text-align: center;"><input type="Submit" name="send" value="Submit"></input></td>
			</tr>
		</form>

		<form method="post" action="userMain.php">
			<tr>
				<td style="text-align: center;"><input type="Submit" name="back" value="Back"></input></td>
			</tr>
		</form>
	</table>

	
	<script>
	function myFunction(){
		// alert("Manager has been notified");
		var txtOne = document.getElementById('from').value;
		var txtTwo = document.getElementById('until').value;
		var option= confirm("are the dates correct "+txtOne+" until "+txtTwo);
		if(option==true){
			alert('Manager has been notified');
		}else{

		}
		// window.location='../userMain.php';
		// window.location.replace("userMain.php");
		//TODO redirect to a page when submitted
		// document.location= "userMain.php";
		// window.location="userMain.php";
	}
	</script>
 </body>
 </html>
