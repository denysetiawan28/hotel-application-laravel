<?php
	session_start();
	include("select_db.php");
	
	$idUser = $_SESSION['idUser'];
	$idNews = $_POST['id'];
	$title = $_POST['title'];
	$file = $_POST['file'];
	$description = $_POST['description'];
	
	
	if($title == "")
	{
		header("location:updateNews.php?errorMsg=Title must be filled!&idNews=$id");
	}
	else if($description == "")
	{
		header("location:updateNews.php?errorMsg=Description must be filled!&idNews=$id");
	}
	else
	{
		//update news
		mysql_query("UPDATE news SET Title='".$title."', Description='".$description."' WHERE ID_News='".$idNews."'");
		
		//save facility history
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
			'".$idNews."','".$title."','".$file."','".$description."','".$idUser."','Update',now())");
		}
		else
		{
			mysql_query("INSERT INTO news_history VALUES (
			CONCAT('NWH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idNews."','".$title."','".$file."','".$description."','".$idUser."','Update',now())");
		}
		
		header("location:news.php");
	}
	
?>