<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idFacility'];
	$idUser = $_SESSION['idUser'];
	/*
	//save facility history
	$result = mysql_query("SELECT * FROM facility WHERE ID_Facility = '".$id."'");
	while ($row = mysql_fetch_array($result))
	{
		$idFacility = $row['ID_Facility'];
		$name = $row['Facility_Name'];
		$description = $row['Description'];
	}
		
	$count = mysql_query("SELECT ID_Facility_History as 'Flag' FROM facility_history ORDER BY ID_Facility_History DESC LIMIT 1") or die(mysql_error());
	
	$temp;
	while ($row = mysql_fetch_array($count)) {
		$temp = $row[0];
	}
	
	if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
	{
		mysql_query("INSERT INTO facility_history VALUES (
		CONCAT('RTH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
		LPAD((SUBSTR((SELECT rh.ID_RoomType_History FROM roomtype_history rh ORDER BY rh.ID_RoomType_History DESC LIMIT 1),6) + 1 ), 5, 0)),
		'".$idFacility."','".$name."','".$description."','".$idUser."','Delete',now())");
	}
	else
	{
		mysql_query("INSERT INTO facility_history VALUES (
		CONCAT('RTH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
		'".$idFacility."','".$name."','".$description."','".$idUser."','Delete',now())");
	}
	*/
	//delete facility
	mysql_query("UPDATE facility SET Status='Delete' WHERE ID_Facility = '".$id."'");
	header("location:facility.php");
?>

