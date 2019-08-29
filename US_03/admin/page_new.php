


<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
	tinymce.init({ selector:'.editor' });
</script>

<?php

$title = "";
$tag = "";
$category = "";
$content = "";

$etitle = "";
$etag = "";
$ecategory = "";
$econtent = "";

if(isset($_POST['submit']))
{
	$title = $_POST['title'];
	$tag = $_POST['tag'];
	$category = $_POST['category'];
	$content = $_POST['content'];
	
	$er = 0;
	
	if($title == "")
	{
		$er++;
		$etitle = "<span class=\"error\">Required</span>";
	}
	if($tag == "")
	{
		$er++;
		$etag = "<span class=\"error\">Required</span>";
	}
	if($category == "0")
	{
		$er++;
		$ecategory = "<span class=\"error\">Required</span>";
	}
	if($content == "")
	{
		$er++;
		$econtent = "<span class=\"error\">Required</span>";
	}
	
	if($er == 0)
	{
		$sql = "insert into pages(title, tag, userId, categoryId, count) values
		('".ms($title)."', '".ms($tag)."', 1, ".ms($category).", 0)";

		if(mysqli_query($cn, $sql))
		{
			$file = fopen("article/". str_replace(" ", "_", trim(strtolower($title))).".html", "w");
			
			fwrite($file, $content);
			
			print "<span class=\"success\">Data Saved</span>";
			$title = "";
			$tag = "";
			$category = "";
			$content = "";
		}
		else{
			print "<span class=\"error\">".mysqli_error($cn)."</span>";
		}
	}
	
}


?>
<form method="post" action="">

<fieldset>
	<legend>New Page</legend>
	
	<label>Title</label><br>
	<input type="text" name="title" value="<?php print $title; ?>"/><?php print $etitle; ?><br><br>
	
	<label>Tag</label><br>
	<input type="text" name="tag" value="<?php print $tag; ?>"/><?php print $etag; ?><br><br>


	<label>Category</label><br>
	<select name="category">
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
	
	<label>Content</label><br>
	<textarea name="content" class="editor"><?php print $content; ?></textarea><?php print $econtent; ?><br><br>
	
	<input type="submit" name="submit" value="Submit"/>
	
</fieldset>


</form>