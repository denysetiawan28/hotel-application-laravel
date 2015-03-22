<?php
	include("select_db.php");
	include("picture_path.php");
	
	$idRoom = $_POST['id'];
	$name = $_POST['name'];
	$picture = $_FILES['picture']['name'];
	$temp = $_FILES['picture']['tmp_name'];
	
	if($_FILES['picture']['error'] != 0)
	{
		header("location:updateRoomType.php?errorPic=Image must be chosen!&idRoom=$idRoom");
	}
	else if ($_FILES['picture']['type'] != "image/jpg" && $_FILES['picture']['type'] != "image/png" && $_FILES['picture']['type'] != "image/jpeg" && $_FILES['picture']['type'] != "image/gif")
	{
		header("location:updateRoomType.php?errorPic=Image extention must be .jpg or .png or .jpeg. or .gif format!&idRoom=$idRoom");
	}
	else
	{
		//insert to roomtype_pic
		//$ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
		$count = mysql_query("SELECT ID_RoomType_Pic as 'Flag' FROM roomtype_pic ORDER BY ID_RoomType_Pic DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		//New Code
		$actual_name = $name;
		$original_name = $actual_name;
		$extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
echo $extension;
		$i = 1;
		while(file_exists($pathRoom.$actual_name.".".$extension))
		{           
			$actual_name = (string)$original_name.$i;
			$name = $actual_name.".".$extension;
			$i++;
		}
		//
		
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			
			mysql_query("INSERT INTO roomtype_pic VALUES (
			CONCAT('PIR', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT rp.ID_RoomType_Pic FROM roomtype_pic rp ORDER BY rp.ID_RoomType_Pic DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idRoom."','".$name."','NO')");
		}
		else
		{	
			mysql_query("INSERT INTO roomtype_pic VALUES (
			CONCAT('PIR', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idRoom."','".$name."','NO')");
		}
		
		move_uploaded_file($_FILES['picture']['tmp_name'], $pathRoom.$name);
		header("location:updateRoomType.php?idRoom=$idRoom");
	}
?>