<?php
	session_start();
	include("select_db.php");

	$question = $_POST['question'];
	$answer = $_POST['answer'];

	
	if($question == "")
	{
		header("location:addFAQ.php?errorMsg=Question must be filled!");
	}
	else if($answer == "")
	{
		header("location:addFAQ.php?errorMsg=Answer must be filled!");
	}
	else
	{
		$count = mysql_query("SELECT ID_FAQ as 'Flag' FROM faq ORDER BY ID_FAQ DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO faq VALUES (
			CONCAT('FAQ', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT fq.ID_FAQ FROM faq fq ORDER BY fq.ID_FAQ DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$question."','".$answer."',now(),'Active')");
		}
		else
		{			
			mysql_query("INSERT INTO faq VALUES (
			CONCAT('FAQ', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$question."','".$answer."',now(),'Active')");
		}

		header("location:faq.php");
	}
	

	
?>