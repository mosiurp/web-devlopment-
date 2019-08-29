<a href="?p=page_new">New Page</a><br><hr><br>

<?php
$sql = "select p.id, p.title, p.tag, p.createDate, p.userId, c.name as category, p.count
from pages as p left join category c on p.categoryId = c.id";


$table = mysqli_query($cn, $sql);

print "<table>";
print "<tr><th>Title <br> Tag <br> Category</th><th>CreateDate <br> Count<br> User</th><th>Content</th></tr>";
while($row = mysqli_fetch_assoc($table))
{
	print "<tr>";
	print "<td>".htmlentities($row["title"])."<br>".htmlentities($row["tag"])."<br>".htmlentities($row["category"])."</td>";
	print "<td>".htmlentities($row["createDate"])."<br>".htmlentities($row["count"])."<br>".htmlentities($row["userId"])."</td>";
	
	$fileName = "article/".str_replace(" ", "_", trim(strtolower(htmlentities($row["title"])))).".html";
	
	$file = fopen($fileName, "r");
	
	$content = fread($file, filesize($fileName));
	
	print "<td>". substr(strip_tags($content), 0, 200)."</td>";
	print "</tr>";
}
print "</table>";
		
?>