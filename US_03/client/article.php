<?php
$cn = mysqli_connect("localhost", "root", "", "dbcms38");

if(isset($_GET['ctg']))
{
	$sql = "select name from category where id = ".$_GET['ctg'];
	$table = mysqli_query($cn, $sql);
	while($row = mysqli_fetch_assoc($table))
	{
		print '<h1>'.$row["name"].'</h1>';
	}
}


$sql = "select p.id, p.title, p.tag, p.createDate, p.userId, c.name as category, p.count 
from pages as p left join category c on p.categoryId = c.id";

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
	
	print "<div>".substr(strip_tags($content), 0, 400)."......<br><a href=\"?c=articleDetails&id=".$row["id"]."\">Read More</a></div>";
	print "</div>";
}		
?>