<?php
	/*Insert Code here*/

	function getInclude(){
		$dbHost = "localhost";
		$dbUser = "root";
		$dbPass = "";
		$db = "Overseer";

		return mysqli_connect($dbHost, $dbUser, $dbPass, $db);
	}

	function generateTableData(){
		$conn = getInclude();
		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM Inventory";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo "<tr><td>".$row["Item"]."</td><td>".$row["Par"]."</td>";
				echo "<td><input type=\"text\" id=\"".$row["Item"]."\" name=\"".$row["Item"]."\"></td></tr>";
			}
		}
		else{
			echo "Error!";
		}
	}

	function generateOptions(){
		return;
	}
?>




<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Page Title</title>
	</head>
<body>
	<form action="inventory.php">
		<select name="inventory" id="inventory">
			<option value="type">Inventory Type</option>
			<?php
				generateOptions();
			?>
		</select>
	</form>
	<table>
		<tr>
			<th>Item</th>
			<th>Par</th>
			<th>Quantity on Hand</th>
		</tr>
		<?php
			generateTableData();
		?>
	</table>
	
	
	
	<style>
.button {
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button1 {background-color: #c29c9b;} /* Green */
.button2 {background-color: #a88f8f;} /* Blue */
.button1 {border-radius: 50%;}
.button2 {border-radius: 50%;}
</style>
</head>
<body>

<button class="button button1">Add Item</button>
<button class="button button2">Submit</button>

</body>

</html>


<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 2px solid black;
}
</style>
</head>
<body>


</body>
</html>






</html>