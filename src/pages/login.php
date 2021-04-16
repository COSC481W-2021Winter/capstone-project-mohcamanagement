<?php
	date_default_timezone_set("America/New_York");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="../style/style2.css?<?php echo time(); ?>">
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

	<form class="back" method="post" action="../index.php">
		  <div class="container" style="background-color:#f1f1f1">
			  <Button type="Submit" name="Submit" value="Back" class="backbtn" style="background-color: #343131;  color: #969595;">Back</Button>
		  </div>
	</form>
	
	</body>
</html>