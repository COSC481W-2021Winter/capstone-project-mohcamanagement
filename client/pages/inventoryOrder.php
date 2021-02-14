<?php
	/*Insert Code here*/

	function getInclude(){
		$dbHost = "localhost";
		$dbUser = "root";
		$dbPass = "";
		$db = "Overseer";

		return mysqli_connect($dbHost, $dbUser, $dbPass, $db);
	}

	function getUserName(){
		return "Placeholder";
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
				echo "<tr><td>".$row["Item"]."</td>";
				echo "<td>".($row["Par"] - $_POST[$row["Item"]])."</td></tr>";
			}
		}
		else{
			echo "Error!";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Page Title</title>
	</head>
<body>
	<h1><?php echo getUserName(); ?></h1>
	<table>
		<tr>
			<th>Item</th>
			<th>Quantity to Order</th>
		</tr>
		<?php
			generateTableData();
		?>
	</table>

	<button type="button" onclick="location.href='adminMain.php'">Back</button>

</body>
</html>