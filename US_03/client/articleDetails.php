<?php
$cn = mysqli_connect("localhost", "root", "", "dbcms38");

$sql = "select p.id, p.title, p.tag, p.createDate, p.userId, c.name as category, p.count 
from pages as p left join category c on p.categoryId = c.id where p.id = ".$_GET['id'];

if(isset($_GET['ctg']))
{
	$sql .= " where p.categoryId = ".$_GET['ctg'];
}

$table = mysqli_query($cn, $sql);

while($row = mysqli_fetch_assoc($table))
{
	print "<div class=\"article\">";
	print "<h2>".$row["title"]."</h2>";
	print "<h3>".$row["userId"]." in <b>".$row["category"]."</b> on <i>".$row["createDate"]."</i></h3>";
	
	$fileName = "article/".str_replace(" ", "_", trim(strtolower( $row["title"]))).".html";
	
	$file = fopen($fileName, "r");
	
	$content = fread($file, filesize($fileName));
	
	print "<div>".$content."</div>";
}

$comments = "";
$ecomments = "";
if(isset($_POST['submit']))
{
	$comments = $_POST['comments'];
	$er = 0;
	if($comments == "")
	{
		$er++;
		$ecomments = "Required";
	}
	
	if($er == 0)
	{
		$sql = "insert into comments(pageId, dateTime, userId, comments) values(".$_GET['id'].", '".date("Y-m-d")."', ".$_SESSION['id'].", '".$comments."')";
		if(mysqli_query($cn, $sql))
		{
			print "You just commented";
			$comments = "";
		}
		else{
			print mysqli_error($cn);
		}
	}
}

if(isset($_SESSION['type']))
{
	print '<form method="post" action="">
	<fieldset>
		<legend>
			comments section
		</legend>
		<textarea name="comments">'.$comments.'</textarea>'.$ecomments.'<input type="submit" name="submit" value="Submit"/>
	</fieldset>
</form>';
}


$sql = "select c.dateTime, c.comments, u.name as user from comments as c left join users as u on c.userId = u.id where c.pageId = ".$_GET['id'];
$table = mysqli_query($cn, $sql);
while($row = mysqli_fetch_assoc($table))
{
	print "<div>";
	print "<span>User : ".$row["user"].", DateTime : ".$row["dateTime"]."</span>";
	print "<p>".$row["comments"]."</p>";
	print "</div>";
}

?>




