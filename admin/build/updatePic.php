<?php
	include("select_db.php");
include("picture_path.php");
	$id = $_POST['id'];
	$picture = $_FILES['picture']['name'];
	$temp = $_FILES['picture']['tmp_name'];
	
	if($_FILES['picture']['error'] != 0)
	{
		header("location:aboutus.php?errorPic=Picture must be chosen!&id=$id");
	}
	else if ($_FILES['picture']['type'] != "image/jpg" && $_FILES['picture']['type'] != "image/png" && $_FILES['picture']['type'] != "image/jpeg" && $_FILES['picture']['type'] != "image/gif")
	{
		header("location:aboutus.php?errorPic=Picture extention must be .jpg or .png or .jpeg. or .gif format!&id=$id");
	}
	else
	{
		//update logo
		mysql_query("UPDATE aboutus SET AboutUsPic='".$picture."' WHERE ID_Aboutus='".$id."'");
		
		move_uploaded_file($_FILES['picture']['tmp_name'], $pathAboutUs . $picture);
		header("location:aboutus.php?id=$id");
	}
?>