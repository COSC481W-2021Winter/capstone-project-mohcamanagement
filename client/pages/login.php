<?php
	/*Insert Code here*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login Page</title>
	</head>
	<body>
		<form method="post" action="userCheck.php">
			<input type="text" name="Username" placeholder="Enter Username"></input>
			<input type="text" name="Pin" placeholder="Enter Pin"></input>
			<input type="Submit" name="Submit"></input>
		</form>
		<form method="post" action="../index.html">
			<input type="Submit" name="Submit" value="Back"></input>
		</form>
	</body>
</html>