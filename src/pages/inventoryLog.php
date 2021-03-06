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
				echo "<tr><td style='text-align:center;'>".$row["Item"]."</td><td style='text-align:center;'>".$row["Par"]."</td>";
				echo "<td style='text-align:center;'><input type=\"number\" id=\"".$row["Item"]."\" name=\"".$row["Item"]."\"></td></tr>";
			}
		}
		else{
			echo "Error!";
		}
	}

	// Add types in drop-down menu 
	function generateOptions(){
		$conn = getInclude();
		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM InventoryType";
		$result = $conn->query($sql);

		// For now, has the last Type as the default value
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['Type'].'"selected>'.$row['Type'].'</option>';
		 }
		 
		 echo '</select>';
	
		return;
	}

	function addItemToTable($itemEntry, $expectedPar){
		$conn = getInclude();

		$query = "INSERT INTO Inventory Values('$itemEntry', $expectedPar, 0)";
		mysqli_query($conn, $query);
	}

	if(isset($_POST["expectedPar"]) && isset($_POST["itemEntry"])) {
		$itemEntry = $_POST["itemEntry"];
		$expectedPar = $_POST['expectedPar'];
		addItemToTable($itemEntry, $expectedPar);
	}

	// Add new types
	function addInventoryTypeToTable($Type, $Name){
        $conn = getInclude();

        $query = "INSERT INTO InventoryType VALUES('$Type', '$Name')"; 
        mysqli_query($conn, $query);
    }

    if(isset($_POST["Type"]) && isset($_POST["Name"])) {
        $Type = $_POST["Type"];
        $Name = $_POST["Name"];
        addInventoryTypeToTable($Type, $Name);
    }

	
?>

<!-- <script>
	function addItemToTable(itemName, itemPar){

		var table = document.getElementById("itemTable");
		var row = table.insertRow(table.rows.length);

		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);

		cell1.innerHTML = itemName;
		cell2.innerHTML = itemPar;
		cell3.innerHTML = "<input type=\"number\" id=\""+itemName+"\" name=\""+itemName+"\">";
	}

	function setItemEntry(){
		var itemName = document.getElementById("itemEntry").value;
		var itemPar = document.getElementById("expectedPar").value;
		addItemToTable(itemName, itemPar);
	}
</script> -->




<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Page Title</title>

		<link rel="stylesheet" type="text/css" href="../style/style.css">

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
		<table id="itemTable" class="userCreationTable">
			<tr>
				<td colspan="3" style="text-align: center;">
					<select name="Type" id="Type">
						<option selected disabled>Inventory Type</option>
						<!-- <option value="FOH" selected>Front of House</option>  Default option. -->
						<!-- <option value="Kitchen">Kitchen</option> -->
						<!-- <option value="Coffee">Coffee</option> -->
						<?php
							generateOptions();
						?>
					</select>
				</td>
			</tr>

			<form action="inventoryOrder.php" method="post"	>
					<tr>
						<th>Item</th>
						<th>Par</th>
						<th>Quantity on Hand</th>
					</tr>
					<?php
						generateTableData();
					?>
				<tr>
					<td colspan="3" style="text-align: center;">
						<input type="submit" style="background-color: #343131;  color: #969595;">
					</td>
				</tr>
			</form>

		<form method="post" action="inventoryLog.php">
			<tr>
				<td style="padding-top: 40px;">
					<input type="text" id="itemEntry" name="itemEntry" placeholder="Item Name"/>
				</td>

				<td style="padding-top: 40px;">
					<label for="expectedPar">Item Par</label>
				</td>

				<td style="padding-top: 40px;">
					<input type="number" id="expectedPar" name="expectedPar" value=1 min=1 max=99/>
				</td>
				
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;">
					<input type="submit" value="Add Item" style='background-color: #343131;  color: #969595;'/>
				</td>
			</tr>
		</form>

		<!-- Add Inventory Type -->	
		<form method="post" action="inventoryLog.php">
			<tr>
				<td style="padding-top: 10px;">
					<input type="text" id="Type" name="Type" placeholder="Inventory Type"/>	
				</td>
				<td style="padding-top: 10px;">
					<input type="text" id="Name" name="Name" placeholder="Company Name"/>
				</td>
				<td style="padding-top: 10px;" colspan="3" style="text-align: center;">
					<input type="submit" value="Add Type" style='background-color: #343131;  color: #969595;'/>
				</td>
			</tr>
		</form>

			<!-- Back Button -->	
			<tr>
				<td colspan="3" style="text-align: center;">
					<form method="post" action="/capstone-project-mohcamanagement/src/pages/adminMain.php">
					<button type="button" style='background-color: #343131;  color: #969595;'>Back</button>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>