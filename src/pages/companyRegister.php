<?php
	/*Insert Code here*/
	include("../includes/dbConnection.php");

	// Checks the request method so that the error will only show if the request method is POST
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {
		// checking to see if the username info was passed to the page from the form
		if(!empty($_POST["companyName"]) && !empty($_POST["companyType"]) && !empty($_POST["email"]) && !empty($_POST["irsNum"]) && !empty($_POST["phoneNo"]) && !empty($_POST["address"]) && !empty($_POST["city"]) && !empty($_POST["state"]) && !empty($_POST["zipCode"])) {
			
			$companyName = $_POST["companyName"];
			$companyType = $_POST["companyType"];
			$email = $_POST["email"];
			$irsNum = $_POST["irsNum"];
			$phoneNo = $_POST["phoneNo"];
			$address = $_POST["address"];
			$city = $_POST["city"];
			$state = $_POST["state"];
			$zipCode = $_POST["zipCode"];

/**************************************************************************************/
			// all of these if-else check the 15 ways the errors could occur
			if(preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $phoneNo) == 0 && preg_match("/^[a-z]+@[a-z]+\.(com|org|gov)$/i", $email) == 0 && preg_match("/^[0-9]{2}\-[0-9]{7}$/", $irsNum) == 0 && preg_match("/^[0-9]{5}$/", $zipCode) == 0) {
				echo "<script>alert('Error phone number must follow format \"xxx-xxx-xxxx\". Email must be valid format. IRS Number must follow format \"xx-xxxxxxx\". Zip code must follow format \"xxxxx\".')</script>";
			}

			elseif(preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $phoneNo) == 0 && preg_match("/^[a-z]+@[a-z]+\.(com|org|gov)$/i", $email) == 0 && preg_match("/^[0-9]{2}\-[0-9]{7}$/", $irsNum) == 0) {
				echo "<script>alert('Error phone number must follow format \"xxx-xxx-xxxx\". Email must be valid format. IRS Number must follow format \"xx-xxxxxxx\".')</script>";
			}

			elseif(preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $phoneNo) == 0 && preg_match("/^[a-z]+@[a-z]+\.(com|org|gov)$/i", $email) == 0 && preg_match("/^[0-9]{5}$/", $zipCode) == 0) {
				echo "<script>alert('Error phone number must follow format \"xxx-xxx-xxxx\". Email must be valid format. Zip code must follow format \"xxxxx\".')</script>";
			}

			elseif(preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $phoneNo) == 0 && preg_match("/^[0-9]{2}\-[0-9]{7}$/", $irsNum) == 0 && preg_match("/^[0-9]{5}$/", $zipCode) == 0) {
				echo "<script>alert('Error phone number must follow format \"xxx-xxx-xxxx\". IRS Number must follow format \"xx-xxxxxxx\". Zip code must follow format \"xxxxx\".')</script>";
			}

			elseif(preg_match("/^[a-z]+@[a-z]+\.(com|org|gov)$/i", $email) == 0 && preg_match("/^[0-9]{2}\-[0-9]{7}$/", $irsNum) == 0 && preg_match("/^[0-9]{5}$/", $zipCode) == 0) {
				echo "<script>alert('Error email must be valid format. IRS Number must follow format \"xx-xxxxxxx\". Zip code must follow format \"xxxxx\".')</script>";
			}

			elseif(preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $phoneNo) == 0 && preg_match("/^[a-z]+@[a-z]+\.(com|org|gov)$/i", $email) == 0) {
				echo "<script>alert('Error phone number must follow format \"xxx-xxx-xxxx\". Email must be valid format.')</script>";
			}

			elseif(preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $phoneNo) == 0 && preg_match("/^[0-9]{5}$/", $zipCode) == 0) {
				echo "<script>alert('Error phone number must follow format \"xxx-xxx-xxxx\". Zip code must follow format \"xxxxx\".')</script>";
			}

			elseif(preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $phoneNo) == 0 && preg_match("/^[0-9]{2}\-[0-9]{7}$/", $irsNum) == 0) {
				echo "<script>alert('Error phone number must follow format \"xxx-xxx-xxxx\". IRS Number must follow format \"xx-xxxxxxx\".')</script>";
			}

			elseif(preg_match("/^[a-z]+@[a-z]+\.(com|org|gov)$/i", $email) == 0 && preg_match("/^[0-9]{2}\-[0-9]{7}$/", $irsNum) == 0) {
				echo "<script>alert('Error email must be valid format. IRS Number must follow format \"xx-xxxxxxx\".')</script>";
			}

			elseif(preg_match("/^[a-z]+@[a-z]+\.(com|org|gov)$/i", $email) == 0 &&  preg_match("/^[0-9]{5}$/", $zipCode) == 0) {
				echo "<script>alert('Error email must be valid format. Zip code must follow format \"xxxxx\".')</script>";
			}

			elseif(preg_match("/^[0-9]{2}\-[0-9]{7}$/", $irsNum) == 0 && preg_match("/^[0-9]{5}$/", $zipCode) == 0) {
				echo "<script>alert('Error IRS Number must follow format \"xx-xxxxxxx\". Zip code must follow format \"xxxxx\".')</script>";
			}

			elseif(preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $phoneNo) == 0) {
				echo "<script>alert('Error phone number must follow format \"xxx-xxx-xxxx\"')</script>";
			}

			elseif (preg_match("/^[a-z]+@[a-z]+\.(com|org|gov)$/i", $email) == 0) {
				echo "<script>alert('Error must be valid email format.')</script>";
			}

			elseif (preg_match("/^[0-9]{2}\-[0-9]{7}$/", $irsNum) == 0) {
				echo "<script>alert('Error IRS Number must follow format \"xx-xxxxxxx\"')</script>";
			}

			elseif (preg_match("/^[0-9]{5}$/", $zipCode) == 0) {
				echo "<script>alert('Error zip code must follow format \"xxxxx\"')</script>";
			}

			else {
				setcookie("companyName", $companyName);
				setcookie("companyType", $companyType);
				setcookie("email", $email);
				setcookie("irsNum", $irsNum);
				setcookie("phoneNo", $phoneNo);
				setcookie("address", $address);
				setcookie("city", $city);
				setcookie("state", $state);
				setcookie("zipCode", $zipCode);

				// header() changes the page to the location listed
				header("Location: adminCreation.php");
			}
/**************************************************************************************/
		}
		else {
			echo "<script>alert('Error all values need to be entered')</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Company Register</title>
  		
		<link rel="stylesheet" href="../style/style.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="../style/style3.css?<?php echo time(); ?>">
	</head>

	<body class="forms">
		<form name="companyRegister" style="margin-top: 2%;" method="post" action="companyRegister.php">
  		<div>
    		<label for="companyName"><b>Company Name</b></label>
			<input type="text" name="companyName" value="" size="20" maxlength="25" placeholder="Company Name"/>
	
			<select name="companyType" style="width: 180px;">
						    <option selected disabled>Type of Company</option>
						    <option value="sole">Sole Proprietorship</option>
						    <option value="partnership">Partnership</option>
						    <option value="corporation">Corporation</option>
						    <option value="llc">LLC</option>
			</select>
			<br>

			<label for="email"><b>Company E-mail Address</b></label>
			<input type="text" name="email" size="20" maxlength="25" placeholder="Company E-mail Address"/>

			<label for="irsNum"><b>IRS Number</b></label>
			<input type="text" name="irsNum" size="20" maxlength="25" placeholder="12-1234567"/>

			<label for="phoneNo"><b>Phone Number</b></label>
			<input type="text" name="phoneNo" size="20" maxlength="20" placeholder="313-123-4567"/>

			<label for="address"><b>Address</b></label>
			<input type="text" name="address" value="" size="20" maxlength="20" placeholder="Address"/>

			<label for="city"><b>City</b></label>
			<input type="text" name="city" size="20" maxlength="20" placeholder="City"/> 

			<select name="state" style="width: 153px;">
						  	<option selected disabled>State</option>
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="DC">District Of Columbia</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
						</select> <br><br>

			<label for="zipcode"><b>Zip Code</b></label>
			<input type="text" name="zipCode" size="20" maxlength="20" placeholder="12345"/>

			<label for="city"><b>City</b></label>
			<input  type="text" name="city" size="20" maxlength="20" placeholder="City"/> 

        
			<input type="submit" name="submit"/>

  		</div>
		</form>

		<form method="post" action="login.php">
			<div class="container" style="background-color:#f1f1f1">
				<button type="Submit" name="Submit" value="Back" style="background-color: #343131;  color: #969595;">Back</button>
			</div>		
		</form>
		
	</body>
</html>
