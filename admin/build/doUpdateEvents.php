<?php
	session_start();
	include("select_db.php");
	
	$idUser = $_SESSION['idUser'];
	$idEvents = $_POST['id'];
	$title = $_POST['title'];
	$file = $_POST['file'];
	$description = $_POST['description'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	
	if($title == "")
	{
		header("location:updateEvents.php?errorMsg=Title must be filled!&idEvents=$idEvents");
	}
	else if($description == "")
	{
		header("location:updateEvents.php?errorMsg=Description must be filled!&idEvents=$idEvents");
	}
	else if($date == "")
	{
		header("location:updateEvents.php?errorMsg=Date must be chosen!&idEvents=$idEvents");
	}
	else if($time == "")
	{
		header("location:updateEvents.php?errorMsg=Time must be chosen!&idEvents=$idEvents");
	}
	else
	{
		//update events
		mysql_query("UPDATE events SET Title='".$title."', Description='".$description."', Date='".$date."', Time='".$time."' WHERE ID_Events='".$idEvents."'");
		
		//save events history
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
			'".$idEvents."','".$title."','".$file."','".$description."','".$date."','".$time."','".$idUser."','Update',now())");
		}
		else
		{
			mysql_query("INSERT INTO events_history VALUES (
			CONCAT('EVH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idEvents."','".$title."','".$file."','".$description."','".$date."','".$time."','".$idUser."','Update',now())");
		}
		
		header("location:events.php");
	}
	
?>