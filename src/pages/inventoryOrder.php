<?php
	/*Insert Code here*/

	function getInclude() {
		$dbHost = "localhost";
		$dbUser = "root";
		$dbPass = "";
		$db = "Overseer";

		return mysqli_connect($dbHost, $dbUser, $dbPass, $db);
	}
// to update table with the values we have
	$newConn = getInclude();
	$newSql = "SELECT * FROM Items";
	$newResult = $newConn->query($newSql);
	while($row = $newResult->fetch_assoc()) {
		if(isset($_POST[$row["ItemName"]])){
			$number=$_POST[$row["ItemName"]];
			$query = "UPDATE Items SET OnHand=$number WHERE ItemName='".$row['ItemName']."' ";
			mysqli_query($newConn, $query);
		}
	}


// ------------------
	function getUserName() {
		return "&lt;Distributor Name>";
	}

	function generateTableData() {
		$conn = getInclude();
		if($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM Items";
		$result = $conn->query($sql);

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr><td style='text-align:center;'>".$row["ItemName"]."</td>";
				if($row['OnHand'] == 0) {
					echo "<td style='text-align:center;'>".$row['Par']."</td></tr>";
				}
				else{
					echo "<td style='text-align:center;'>".($row["Par"] - $row["OnHand"])."</td>";
				}
				echo "</tr>";
			}
		}
		else {
			echo "<script>alert('Error!')</script>";
		}
	}
	function zeroOut(){
		$newConn = getInclude();
		$newSql = "SELECT * FROM Items";
		$newResult = $newConn->query($newSql);
		while($row = $newResult->fetch_assoc()) {
				$query = "UPDATE Items SET OnHand=0";
				mysqli_query($newConn, $query);
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
		<table class="userCreationTable" id="orderTable">
			<tr>
				<th>Item</th>
				<th>Quantity to Order</th>
			</tr>
			<?php
				generateTableData();
			?>
			<tr>
				<td colspan="3" style="text-align: center;">
					<button type="button" onclick="location.href='adminMain.php';<?php zeroOut();?>" style='background-color: #343131;  color: #969595;'>Back</button>
				</td>
			</tr>
		</table>
	</body>
</html>