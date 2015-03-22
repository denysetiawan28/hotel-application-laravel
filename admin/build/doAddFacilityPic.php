<?php
	include("select_db.php");
	include_once "picture_path.php";
	
	$idFacility = $_POST['id'];
	$name = $_POST['name'];
	$picture = $_FILES['picture']['name'];
	$temp = $_FILES['picture']['tmp_name'];
	
	if($_FILES['picture']['error'] != 0)
	{
		header("location:updateFacility.php?errorPic=Image must be chosen!&idFacility=$idFacility");
	}
	else if ($_FILES['picture']['type'] != "image/jpg" && $_FILES['picture']['type'] != "image/png" && $_FILES['picture']['type'] != "image/jpeg" && $_FILES['picture']['type'] != "image/gif")
	{
		header("location:updateFacility.php?errorPic=Image extention must be .jpg or .png or .jpeg. or .gif format!&idFacility=$idFacility");
	}
	else
	{
		//insert facility_pic
		$ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
		$count = mysql_query("SELECT ID_Facility_Pic as 'Flag' FROM facility_pic ORDER BY ID_Facility_Pic DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		//New Code
		$actual_name = $name;
		$original_name = $actual_name;
		$extension = pathinfo($picture, PATHINFO_EXTENSION);
		
		$i = 1;
		while(file_exists($pathFacility.$actual_name.".".$extension))
		{           
			$actual_name = (string)$original_name.$i;
			$name = $actual_name.".".$extension;
			$i++;			
		}
		//
		
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			
			mysql_query("INSERT INTO facility_pic VALUES (
			CONCAT('FAP', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT fp.ID_Facility_Pic FROM facility_pic fp ORDER BY fp.ID_Facility_Pic DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idFacility."','".$name."','NO')");
		}
		else
		{	
			mysql_query("INSERT INTO facility_pic VALUES (
			CONCAT('FAP', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idFacility."','".$name."','NO')");
		}		
		move_uploaded_file($_FILES['picture']['tmp_name'], $pathFacility.$name);
		header("location:updateFacility.php?idFacility=$idFacility");
	
	}
?>