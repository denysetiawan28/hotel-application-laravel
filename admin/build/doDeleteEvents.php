<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idEvents'];
	$idUser = $_SESSION['idUser'];
	
	
	//save event history
	$result = mysql_query("SELECT * FROM events WHERE ID_Events = '".$id."'");
	while ($row = mysql_fetch_array($result))
	{
		$idEvents = $row['ID_Events'];
		$title = $row['Title'];
		$file = $row['File'];
		$description = $row['Description'];
		$date = $row['Date'];
		$time = $row['Time'];
	}
		
	$count = mysql_query("SELECT ID_Events_History as 'Flag' FROM events_history ORDER BY ID_Events_History DESC LIMIT 1") or die(mysql_error());
	
	$temp;
	while ($row = mysql_fetch_array($count)) {
		$temp = $row[0];
	}
	
	if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
	{
		mysql_query("INSERT INTO events_history VALUES (
		CONCAT('EVH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
		LPAD((SUBSTR((SELECT eh.ID_Events_History FROM events_history eh ORDER BY eh.ID_Events_History DESC LIMIT 1),6) + 1 ), 5, 0)),
		'".$idEvents."','".$title."','".$file."','".$description."','".$date."','".$time."','".$idUser."','Delete',now())");
	}
	else
	{
		mysql_query("INSERT INTO events_history VALUES (
		CONCAT('EVH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
		'".$idEvents."','".$title."','".$file."','".$description."','".$date."','".$time."','".$idUser."','Delete',now())");
	}
	
	//delete events
	mysql_query("UPDATE events SET Status='Delete' WHERE ID_Events = '".$id."'");
	header("location:events.php");
?>

