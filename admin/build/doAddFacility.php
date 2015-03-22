<?php
	session_start();
	include("select_db.php");
	include_once "picture_path.php";
	
	$idUser = $_SESSION['idUser'];
	$name = $_POST['name'];
	$picture = $_FILES['picture']['name'];
	$description = $_POST['description'];
	
	
	if($name == "")
	{
		header("location:addFacility.php?errorMsg=Name must be filled!");
	}
	else if(duplicateCheck($name)==false)
	{
		header("location:addFacility.php?errorMsg=Please insert different name!");
	}
	else if($_FILES['picture']['error'] != 0)
	{
		header("location:addFacility.php?errorMsg=Image must be chosen!");
	}
	else if ($_FILES['picture']['type'] != "image/jpg" && $_FILES['picture']['type'] != "image/png" && $_FILES['picture']['type'] != "image/jpeg" && $_FILES['picture']['type'] != "image/gif")
	{
		header("location:addFacility.php?errorMsg=Image extention must be .jpg or .png or .jpeg. or .gif format!");
	}
	else if($description == "")
	{
		header("location:addFacility.php?errorMsg=Description must be filled!");
	}
	else
	{	
		//insert to facility
		$count = mysql_query("SELECT ID_Facility as 'Flag' FROM facility ORDER BY ID_Facility DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO facility VALUES (
			CONCAT('FCT', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT fc.ID_Facility FROM facility fc ORDER BY fc.ID_Facility DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$name."','".$description."','Active')");
		}
		else
		{			
			mysql_query("INSERT INTO facility VALUES (
			CONCAT('FCT', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$name."','".$description."','Active')");
		}
		
		//get id facility
		$result = mysql_query("SELECT fc.ID_Facility FROM facility fc ORDER BY fc.ID_Facility DESC LIMIT 1");
		if( $row = mysql_fetch_array($result) ){
			$idFacility = $row['ID_Facility'];
		}
		
		//insert to facility_pic
		$ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
		$count3 = mysql_query("SELECT ID_Facility_Pic as 'Flag' FROM facility_pic ORDER BY ID_Facility_Pic DESC LIMIT 1") or die(mysql_error());
		
		$temp3;
		while ($row = mysql_fetch_array($count3)) {
			$temp3 = $row[0];
		}
		
		if((SUBSTR(strval($temp3), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO facility_pic VALUES (
			CONCAT('FAP', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT fp.ID_Facility_Pic FROM facility_pic fp ORDER BY fp.ID_Facility_Pic DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idFacility."','".$name.".".$ext."','YES')");
		}
		else
		{			
			mysql_query("INSERT INTO facility_pic VALUES (
			CONCAT('FAP', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idFacility."','".$name.".".$ext."','YES')");
		}
		
		/*
		//insert to facility_history
		$count2 = mysql_query("SELECT ID_Facility_History as 'Flag' FROM facility_history ORDER BY ID_Facility_History DESC LIMIT 1") or die(mysql_error());
		
		$temp2;
		while ($row = mysql_fetch_array($count2)) {
			$temp2 = $row[0];
		}
		
		if((SUBSTR(strval($temp2), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO facility_history VALUES (
			CONCAT('FCH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT rh.ID_RoomType_History FROM roomtype_history rh ORDER BY rh.ID_RoomType_History DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idFacility."','".$name."','".$picture."','".$description."','".$idUser."','Insert',now())");
		}
		else
		{			
			mysql_query("INSERT INTO facility_history VALUES (
			CONCAT('FCH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idFacility."','".$name."','".$picture."','".$description."','".$idUser."','Insert',now())");
		}
		*/
		header("location:facility.php");
		move_uploaded_file($_FILES['picture']['tmp_name'], $pathFacility.$name.'.'.$ext);
		
	}
	
	function duplicateCheck($name)
	{
		$duplicateCheck = mysql_query("SELECT Facility_Name FROM facility WHERE Facility_Name = '".$name."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			return false;
		}
		return true;
	}

	
?>