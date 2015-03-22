<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idUser'];
	
	mysql_query("UPDATE user SET Status='Non-Active' WHERE ID_User = '".$id."'");
	header("location:users.php");
?>

