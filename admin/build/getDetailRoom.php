<?php
	include("select_db.php");
	$idRoom = $_GET['idRoom'];

	$sql="SELECT * FROM roomtype WHERE ID_RoomType = '".$idRoom."'";
	$result = mysql_query($sql);
	
	while($row = mysql_fetch_array($result)) {
		echo $row['ID_RoomType'].'-';
		echo $row['RoomType_Name'].'-';
		echo $row['Price'];
	}
?>