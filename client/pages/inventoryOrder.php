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
		return "&lt;Distributor Name>";
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
				echo "<tr><td style='text-align:center;'>".$row["Item"]."</td>";
				if($_POST[$row['Item']] == null){
					echo "<td style='text-align:center;'>".$row['Par']."</td></tr>";
				}
				else
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

		<link rel="stylesheet" type="text/css" href="../style/style.css">
	</head>

	<body>
		<h1><?php echo getUserName(); ?></h1>
		<table class="userCreationTable">
			<tr>
				<th>Item</th>
				<th>Quantity to Order</th>
			</tr>
			<?php
				generateTableData();
			?>
			<tr>
				<td colspan="3" style="text-align: center;">
					<button type="button" onclick="location.href='adminMain.php'" style='background-color: #343131;  color: #969595;'>Back</button>
				</td>
			</tr>
		</table>

		

	</body>
</html>