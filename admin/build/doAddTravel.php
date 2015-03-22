<?php
	include("select_db.php");
	include_once "picture_path.php";
	$name = $_POST['name'];
	$address = $_POST['address'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	$diskon = $_POST['diskon'];
	$link = $_POST['link'];
	
	if($name == "")
	{
		header("location:addTravel.php?errorMsg=Name must be filled!");
	}
	else if(duplicateCheck($name)==false)
	{
		header("location:addTravel.php?errorMsg=Please insert different name!");
	}
	else if($_FILES['logo']['error'] != 0)
	{
		header("location:addTravel.php?errorMsg=Logo must be chosen!");
	}
	else if ($_FILES['logo']['type'] != "image/jpg" && $_FILES['logo']['type'] != "image/png" && $_FILES['logo']['type'] != "image/jpeg" && $_FILES['logo']['type'] != "image/gif")
	{
		header("location:addTravel.php?errorMsg=Image extention must be .jpg or .png or .jpeg. or .gif format!");
	}
	else if($address == "")
	{
		header("location:addTravel.php?errorMsg=Address must be filled!");
	}
	else if($telp == "")
	{
		header("location:addTravel.php?errorMsg=Telp must be filled!");
	}
	else if(!ctype_digit($telp))
	{
		header("location:addTravel.php?errorMsg=Telp must be number!");
	}
	else if($email == "")
	{
		header("location:addTravel.php?errorMsg=Email must be filled!");
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("location:addTravel.php?errorMsg=Invalid Email format!");
	}
	else if($diskon == "")
	{
		header("location:addTravel.php?errorMsg=Diskon must be filled!");
	}
	else if(!ctype_digit($diskon))
	{
		header("location:addTravel.php?errorMsg=Diskon must be number!");
	}
	else if($link == "")
	{
		header("location:addTravel.php?errorMsg=Website Link must be filled!");
	}
	else
	{
		//insert to travel
		$ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
		
      		mysql_query("INSERT INTO travel VALUES ('', '".$name.".".$ext."','".$name."','".$address."','".$telp."','".$email."','".$diskon."','".$link."','Active')");
		
		
		move_uploaded_file($_FILES['logo']['tmp_name'], $pathTravel . $name.".".$ext);
		header("location:travel.php");
	}
	
	function duplicateCheck($name)
	{
		$duplicateCheck = mysql_query("SELECT Travel_Name FROM travel WHERE Travel_Name = '".$name."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			return false;
		}
		return true;
	}

	
?>