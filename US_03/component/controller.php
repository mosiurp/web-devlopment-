<?php
if(isset($_GET['p']))
{
	if(isset($_SESSION['type']))
	{
			if(file_exists("admin/".$_GET['p'].".php"))
			{
			print '<h2 class="title">'.ucwords(str_replace("_", " ", $_GET['p'])).'</h2>';
			include("admin/".$_GET['p'].".php");
			}
			else{
				print "<h2 class=\"title\">Warning</h2>";
				include("warning.php");
			}
	}
	else{
		print '<h2 class="title">'.ucwords(str_replace("_", " ", $_GET['p'])).'</h2>';
			include("client/login.php");
	}
}
else if(isset($_GET['c']))
{
	if(file_exists("client/".$_GET['c'].".php"))
	{
		if($_GET['c'] == "login" )
		{
			if(isset($_SESSION['active']))
			{
				print $_SESSION['active'];
				include('client/resend.php');
			}
			elseif(isset($_POST['btnLogin']))
			{
				if(isset($_SESSION['type']))
				{
					print "Login Successfull";
				}
				else{
					print "Invalid Login, try again";
					include("client/".$_GET['c'].".php");
				}
			}
			else{
				print '<h2 class="title">'.ucwords(str_replace("_", " ", $_GET['c'])).'</h2>';
				include("client/".$_GET['c'].".php");
			}
		}
		else{
			print '<h2 class="title">'.ucwords(str_replace("_", " ", $_GET['c'])).'</h2>';
			include("client/".$_GET['c'].".php");
		}
	}
	else{
		print "<h2 class=\"title\">Warning</h2>";
		include("warning.php");
		}
}
else{
	include("home.php");
}
?>