<?php
	session_start();
	include("select_db.php");

	$idUser = $_POST['id'];
	$username = $_POST['username'];
	$name = $_POST['name'];
	$dob = $_POST['date'];
	$email = $_POST['email'];
	
	if($username == "")
	{
		header("location:updateUser.php?errorMsg=Username must be filled!&idUser=$idUser");
	}
	else if($name == "")
	{
		header("location:updateUser.php?errorMsg=Name must be filled!&idUser=$idUser");
	}
	else if(duplicateCheck($username,$idUser)==false)
	{
		header("location:updateUser.php?errorMsg=Please insert different username!&idUser=$idUser");
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("location:updateUser.php?errorMsg=Email must be filled!&idUser=$idUser");
	}
	else
	{		
		mysql_query("UPDATE user SET Username='".$username."', Name= '".$name."', DOB='".$dob."', Email='".$email."' WHERE ID_User='".$idUser."'");
		header("location:users.php");
	}
	
	
	function duplicateCheck($username,$idUser)
	{
		$cekID = mysql_query("SELECT ID_User, Username FROM user WHERE ID_User = '".$idUser."'");
		while($row = mysql_fetch_array($cekID))
		{
			$currentID = $row[0];
			$currentUsername = $row[1];
		}
	
		$duplicateCheck = mysql_query("SELECT ID_User, Username FROM user WHERE Username = '".$username."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			if($row[0]==$currentID && $row[1]==$currentUsername)
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