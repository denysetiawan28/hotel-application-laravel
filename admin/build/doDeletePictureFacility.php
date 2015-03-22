<?php
	include("select_db.php");

	$idPic = $_GET['idPic'];
	$idFacility = $_GET['idFacility'];
	
	$result = mysql_query("select Picture from facility_pic where ID_Facility_Pic='".$idPic."'");
	while($row=mysql_fetch_array($result)){
		$name = $row['Picture'];
	}
	//update main pic
	mysql_query("UPDATE facility_pic SET Main_Pic='Delete' WHERE ID_Facility_Pic='".$idPic."'");
	//unlink('localhost/admin/build/images/facility/'.$name);
	header("location:updateFacility.php?idFacility=$idFacility");
?>