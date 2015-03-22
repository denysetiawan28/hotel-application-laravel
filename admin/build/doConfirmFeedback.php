<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idFeedback'];
	
	mysql_query("UPDATE feedback SET Status='Confirm' WHERE ID_Feedback = '".$id."'");
	header("location:feedback.php");
?>

