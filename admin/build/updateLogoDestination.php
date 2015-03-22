<?php
	include("select_db.php");
	include_once "picture_path.php";
	$id = $_POST['id'];
	$picture = $_FILES['logo']['name'];
	$temp = $_FILES['logo']['tmp_name'];
	
	if($_FILES['logo']['error'] != 0)
	{
		header("location:updateDestination.php?errorPic=Logo must be chosen!&idDes=$id");
	}
	else if ($_FILES['logo']['type'] != "image/jpg" && $_FILES['logo']['type'] != "image/png" && $_FILES['logo']['type'] != "image/jpeg" && $_FILES['logo']['type'] != "image/gif")
	{
		header("location:updateDestination.php?errorPic=Logo extention must be .jpg or .png or .jpeg. or .gif format!&idDes=$id");
	}
	else
	{
		//update logo
		mysql_query("UPDATE destination SET Dest_Picture='".$picture."' WHERE ID_Destination='".$id."'");
		
		move_uploaded_file($_FILES['logo']['tmp_name'], $pathDestinasi . $picture);
		header("location:updateDestination.php?idDes=$id");
		
	}
?>