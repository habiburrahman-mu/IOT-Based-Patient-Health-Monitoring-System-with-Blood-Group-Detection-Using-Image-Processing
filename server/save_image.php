<?php
	$info = pathinfo($_FILES['image']['name']);
	$ext = $info['extension']; //get extension
	$newname = 'new_image.'.$ext; //new name of image
	$target = 'images/'.$newname; 
	move_uploaded_file($_FILES['image']['tmp_name'], $target);
?>