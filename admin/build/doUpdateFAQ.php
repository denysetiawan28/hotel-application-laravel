<?php
	session_start();
	include("select_db.php");

	$id = $_POST['id'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	
	if($question == "")
	{
		header("location:updateFAQ.php?errorMsg=Question must be filled!&idFAQ=$id");
	}
	else if($answer == "")
	{
		header("location:updateFAQ.php?errorMsg=Answer must be filled!&idFAQ=$id");
	}
	else
	{		
		mysql_query("UPDATE faq SET Question='".$question."', Answer= '".$answer."' WHERE ID_FAQ='".$id."'");
		header("location:faq.php");
	}
	
	
?>