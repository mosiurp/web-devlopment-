<?php

$name = "";
$email = "";
$password = "";
$passwordReType = "";

$ename = "";
$eemail = "";
$epassword = "";
$epasswordReType = "";

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordReType = $_POST['passwordReType'];
	
	$er = 0;
	
	if($name == "")
	{
		$er++;
		$ename = '<span class="error">Required</span>';
	}
	if($email == "")
	{
		$er++;
		$eemail = '<span class="error">Required</span>';
	}
	if($password == "")
	{
		$er++;
		$epassword = '<span class="error">Required</span>';
	}
	
	if($passwordReType == "")
	{
		$er++;
		$epasswordReType = '<span class="error">Required</span>';
	}
	else if($password != $passwordReType)
	{
		$er++;
		$epasswordReType = '<span class="error">Does Not Match</span>';
	}
	
	if($er == 0)
	{
		$cn = mysqli_connect("localhost", "root", "", "dbcms38");
		$sql = "insert into users(name, email, password, createIP, type) 
				values('$name', '$email', password('$password'), '".$_SERVER['REMOTE_ADDR']."', 'A')";
		if(mysqli_query($cn, $sql))
		{
			
			$message = "You have recently register to our system. please click the following link to verify your email address<br>";
			
			$message .= '<a href="http://localhost/US_03/?c=activate&id='.mysqli_insert_id($cn).'">http://localhost/US_03/?c=activate&id='.mysqli_insert_id($cn).'</a>';
			
			print $message;
				
			//mail($email, 'Varification Mail', $message);
			
			print "<span class=\"success\">Data Saved</span>";
			$name = "";
			$email = "";
			$password = "";
			$passwordReType = "";
		}
		else{
			print "<span class=\"error\">".mysqli_error($cn)."</span>";
		}
	}
}

?>
<form method="post" action="">

<label>Name</label><br>
<input type="text" name="name" value="<?php print $name; ?>"/><?php print $ename; ?><br><br>

<label>Email</label><br>
<input type="text" name="email" value="<?php print $email; ?>"/><?php print $eemail; ?><br><br>

<label>Password</label><br>
<input type="password" name="password" value=""/><?php print $epassword; ?><br><br>

<label>Retype Password</label><br>
<input type="password" name="passwordReType" value=""/><?php print $epasswordReType; ?><br><br>

<input type="submit" name="submit" value="Submit"/>

</form>