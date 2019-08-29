<?php


function Text($name, $value, $error)
{
	print '	<div class="form-group">
	<label class="col-md-2">'.ucwords($name).'</label><br>
	<input type="text" name="'.$name.'" class="form-control" value="'.$value.'"/>'.$error.'<br><br>
	</div>';
}


?>