<?php
	/*Insert Code here*/

	function getInclude(){
		$dbHost = "localhost";
		$dbUser = "root";
		$dbPass = "";
		$db = "Overseer";

		return mysqli_connect($dbHost, $dbUser, $dbPass, $db);
	}

	function generateTableHeader(){
		echo "	<tr>
					<th>Item</th>
					<th>Par</th>
					<th>On Hand</th>
				<tr>";
	}

	function generateTableData(){
		$conn = getInclude();
		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT * FROM inventory";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo "<tr><td>".$row["Item"]."</td><td>".$row["Par"]."</td>";
			}
		}
		else{
			echo "Error!";
		}
	}

	function generateTable(){
		getInclude();
		echo "<table>";
		generateTableHeader();
		generateTableData();
		echo "</table>";
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Page Title</title>
	</head>
<body>

	<?php
		generateTable();
	?>

</body>
</html>