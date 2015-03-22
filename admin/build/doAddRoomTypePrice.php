<?php
	session_start();
	include("select_db.php");

	$room = $_POST['room'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$price = $_POST['price'];
	
	if($room == "")
	{
		header("location:addRoomTypePrice.php?errorMsg=Room must be chosen!");
	}
	else if($start == "")
	{
		header("location:addRoomTypePrice.php?errorMsg=Start Date must be chosen!");
	}
	else if($end == "")
	{
		header("location:addRoomTypePrice.php?errorMsg=End Date must be chosen!");
	}
	else if($price == "")
	{
		header("location:addRoomTypePrice.php?errorMsg=Price must be filled!");
	}
	else if(!ctype_digit($price))
	{
		header("location:addRoomTypePrice.php?errorMsg=Price must be number!");
	}
	else
	{
		//insert to room type price
		$count = mysql_query("SELECT ID_RoomType_Price as 'Flag' FROM roomtype_price ORDER BY ID_RoomType_Price DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO roomtype_price VALUES (
			CONCAT('PRC', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT rp.ID_RoomType_Price FROM roomtype_price rp ORDER BY rp.ID_RoomType_Price DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$room."','".$start."','".$end."','".$price."')");
		}
		else
		{			
			mysql_query("INSERT INTO roomtype_price VALUES (
			CONCAT('PRC', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$room."','".$start."','".$end."','".$price."')");
		}
		
		header("location:roomTypePrice.php");
		
	}
	
	
?>