<?php
	session_start();
	if( !isset($_SESSION['name']) ){
		header("location:sign-in.php");
	}
	include("select_db.php");
	
	$id = $_GET['idFAQ'];
	
	mysql_query("UPDATE faq SET Status='Deleted' WHERE ID_FAQ = '".$id."'");
	header("location:faq.php");
?>

