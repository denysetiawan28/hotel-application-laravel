<?php
	session_start();
	include("select_db.php");
	include_once "picture_path.php";
	$name = $_POST['name'];
	$picture = $_FILES['picture']['name'];
	$temp = $_FILES['picture']['tmp_name'];
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
	else if(duplicateCheck($name)==false)
	{
		header("location:addDestination.php?errorMsg=Please insert different name!");
	}
	else if($_FILES['picture']['error'] != 0)
	{
		header("location:addDestination.php?errorMsg=Image must be chosen!");
	}
	else if ($_FILES['picture']['type'] != "image/jpg" && $_FILES['picture']['type'] != "image/png" && $_FILES['picture']['type'] != "image/jpeg" && $_FILES['picture']['type'] != "image/gif")
	{
		header("location:addDestination.php?errorMsg=Image extention must be .jpg or .png or .jpeg. or .gif format!");
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
		mysql_query("INSERT INTO destination VALUES ('','".$name."','".$picture."','".$description."','".$telp."','".$email."','".$latitude."','".$longitude."','".$link."','Active')");
		

		header("location:destination.php");
		move_uploaded_file($_FILES['picture']['tmp_name'], $pathDestinasi . $picture);
		echo mysql_error();
	}
	
	function duplicateCheck($name)
	{
		$duplicateCheck = mysql_query("SELECT Name FROM destination WHERE Name = '".$name."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			return false;
		}
		return true;
	}

	
?>