<?php
	/*Insert Code here*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login Page</title>

		<link rel="stylesheet" type="text/css" href="../style/style.css">
	</head>
	<body>
		<table class="userCreationTable">
			<form method="post" action="userCheck.php">
				<tr>
					<td style="padding: 2px;">
						<input type="text" name="Username" placeholder="Enter Username" class="inputBox"></input>
					</td>

					<td class="required">
						<span>*</span>
					</td>
				</tr>

				<tr>
					<td style="padding: 2px;">
						<input type="text" name="Pin" placeholder="Enter Pin" class="inputBox"></input>
					</td>

					<td class="required">
						<span>*</span>
					</td>
				</tr>

				<tr>
					<td style="text-align: center; padding: 2px;">
						<input type="Submit" name="Submit" style="background-color: #343131;  color: #969595;"></input>
					</td>
				</tr>
			</form>

			<form method="post" action="../index.html">
				<tr>
					<td style="text-align: center; padding: 2px;">
						<input type="Submit" name="Submit" value="Back" style="background-color: #343131;  color: #969595;"></input>
					</td>
				</tr>
			</form>
		</table>
	</body>
</html>