<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idAdd'];
	$idUser = $_SESSION['idUser'];
	
	//delete additional
	mysql_query("UPDATE additional SET Status='Delete' WHERE ID_Additional = '".$id."'");
	
	//insert additional_history
	$result = mysql_query("SELECT * FROM additional WHERE ID_Additional = '".$id."'");
	while ($row = mysql_fetch_array($result))
	{
		$idAdd = $row['ID_Additional'];
		$name = $row['Additional_Name'];
		$price = $row['Price'];
		$description = $row['Description'];
		$qty= $row['Quantity'];
	}
	
	$count2 = mysql_query("SELECT ID_Additional_History FROM additional_history ORDER BY ID_Additional_History DESC LIMIT 1") or die(mysql_error());
	
	$temp2;
	while ($row = mysql_fetch_array($count2)) {
		$temp2 = $row[0];
	}
	
	if((SUBSTR(strval($temp2), 3, -5)) == strval(date("y")))
	{
		mysql_query("INSERT INTO additional_history VALUES (
		CONCAT('ADH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
		LPAD((SUBSTR((SELECT ah.ID_Additional_History FROM additional_history ah ORDER BY ah.ID_Additional_History DESC LIMIT 1),6) + 1 ), 5, 0)),
		'".$idAdd."','".$name."','".$price."','".$description."','".$qty."','".$idUser."','Delete',now())");
	}
	else
	{			
		mysql_query("INSERT INTO additional_history VALUES (
		CONCAT('ADH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
		'".$idAdd."','".$name."','".$price."','".$description."','".$qty."','".$idUser."','Delete',now())");
	}
		
	header("location:additional.php");
?>