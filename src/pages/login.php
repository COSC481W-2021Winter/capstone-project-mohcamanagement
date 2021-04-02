<?php
	/*Insert Code here*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="../style/style2.css">
		<link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">
		
	</head>

	<body class="login">	
	<form style="margin-top: 5%;" method="post" action="userCheck.php">
		<div class="imgcontainer">
    		<img src="../images/avatar.png" alt="Avatar" class="avatar">
  		</div>

  		<div class="container">
    		<label for="username"><b>Username</b></label>
			<input type="text" name="Username" placeholder="Enter Username" required/>

    		<label for="pin"><b>Pin</b></label>
			<input type="text" name="Pin" placeholder="Enter Pin" required/>
        
			<Button type="Submit" name="Submit">Login</Button>
  		</div>

  		<div class="container" style="background-color:#f1f1f1">
    		<button type="button" class="cancelbtn">Cancel</button>
			<span class="psw">New <a href="companyRegister.php">company?</a></span>
  		</div>
	</form>
	<form class="back" method="post" action="../index.html">
		  <div class="container" style="background-color:#f1f1f1">
			  <Button type="Submit" name="Submit" value="Back" class="backbtn">Back</Button>
		  </div>
	</form>

		<!-- <table class="userCreationTable">
			<form method="post" action="userCheck.php">
				<tr>
					<td style="padding: 2px;">
						<input type="text" name="Username" placeholder="Enter Username" class="inputBox"/>
					</td>

					<td class="required">
						<span>*</span>
					</td>
				</tr>

				<tr>
					<td style="padding: 2px;">
						<input type="text" name="Pin" placeholder="Enter Pin" class="inputBox"/>
					</td>

					<td class="required">
						<span>*</span>
					</td>
				</tr>

				<tr>
					<td style="text-align: center; padding: 2px;">
						<Button type="Submit" name="Submit" style="background-color: #343131;  color: #969595;">Login</Button>
					</td>
				</tr>
			</form> -->

			<!-- <form method="post" action="../index.html">
				<tr>
					<td style="text-align: center; padding: 2px;">
						<Button type="Submit" name="Submit" value="Back" style="background-color: #343131;  color: #969595;">Back</Button>
					</td>
				</tr>
			</form>
		</table> -->
		<div class="footer">
			<p>&#169</p>
		</div>
	</body>
</html>