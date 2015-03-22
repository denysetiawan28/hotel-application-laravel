<?php
	include("select_db.php");
	
	$id = $_GET['idTravel'];
	
	//delete roomtype
	mysql_query("UPDATE travel SET Status='Delete' WHERE ID_Travel = '".$id."'");
	header("location:travel.php");
?>

