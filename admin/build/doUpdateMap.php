<?php
	include("select_db.php");
	
	$id = $_POST['id'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	
	if($latitude == "")
	{
		header("location:addDestination.php?errorMsg=Latitude must be filled!");
	}
	else if($longitude == "")
	{
		header("location:addDestination.php?errorMsg=Longitude must be filled!");
	}
	else
	{
		//update destination
		mysql_query("UPDATE aboutus SET Latitude='".$latitude."', Longitude='".$longitude."' WHERE ID_Aboutus='".$id."'");

		header("location:aboutus.php?id=1");
		
	}
	
?>