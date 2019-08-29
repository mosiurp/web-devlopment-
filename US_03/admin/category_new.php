<?php

$name = "";
$description = "";
$categoryId = "";

$ename = "";

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$description = $_POST['description'];
	$categoryId = $_POST['categoryId'];
	
	$er = 0;
	if($name == "")
	{
		$er++;
		$ename = "<span class=\"error\">Required</span>";
	}
	
	if($er ==0)
	{
		$sql = "insert into category(name, description, categoryId) 
				values('".ms($name)."', '".ms($description)."', ".ms($categoryId).")";
		if(mysqli_query($cn, $sql))
		{
			print "<span class=\"success\">Data Saved</span>";
			$name = "";
			$description = "";
			$categoryId = "";
		}
		else{
			print "<span class=\"error\">".mysqli_error($cn)."</span>";
		}
	}
}


?>
<form method="post" action="">
<fieldset>
<legend>New Category Page</legend>


	<?php
	Text("name", $name, $ename);
	
	?>

	<label>Description</label><br>
	<textarea name="description"><?php print $description; ?></textarea><br><br>

	<label>Category</label><br>
	<select name="categoryId">
		<option value="0">Select</option>
		<?php
		$sql = "select id, name from category";
		$table = mysqli_query($cn, $sql);
		
		while($row = mysqli_fetch_assoc($table))
		{
			print "<option value=\"".$row["id"]."\">".$row["name"]."</option>";
		}
		
		?>
	</select><br><br>

	<input type="submit" name="submit" value="Submit"/>
	
</fieldset>
</form>