<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idDestination'];
	
	mysql_query("UPDATE destination SET Status='Deleted' WHERE ID_Destination = '".$id."'");
	header("location:destination.php");
?>

