<html>
	<head>
		<title>Company Register</title>
</head>
<h2 align="center">Company Register</h2>
<hr />

<div style="width: 40%; margin: auto;">
<table text-align="right" align="center">
<!-- Not sure if in action, that's the link I add -->
<form name="companyRegister" method="post" action="http://192.168.64.2/capstone-project-mohcamanagement/client/pages/companyRegister.php">

<tr>
<td> Company Name </td>
<td> <input name="companyName" value="" size="20"/></td>
</tr>

<tr>
<td> <label for="companyType">Type of Company</label> </td>
  <td><select id="companyType" name="companyType">
    <option value="nothing">Nothing Selected</option>
    <option value="something1">something</option>
    <option value="something2">something</option>
    <option value="something3">something</option>
  </select></td>
</tr>
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
<td>State</td>
<td> <input type="text" name="state" size="20" maxlength="20" /></td>
</tr>
<tr>
<td>Zip code</td>
<td><input type="text" name="zipCode" size="20" maxlength="20" /> </td>
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
