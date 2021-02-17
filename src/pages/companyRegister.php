<?php
	/*Insert Code here*/
	include("../includes/dbConnection.php");

	// Checks the request method so that the error will only show if the request method is POST
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])){
		// checking to see if the username info was passed to the page from the form
		if(!empty($_POST["companyName"]) && !empty($_POST["companyType"]) && !empty($_POST["email"]) && !empty($_POST["irsNum"]) && !empty($_POST["phoneNo"]) && !empty($_POST["address"]) && !empty($_POST["city"]) && !empty($_POST["state"]) && !empty($_POST["zipCode"])){
			
			$companyName = $_POST["companyName"];
			$companyType = $_POST["companyType"];
			$email = $_POST["email"];
			$irsNum = $_POST["irsNum"];
			$phoneNo = $_POST["phoneNo"];
			$address = $_POST["address"];
			$city = $_POST["city"];
			$state = $_POST["state"];
			$zipCode = $_POST["zipCode"];

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
		else{
			echo "<script>alert('Error all values need to be entered')</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Company Register</title>
  		
  		<link href="../style/style.css" rel="stylesheet">
	</head>

	<body>
		<h2 align="center">Company Register</h2>

		<!-- <div style="width: 40%; margin: auto;"> -->
			<table class="userCreationTable">
			<!-- Action sends to the same page to check the inputs when submit is clicked-->
				<form name="companyRegister" method="post" action="companyRegister.php">
					<tr>
						<td> <input class="inputBox" name="companyName" value="" size="20" placeholder="Company Name"/></td>
					</tr>

					<tr>
						<td><select name="companyType" style="width: 153px;">
						    <option selected disabled>Type of Company</option>
						    <option value="sole">Sole Proprietorship</option>
						    <option value="partnership">Partnership</option>
						    <option value="corporation">Corporation</option>
						    <option value="llc">LLC</option>
					 	</select></td>
					</tr>

					<tr>
						<td><input class="inputBox" type="text" name="email" size="20" maxlength="25" placeholder="Company E-mail Address"/></td>
					</tr>

					<tr>
						<td>
							<input class="inputBox" type="text" name="irsNum" size="20" maxlength="25" placeholder="IRS Number"/>
						</td>
					</tr>

					<tr>
						<td>
							<input class="inputBox" type="text" name="phoneNo" size="20" maxlength="20" placeholder="Phone Number"/> 
						</td>
					</tr>

					<tr>
						<td>
							<input class="inputBox" type="text" name="address" value="" size="20" maxlength="20" placeholder="Adress"/>
						</td>
					</tr>

					<tr>
						<td> 
							<input class="inputBox" type="text" name="city" size="20" maxlength="20" placeholder="City"/> 
						</td>
					</tr>

					<tr>
						<td>
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
							</select>
						</td>
					</tr>

					<tr>
						<td>
							<input class="inputBox" type="text" name="zipCode" size="20" maxlength="20" placeholder="Zip Code"/>
						</td>
					</tr>

					<tr>
						<td colspan="2" style="text-align: center;">
							<input style="background-color: #343131;  color: #969595;" type="submit" name="submit">
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
		<!-- </div> -->
	</body>
</html>
