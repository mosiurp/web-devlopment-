<ul id="css3menu1" class="topmenu">
	<li><a href="?c=home">Home</a></li>
<?php
$cn = mysqli_connect("localhost", "root", "", "dbcms38");
$sql = "select id, name from category where categoryId = 0";
$table = mysqli_query($cn, $sql);
		
while($row = mysqli_fetch_assoc($table))
{
	print "<li>";
	print "<a href=\"?c=article&ctg=".$row["id"]."\">".$row["name"]."</a>";
	findChild($row["id"]);
	
	print "</li>";
}
	
	
function findChild($pid)
{
	$cn = mysqli_connect("localhost", "root", "", "dbcms38");
	$sql = "select id, name from category where categoryId = ".$pid;
	$table = mysqli_query($cn, $sql);
	
	print "<ul>";
	while($row = mysqli_fetch_assoc($table))
	{
		print "<li>";
		print "<a href=\"?c=article&ctg=".$row["id"]."\">".$row["name"]."</a>";
		findChild($row["id"]);
		print "</li>";
	}
	print "</ul>";
}

	if(isset($_SESSION['type']))
	{
		print '<li><a href="?p=users">Users</a></li>
		<li><a href="?p=category">Category</a></li>
<li><a href="?p=page">Page</a></li>
<li><a href="?p=myaccount">'.$_SESSION['name'].'</a></li>
<li><a href="?c=logout">Logout</a></li>';
	}
	else{
		print '<li>
<li><a href="?c=register">Register</a></li>
<li><a href="?c=login">Login</a></li>';
	}
	
	
?>

</ul>