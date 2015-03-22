<?php
	session_start();
	include("select_db.php");
	
	$idTravel = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	$diskon = $_POST['diskon'];
	$link = $_POST['link'];
	
	if($name == "")
	{
		header("location:updateTravel.php?errorMsg=Name must be filled!&idTravel=$idTravel");
	}
	else if(duplicateCheck($name,$idTravel)==false)
	{
		header("location:updateTravel.php?errorMsg=Please insert different name!&idTravel=$idTravel");
	}
	else if($address == "")
	{
		header("location:updateTravel.php?errorMsg=Address must be filled!&idTravel=$idTravel");
	}
	else if($telp == "")
	{
		header("location:updateTravel.php?errorMsg=Telp must be filled!&idTravel=$idTravel");
	}
	else if(!ctype_digit($telp))
	{
		header("location:updateTravel.php?errorMsg=Telp must be number!&idTravel=$idTravel");
	}
	else if($email == "")
	{
		header("location:updateTravel.php?errorMsg=Email must be filled!&idTravel=$idTravel");
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("location:updateTravel.php?errorMsg=Invalid Email format!&idTravel=$idTravel");
	}
	else if($diskon == "")
	{
		header("location:updateTravel.php?errorMsg=Diskon must be filled!&idTravel=$idTravel");
	}
	else if(!ctype_digit($diskon))
	{
		header("location:updateTravel.php?errorMsg=Diskon must be number!&idTravel=$idTravel");
	}
	else if($link == "")
	{
		header("location:updateTravel.php?errorMsg=Website Link must be filled!&idTravel=$idTravel");
	}
	else
	{		
		//update tax
		mysql_query("UPDATE travel SET Travel_Name='".$name."', Travel_Address='".$address."', Travel_Telp='".$telp."', Travel_Email='".$email."', Travel_Diskon='".$diskon."', Web_Link='".$link."' WHERE ID_Travel='".$idTravel."'");
		
		header("location:travel.php");
	}
	
	
	function duplicateCheck($name,$idTravel)
	{
		$cekID = mysql_query("SELECT ID_Travel, Travel_Name FROM tax WHERE ID_Travel = '".$idTravel."'");
		while($row = mysql_fetch_array($cekID))
		{
			$currentID = $row[0];
			$currentName = $row[1];
		}
	
		$duplicateCheck = mysql_query("SELECT ID_Travel, Travel_Name FROM tax WHERE Travel_Name = '".$name."'");
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