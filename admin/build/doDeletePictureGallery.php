<?php
	include("select_db.php");

	$idPic = $_GET['idPic'];
	
	//update main pic
	mysql_query("UPDATE gallery SET Status='Delete' WHERE ID_Gallery='".$idPic."'");
	//unlink('localhost/admin/build/images/facility/'.$name);
	header("location:gallery.php");
?>