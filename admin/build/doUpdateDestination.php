<?php
	include("select_db.php");

	$idDes = $_POST['id'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	$link = $_POST['link'];
	
	
	if($name == "")
	{
		header("location:addDestination.php?errorMsg=Name must be filled!");
	}
	else if(duplicateCheck($name,$idDes)==false)
	{
		header("location:addDestination.php?errorMsg=Please insert different name!");
	}
	else if($description == "")
	{
		header("location:addDestination.php?errorMsg=Description must be filled!");
	}
	else if($telp == "")
	{
		header("location:addDestination.php?errorMsg=Telp must be filled!");
	}
	else if(!ctype_digit($telp))
	{
		header("location:addDestination.php?errorMsg=Telp must be number!");
	}
	/*else if($email == "")
	{
		header("location:addDestination.php?errorMsg=Email must be filled!");
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("location:addDestination.php?errorMsg=Invalid Email format!");
	}*/
	else if($latitude == "")
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
		mysql_query("UPDATE destination SET Dest_Name='".$name."', Dest_Description='".$description."', Dest_Telp='".$telp."', Dest_Email='".$email."', Latitude='".$latitude."', Longitude='".$longitude."', Web_Link='".$link."' WHERE ID_Destination='".$idDes."'");

		header("location:destination.php");
		
	}
	
	function duplicateCheck($name,$idDes)
	{
		$cekID = mysql_query("SELECT ID_Destination, Name FROM destination WHERE ID_Destination = '".$idDes."'");
		while($row = mysql_fetch_array($cekID))
		{
			$currentID = $row[0];
			$currentName = $row[1];
		}
	
		$duplicateCheck = mysql_query("SELECT ID_Destination, Name FROM destination WHERE Name = '".$name."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			if($row[0]==$currentID && $row[1]==$currentName)
			{
				return true;
				break;
			}
			else
				return false;
		}
		return true;
	}

	
?>