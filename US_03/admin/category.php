<a href="?p=category_new">New Category</a><br><hr><br>

<?php
$sql = "select c1.id, c1.name, c1.description, c2.name category
from category c1 left join category c2 on c1.categoryId = c2.id";


$table = mysqli_query($cn, $sql);

print "<table class=\"table-responsive\">";
print "<tr><th>Id</th><th>Name</th><th>Description</th><th>Category</th><th>Pages</th></tr>";
while($row = mysqli_fetch_assoc($table))
{
	print "<tr>";
	print "<td>".$row["id"]."</td>";
	print "<td>".htmlentities($row["name"])."</td>";
	print "<td>".htmlentities($row["category"])."</td>";
	print '<td>'.htmlentities($row["description"]).'</td>';
	print "<td>".findCount($row["id"])."</td>";
	print "</tr>";
}
print "</table>";


function findCount($pid)
{
	global $cn;
	$a[] = $pid;
	
	countChild($pid, $a);
	
	$sql = "select count(id) as count from pages where categoryId in(".implode(", ", $a).")";
	$table = mysqli_query($cn, $sql);
	while($row = mysqli_fetch_assoc($table))
	{
		return $row["count"];
	}
}

function countChild($pid, &$a)
{
	global $cn;
	
	$sql = "select id from category where categoryId = ".$pid;
	$table = mysqli_query($cn, $sql);
	while($row = mysqli_fetch_assoc($table))
	{
		$a[] = $row["id"];
		countChild($row["id"], $a);
	}
	
}

?>
