<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idNewsletter'];
	
	mysql_query("UPDATE newsletter SET Status='Confirm' WHERE ID_Newsletter = '".$id."'");
	header("location:newsletter.php");
?>

