<?php
	session_start();
	include("select_db.php");
	include_once "picture_path.php";
	$idUser = $_SESSION['idUser'];
	$title = $_POST['title'];
	$file = $_FILES['filename']['name'];
	$description = $_POST['description'];
	
	
	if($title == "")
	{
		header("location:addNews.php?errorMsg=Title must be filled!");
	}
	else if($_FILES['filename']['error'] != 0)
	{
		header("location:addNews.php?errorMsg=File must be chosen!");
	}
	else if($description == "")
	{
		header("location:addNews.php?errorMsg=Description must be filled!");
	}
	else
	{
		//insert to news
		$count = mysql_query("SELECT ID_News as 'Flag' FROM news ORDER BY ID_News DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO news VALUES (
			CONCAT('NEW', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT ne.ID_News FROM news ne ORDER BY ne.ID_News DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$title."','".$file."','".$description."',now(),'Active')");
		}
		else
		{			
			mysql_query("INSERT INTO news VALUES (
			CONCAT('NEW', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$title."','".$file."','".$description."',now(),'Active')");
		}
		
		//get id news
		$result = mysql_query("SELECT ID_News FROM news ORDER BY ID_News DESC LIMIT 1");
		if( $row = mysql_fetch_array($result) ){
			$idNews = $row['ID_News'];
		}
		
		//insert to news_history
		$count2 = mysql_query("SELECT ID_News_History as 'Flag' FROM news_history ORDER BY ID_News_History DESC LIMIT 1") or die(mysql_error());
		
		$temp2;
		while ($row = mysql_fetch_array($count2)) {
			$temp2 = $row[0];
		}
		
		if((SUBSTR(strval($temp2), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO news_history VALUES (
			CONCAT('NWH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT nh.ID_News_History FROM news_history nh ORDER BY nh.ID_News_History DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idNews."','".$title."','".$file."','".$description."','".$idUser."','Insert',now())");
		}
		else
		{			
			mysql_query("INSERT INTO news_history VALUES (
			CONCAT('NWH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idNews."','".$title."','".$file."','".$description."','".$idUser."','Insert',now())");
		}
		
		header("location:news.php");
		move_uploaded_file($_FILES['filename']['tmp_name'], $pathNews . $file);
		
	}
	
	
?>