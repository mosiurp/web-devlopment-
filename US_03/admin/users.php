<a href="?p=users_new">User New</a><br><hr><br>

<?php
$sql = "select u.id, u.name, u.email, u.createDate, u.createIP, u.type from users as u ";


$table = mysqli_query($cn, $sql);

print "<table>";
print "<tr><th>Name</th><th>Email</th><th>CreateDate</th><th>IP</th><th>Type</th><th>#</th></tr>";
while($row = mysqli_fetch_assoc($table))
{
	print "<tr>";
	print "<td>".$row["name"]."</td>";
	print "<td>".$row["email"]."</td>";
	print "<td>".$row["createDate"]."</td>";
	print "<td>".$row["createIP"]."</td>";
	print "<td>".$row["type"]."</td>";
	print "<td> Edit | Delete </td>";
	print "</tr>";
}
print "</table>";
?>