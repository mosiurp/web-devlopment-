<?php
session_start();
$cn = mysqli_connect("localhost", "root", "", "dbcms38");

function ms($value)
{
	global $cn;
	return mysqli_real_escape_string($cn, strip_tags($value));
}


include('component/HTMLHelper.php');

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>My Sweet Web based software</title>
<link rel="stylesheet" href="css/myStyle.css"/>
<link rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>
<?php

if(isset($_GET['c']) && $_GET['c'] == "logout" )
{
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	unset($_SESSION['email']);
	unset($_SESSION['type']);
}
	
$email = "";
$password = "";

$eemail = "";
$epassword = "";

if(isset($_POST['btnLogin']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$er = 0;
	
	if($email == "")
	{
		$er++;
		$eemail = "<span class=\"error\">Required</span>";
	}
	
	if($password == "")
	{
		$er++;
		$epassword = "<span class=\"error\">Required</span>";
	}
	
	if($er == 0)
	{
		$cn = mysqli_connect("localhost", "root", "", "dbcms38");
		$sql = "select id, name, email from users where email = '".mysqli_real_escape_string($cn, strip_tags($email))."' and password = password('".mysqli_real_escape_string($cn, strip_tags($password))."')";
		
		$table = mysqli_query($cn, $sql);
		if(mysqli_num_rows($table) > 0)
		{
			
			while($row = mysqli_fetch_assoc($table))
			{
				$sql = "select * from usersActive where userId = ".$row["id"];
				$table2 = mysqli_query($cn, $sql);
				if(mysqli_num_rows($table2))
				{
					$_SESSION['id'] = $row["id"];
					$_SESSION['name'] = $row["name"];
					$_SESSION['email'] = $row["email"];
					$_SESSION['type'] = "A";
				}
				else{
					$_SESSION['active'] = "You have not active your account yet, please active your account first";
				}
				//print '<span class="success">Login was successfull</span>';
				break;
			}
		}
	}
	
}
	
?>


<div class="header">
	Header
</div>
<div class="main">
	<div class="menu">
		<?php include('component/menu.php'); ?>
	</div>
	<div class="content">
		<?php
		
		include('component/controller.php');
		
		?>
	</div>
</div>
<div class="footer">
	Footer
</div>

</body>
</html>