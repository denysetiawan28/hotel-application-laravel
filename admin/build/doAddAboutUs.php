<?php
	include("select_db.php");

	$name = $_POST['name'];
	$address = $_POST['address'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	$about = $_POST['about'];
	$concept = $_POST['concept'];
	$vision = $_POST['vision'];
	$mision = $_POST['mision'];
	$web = $_POST['web'];
	$book = $_POST['book'];
	
	
	if($name == "")
	{
		header("location:addAboutUs.php?errorMsg=Name must be filled!");
	}
	else if($address == "")
	{
		header("location:addAboutUs.php?errorMsg=Address must be filled!");
	}
	else if($telp == "")
	{
		header("location:addAboutUs.php?errorMsg=Telephone must be filled!");
	}
	else if(!ctype_digit($telp))
	{
		header("location:addAboutUs.php?errorMsg=Telephone must be number!");
	}
	else if($email == "")
	{
		header("location:addAboutUs.php?errorMsg=Email must be filled!");
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("location:addAboutUs.php?errorMsg=Invalid Email format!");
	}
	else if($about == "")
	{
		header("location:addAboutUs.php?errorMsg=About must be filled!");
	}
	else if($concept == "")
	{
		header("location:addAboutUs.php?errorMsg=Concept must be filled!");
	}
	else if($vision == "")
	{
		header("location:addAboutUs.php?errorMsg=Vision must be filled!");
	}
	else if($mision == "")
	{
		header("location:addAboutUs.php?errorMsg=Mision must be filled!");
	}
	else if($web == "")
	{
		header("location:addAboutUs.php?errorMsg=Link Web must be filled!");
	}
	else if($book == "")
	{
		header("location:addAboutUs.php?errorMsg=Link Book must be filled!");
	}
	else
	{
		$count = mysql_query("SELECT ID_Aboutus as 'Flag' FROM aboutus ORDER BY ID_Aboutus DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO aboutus VALUES (
			CONCAT('ABT', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT au.ID_Aboutus FROM aboutus au ORDER BY au.ID_Aboutus DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$name."','".$address."','".$telp."','".$email."','".$about."','".$concept."','".$vision."','".$mision."','".$web."','".$book."'");
		}
		else
		{			
			mysql_query("INSERT INTO aboutus VALUES (
			CONCAT('ABT', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$name."','".$address."','".$telp."','".$email."','".$about."','".$concept."','".$vision."','".$mision."','".$web."','".$book."'");
		}

		header("location:aboutus.php");
	}
	
	
?>