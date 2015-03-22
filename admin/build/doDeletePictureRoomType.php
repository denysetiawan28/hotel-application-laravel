<?php
	include("select_db.php");

	$idPic = $_GET['idPic'];
	$idRoom = $_GET['idRoom'];
	
	//update main pic
	mysql_query("UPDATE roomtype_pic SET Main_Pic='Delete' WHERE ID_RoomType_Pic='".$idPic."'");
	
	header("location:updateRoomType.php?idRoom=$idRoom");
?>