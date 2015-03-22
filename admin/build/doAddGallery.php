<?php
	include("select_db.php");
	include("picture_path.php");

	$pic = $_FILES['picture']['name'];
	
	if($_FILES['picture']['error'] != 0)
	{
		header("location:gallery.php?errorMsg=Image must be chosen!");
	}
	else if ($_FILES['picture']['type'] != "image/jpg" && $_FILES['picture']['type'] != "image/png" && $_FILES['picture']['type'] != "image/jpeg" && $_FILES['picture']['type'] != "image/gif")
	{
		header("location:gallery.php?errorMsg=Image extention must be .jpg or .png or .jpeg. or .gif format!");
	}
	else
	{
		//insert gallery
		mysql_query("INSERT INTO gallery VALUES ('','".$pic."','1')");
		
		
		move_uploaded_file($_FILES['picture']['tmp_name'], $pathGallery.$pic);
		header("location:gallery.php");
	}
?>