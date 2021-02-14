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
				echo "<td><input type=\"number\" id=\"".$row["Item"]."\" name=\"".$row["Item"]."\"></td></tr>";
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

<script>
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
</script>




<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Page Title</title>
	</head>
<body>
	
	<select name="inventory" id="inventory">
		<option value="type">Inventory Type</option>
		<?php
			generateOptions();
		?>
	</select>
	

	<form action="inventoryOrder.php" method="post"	>
		<table id="itemTable">
			<thead>
				<tr>
					<th>Item</th>
					<th>Par</th>
					<th>Quantity on Hand</th>
				</tr>
			</thead>
			<tbody>
				<?php
					generateTableData();
				?>
			</tbody>
		</table>
		<input type="submit" class="button button2">
	</form>
	
	
	
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

<label for="itemEntry">Item Name</label>
<input type="text" id="itemEntry" name="itemEntry">
<label for="expectedPar">Item Par</label>
<input type="number" id="expectedPar" name="expectedPar" value=1 min=1 max=99>
<button class="button button1" onclick="setItemEntry();">Add Item</button>

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