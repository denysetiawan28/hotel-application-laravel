<?php
	session_start();
	include("select_db.php");
	include_once "picture_path.php";
	$idUser = $_SESSION['idUser'];
	$title = $_POST['title'];
	$file = $_FILES['filename']['name'];
	$description = $_POST['description'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	
	
	if($title == "")
	{
		header("location:addEvents.php?errorMsg=Title must be filled!");
	}
	else if($_FILES['filename']['error'] != 0)
	{
		header("location:addEvents.php?errorMsg=File must be chosen!");
	}
	else if($description == "")
	{
		header("location:addEvents.php?errorMsg=Description must be filled!");
	}
	else if($date == "")
	{
		header("location:addEvents.php?errorMsg=Date must be chosen!");
	}
	else if($time == "")
	{
		header("location:addEvents.php?errorMsg=Time must be chosen!");
	}
	else
	{
		//insert to events
		$count = mysql_query("SELECT ID_Events as 'Flag' FROM events ORDER BY ID_Events DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO events VALUES (
			CONCAT('EVE', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT ev.ID_Events FROM events ev ORDER BY ev.ID_Events DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$title."','".$file."','".$description."','".$date."','".$time."','Active')");
		}
		else
		{			
			mysql_query("INSERT INTO events VALUES (
			CONCAT('EVE', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$title."','".$file."','".$description."','".$date."','".$time."','Active')");
		}
		
		//get id events
		$result = mysql_query("SELECT ID_Events FROM events ORDER BY ID_Events DESC LIMIT 1");
		if( $row = mysql_fetch_array($result) ){
			$idEvents = $row['ID_Events'];
		}
		
		//insert to events_history
		$count2 = mysql_query("SELECT ID_Events_History as 'Flag' FROM events_history ORDER BY ID_Events_History DESC LIMIT 1") or die(mysql_error());
		
		$temp2;
		while ($row = mysql_fetch_array($count2)) {
			$temp2 = $row[0];
		}
		
		if((SUBSTR(strval($temp2), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO events_history VALUES (
			CONCAT('EVH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT eh.ID_Events_History FROM events_history eh ORDER BY eh.ID_Events_History DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idEvents."','".$title."','".$file."','".$description."','".$date."','".$time."','".$idUser."','Insert',now())");
		}
		else
		{			
			mysql_query("INSERT INTO events_history VALUES (
			CONCAT('EVH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idEvents."','".$title."','".$file."','".$description."','".$date."','".$time."','".$idUser."','Insert',now())");
		}
		
		header("location:events.php");
		move_uploaded_file($_FILES['filename']['tmp_name'], $pathEvents . $file);
		
	}
	
	
?>