
<?php

$name = "";
$contact = "";
$email = "";
$address = "";
$city = "";

$ename = "";
$econtact = "";
$eemail = "";
$eaddress = "";
$ecity = "";


if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	
	
	$er = 0;
	if($name == "")
	{
		$er++;
		$ename = "<img src=\"images/warning.png\" height=\"20\" title=\"Required Field\"/>";
	}
	if($email == "")
	{
		$er++;
		$eemail = "<span class=\"error\">Required</span>";
	}
	if($contact == "")
	{
		$er++;
		$econtact = "<span class=\"error\">Required</span>";
	}
	if($address == "")
	{
		
	}
	else if(strlen($address) < 10)
	{
		$er++;
		$eaddress = "<span class=\"error\">Must Contain 10 Character or More</span>";
	}
	
	if($city == "0")
	{
		$er++;
		$ecity = "<span class=\"error\">Select</span>";
	}
	
	if($er == 0)
	{
		print "<span class=\"success\">Data Saved</span>";
		$name = "";
		$contact = "";
		$email = "";
		$address = "";
		$city = "";
	}
	else
	{
		
	}
}
?>

<form method="post" action="">
<label>Name</label><br>
<input type="text" name="name" value="<?php print $name; ?>" /><?php print $ename; ?><br><br>


<label>Contact</label><br>
<input type="text" name="contact" value="<?php print $contact; ?>"/><?php print $econtact; ?><br><br>

<label>Email</label><br>
<input type="text" name="email" value="<?php print $email; ?>"/><?php print $eemail; ?><br><br>

<label>Address</label><br>
<textarea name="address"><?php print $address; ?></textarea><?php print $eaddress; ?><br><br>

<label>City</label><br>
<select name="city">
	<option value="0">Select</option>
	<option value="1">Dhaka</option>
	<option value="2">Rangpur</option>
</select><?php print $ecity; ?><br><br>

<input type="submit" name="submit" value="Submit"/>


</form>


