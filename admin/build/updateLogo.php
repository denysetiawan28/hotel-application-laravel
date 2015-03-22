<?php
	include("select_db.php");
include("picture_path.php");
	$id = $_POST['id'];
	$picture = $_FILES['logo']['name'];
	$temp = $_FILES['logo']['tmp_name'];
	
	if($_FILES['logo']['error'] != 0)
	{
		header("location:aboutus.php?errorPic=Logo must be chosen!&id=$id");
	}
	else if ($_FILES['logo']['type'] != "image/jpg" && $_FILES['logo']['type'] != "image/png" && $_FILES['logo']['type'] != "image/jpeg" && $_FILES['logo']['type'] != "image/gif")
	{
		header("location:aboutus.php?errorPic=Logo extention must be .jpg or .png or .jpeg. or .gif format!&id=$id");
	}
	else
	{
		//update logo
		mysql_query("UPDATE aboutus SET Logo='".$picture."' WHERE ID_Aboutus='".$id."'");
		
		move_uploaded_file($_FILES['logo']['tmp_name'], $pathLogo . $picture);
		header("location:aboutus.php?id=$id");
	}
?>