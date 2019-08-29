<?php

$name = "";
$email = "";
$password = "";

$ename = "";
$eemail = "";
$epassword = "";

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
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
	
	if($er == 0)
	{
		$sql = "insert into users(name, email, password, createIP, type) 
				values('$name', '$email', password('$password'), '".$_SERVER['REMOTE_ADDR']."', 'A')";
		if(mysqli_query($cn, $sql))
		{
			print "<span class=\"success\">Data Saved</span>";
			$name = "";
			$email = "";
			$password = "";
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

<input type="submit" name="submit" value="Submit"/>

</form>