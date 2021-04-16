<?php
	/*Insert Code here*/

	// checking to see if the user is allowed to be on the page.
	if(isset($_COOKIE["Username"])) {
		// if not empty then we store the cookie into a variable
		$userCookie = $_COOKIE["Username"];
		$conn = getInclude();
		$query = "SELECT * FROM Users WHERE Username = '$userCookie'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$isManagerCheck = $row['IsManager'];

		if($isManagerCheck == 0) {
			header("Location: userMain.php");
		}
	}

	function getInclude() {
		$dbHost = "localhost";
		$dbUser = "root";
		$dbPass = "";
		$db = "Overseer";

		return mysqli_connect($dbHost, $dbUser, $dbPass, $db);
	}

	function getInventoryName() {
	if(isset($_COOKIE['inventoryType'])) {
		if($_COOKIE['inventoryType'] != 'all') {
			$inventoryType = str_replace("_", " ", $_COOKIE['inventoryType']);
		}
		else 
			$inventoryType = 'All';
	}	
		return $inventoryType;
	}

	function generateTableData() {
		$conn = getInclude();
		if($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		if(isset($_COOKIE['inventoryType'])) {
			if($_COOKIE['inventoryType'] != 'all') {
				$inventoryType = $_COOKIE['inventoryType'];
				$sql = "SELECT * FROM Items WHERE Type='$inventoryType'";
			}
			else {
				$sql = "SELECT * FROM Items";
			}
		}

		
		$result = $conn->query($sql);

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr><td style='text-align:center;'>".str_replace("_", " ", $row["ItemName"])."</td>";
				$temp = $_POST[$row["ItemName"]];
				$itemName=$row["ItemName"];
				
				$query="UPDATE Items SET OnHand= $temp WHERE ItemName='$itemName'";
				mysqli_query($conn, $query);

				if($_POST[$row['ItemName']] == null) {
					echo "<td style='text-align:center;'>".$row['Par']."</td></tr>";
				}
				else
					$orderCalc = $row["Par"] - $temp;
					if($orderCalc < 0)
						echo "<td style='text-align:center;'>0</td></tr>";
					else
						echo "<td style='text-align:center;'>".($row["Par"] - $temp)."</td></tr>";
			}
		}
		else {
			echo "<script>alert('Error!')</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Page Title</title>
			<link rel="stylesheet" href="../style/style1.css?<?php echo time(); ?>">
       		 <link rel="stylesheet" href="../style/tables.css?<?php echo time(); ?>">
       		 <link rel="stylesheet" href="../style/style4.css?<?php echo time(); ?>">
       		 <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
	</head>

	<body class="image-three">
	
		<div class="wrapper">
        <div class="content inside-table">
	
		<h1 style="text-align: center;" ><?php echo getInventoryName(); ?></h1>
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
					<button type="button" onclick="location.href='inventoryLog.php'" style='background-color: #343131;  color: #969595;'>Back</button>
				</td>
			</tr>
		</table>
		</div>
		</div>
	</body>
</html>