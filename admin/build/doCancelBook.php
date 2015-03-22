<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idBook'];
	
	mysql_query("UPDATE booking SET Booking_Status='Cancel' WHERE ID_Booking= '".$id."'");
	header("location:bookingHistory.php");
?>

