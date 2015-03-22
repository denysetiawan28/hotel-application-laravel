<?php
	include("select_db.php");

	$idPic = $_POST['idPic'];
	$idRoom = $_POST['idRoom'];
	
	//update main pic
	mysql_query("UPDATE roomtype_pic SET Main_Pic='NO' WHERE ID_RoomType='".$idRoom."'");
	mysql_query("UPDATE roomtype_pic SET Main_Pic='YES' WHERE ID_RoomType_Pic='".$idPic."'");
	
	header("location:updateRoomType.php?idRoom=$idRoom");
?>