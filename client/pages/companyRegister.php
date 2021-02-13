<html>
	<head>
		<title>Company Register</title>
</head>
<h2 align="center">Company Register</h2>
<hr />

<div style="width: 40%; margin: auto;">
<table text-align="right" align="center">
<!-- Not sure if in action, that's the link I add -->
<form name="companyRegister" method="post" action="companyRegister.php">

<tr>
<td> Company Name </td>
<td> <input name="companyName" value="" size="20"/></td>
</tr>

<tr>
<td> <label for="companyType">Type of Company</label> </td>
  <td><select id="companyType" name="companyType" style="width: 153px;">
    <option selected disabled>Nothing Selected</option>
    <option value="sole">Sole Proprietorship</option>
    <option value="partnership">Partnership</option>
    <option value="corporation">Corporation</option>
    <option value="llc">LLC</option>
  </select></td>
</tr>
<tr>
<td>Company E-mail address</td>
<td><input type="text" name="country" size="20" maxlength="25" /></td>
</tr>

<tr>
<td>IRS Number </td>
<td><input type="text" name="irsNum" size="20" maxlength="25" /></td>
</tr>

<tr>
<td> Phone Number </td>
<td><input type="text" name="phoneNo" size="20" maxlength="20" /> </td>
</tr>

<tr>
<td>Address </td>
<td><input type="text" name="address" value="" size="20" maxlength="20" /> </td>
</tr>

<tr>
<td>City</td>
<td> <input type="text" name="city" size="20" maxlength="20" /> </td>
</tr>

<tr>
<td> <label for="state">State</label> </td>
<td>
<select id="state" style="width: 153px;">
  <option selected disabled>Nothing selected</option>
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
<td>Zip code</td>
<td><input type="text" name="zipCode" size="20" maxlength="20" /> </td>
</tr>

<tr>
<td></td> 
<td><input type="submit"></td>
</tr>

</form>
</table>
</div>

<?php
	/*Insert Code here*/
?>


</html>
