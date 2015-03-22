<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idNews'];
	$idUser = $_SESSION['idUser'];
	
	//save news history
	$result = mysql_query("SELECT * FROM news WHERE ID_News = '".$id."'");
	while ($row = mysql_fetch_array($result))
	{
		$idNews = $row['ID_News'];
		$title = $row['Title'];
		$file = $row['File'];
		$description = $row['Description'];
	}
		
	$count = mysql_query("SELECT ID_News_History as 'Flag' FROM news_history ORDER BY ID_News_History DESC LIMIT 1") or die(mysql_error());
	
	$temp;
	while ($row = mysql_fetch_array($count)) {
		$temp = $row[0];
	}
	
	if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
	{
		mysql_query("INSERT INTO news_history VALUES (
		CONCAT('NWH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
		LPAD((SUBSTR((SELECT nh.ID_News_History FROM news_history nh ORDER BY nh.ID_News_History DESC LIMIT 1),6) + 1 ), 5, 0)),
		'".$idNews."','".$title."','".$file."','".$description."','".$idUser."','Delete',now())");
	}
	else
	{
		mysql_query("INSERT INTO news_history VALUES (
		CONCAT('NWH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
		'".$idNews."','".$title."','".$file."','".$description."','".$idUser."','Delete',now())");
	}
	
	//delete news
	mysql_query("UPDATE news SET Status='Delete' WHERE ID_News = '".$id."'");
	header("location:news.php");
?>

