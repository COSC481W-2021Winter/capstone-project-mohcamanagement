<?php
	/*db connection needed if in seperate file */
	include_once ('../includes/dbConnection.php');
	// $conn is the conection to database
?>
 <html>
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
 </head>
 <body>
	<h1>Request Off</h1>
	<table class="center">
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
		<form method="post" onsubmit="myFunction()">
		<tr>
			<td>Start Date</td>
		</tr>
		<tr>
		<td><input type="date" value="<?php echo date('Y-m-d');?>"></td>
		</tr>
		<tr><td>End Date</td></tr>
		<tr>
		<td><input type="date" value="<?php echo date('Y-m-d');?>"></td>
		</tr>
			<tr>
			<td><input type="Submit" name="Submit" value="Submit"></input></td>
			</tr>
			</table>
		</form>

	<form method="post" action="adminMain.php">
			<input type="Submit" name="Submit" value="Back"></input>
	</form>
	<script>
	function myFunction(){
		window.alert("Manager has been notified");
		//TODO redirect to a page when submitted
		// window.location="adminMain.php";
	}
	</script>
 </body>
 </html>
