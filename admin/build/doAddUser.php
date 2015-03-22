<?php
	session_start();
	include("select_db.php");

	$role = $_POST['role'];
	$username = $_POST['username'];
	$pass = $_POST['password'];
	$name = $_POST['name'];
	$dob = $_POST['date'];
	$email = $_POST['email'];

	
	if($username == "")
	{
		header("location:addUser.php?errorMsg=Username must be filled!");
	}
	else if($name == "")
	{
		header("location:addUser.php?errorMsg=Name must be filled!");
	}
	else if(duplicateCheck($username)==false)
	{
		header("location:addUser.php?errorMsg=Please insert different username!");
	}
	else if($pass == "")
	{
		header("location:addUser.php?errorMsg=Password must be filled!");
	}
	else if($email == "")
	{
		header("location:addUser.php?errorMsg=Email must be filled!");
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("location:addUser.php?errorMsg=Invalid Email format!");
	}
	else
	{
		$count = mysql_query("SELECT ID_User as 'Flag' FROM user ORDER BY ID_User DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO user VALUES (
			CONCAT('USR', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT us.ID_User FROM user us ORDER BY us.ID_User DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$role."','".$username."','".$pass."','".$name."','".$dob."','".$email."','Active')");
		}
		else
		{			
			mysql_query("INSERT INTO user VALUES (
			CONCAT('USR', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$role."','".$username."','".$pass."','".$name."','".$dob."','".$email."','Active')");
		}

		header("location:users.php");
	}
	
	function duplicateCheck($username)
	{
		$duplicateCheck = mysql_query("SELECT Username FROM user WHERE Username = '".$username."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			return false;
		}
		return true;
	}

	
?>