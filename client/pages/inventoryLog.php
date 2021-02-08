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
	<button type="button" onclick="">Add Item</button>
	<button type="button" onclick="">Submit</button>

</body>
</html>