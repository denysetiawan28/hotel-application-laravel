<?php
	include("select_db.php");

	$idPic = $_POST['idPic'];
	$idFacility = $_POST['idFacility'];
	
	//update main pic
	mysql_query("UPDATE facility_pic SET Main_Pic='NO' WHERE ID_Facility='".$idFacility."'");
	mysql_query("UPDATE facility_pic SET Main_Pic='YES' WHERE ID_Facility_Pic='".$idPic."'");
	
	header("location:updateFacility.php?idFacility=$idFacility");
?>