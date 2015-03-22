<?php
	session_start();
	include("select_db.php");
	
	$idUser = $_SESSION['idUser'];
	$idFacility = $_POST['id'];
	$name = $_POST['name'];
	$picture = $_POST['picture'];
	$description = $_POST['description'];
	
	if($name == "")
	{
		header("location:updateFacility.php?errorMsg=Name must be filled!&idFacility=$idFacility");
	}
	else if(duplicateCheck($name,$idFacility)==false)
	{
		header("location:updateFacility.php?errorMsg=Please insert different name!&idFacility=$idFacility");
	}
	else if($description == "")
	{
		header("location:updateFacility.php?errorMsg=Description must be filled!&idFacility=$idFacility");
	}
	else
	{	
		//update facility
		mysql_query("UPDATE facility SET Facility_Name='".$name."', Description='".$description."' WHERE ID_Facility='".$idFacility."'");
		
		
		//save facility history
		$count = mysql_query("SELECT ID_Facility_History as 'Flag' FROM facility_history ORDER BY ID_Facility_History DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO facility_history VALUES (
			CONCAT('FCH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT fh.ID_Facility_History FROM facility_history fh ORDER BY fh.ID_Facility_History DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idFacility."','".$name."','".$picture."','".$description."','".$idUser."','Update',now())");
		}
		else
		{
			mysql_query("INSERT INTO facility_history VALUES (
			CONCAT('FCH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idFacility."','".$name."','".$picture."','".$description."','".$idUser."','Update',now())");
		}
		
		header("location:facility.php");
		
	}
	
	
	function duplicateCheck($name,$idFacility)
	{
		$cekID = mysql_query("SELECT ID_Facility, Facility_Name FROM facility WHERE ID_Facility = '".$idFacility."'");
		while($row = mysql_fetch_array($cekID))
		{
			$currentID = $row[0];
			$currentName = $row[1];
		}
	
		$duplicateCheck = mysql_query("SELECT ID_Facility, Facility_Name FROM facility WHERE Facility_Name = '".$name."'");
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