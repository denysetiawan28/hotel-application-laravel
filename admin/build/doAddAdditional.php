<?php
	session_start();
	include("select_db.php");
	
	$idUser = $_SESSION['idUser'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$qty= $_POST['qty'];
	
	if($name == "")
	{
		header("location:addAdditional.php?errorMsg=Name must be filled!");
	}
	else if(duplicateCheck($name)==false)
	{
		header("location:addAdditional.php?errorMsg=Please insert different name!");
	}
	else if($price == "")
	{
		header("location:addAdditional.php?errorMsg=Price must be filled!");
	}
	else if(!ctype_digit($price))
	{
		header("location:addAdditional.php?errorMsg=Price must be number!");
	}
	else if($description == "")
	{
		header("location:addAdditional.php?errorMsg=Description must be filled!");
	}
	else
	{
		//insert additional
		$count = mysql_query("SELECT ID_Additional as 'Flag' FROM additional ORDER BY ID_Additional DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO additional VALUES (
			CONCAT('ADD', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT ad.ID_Additional FROM additional ad ORDER BY ad.ID_Additional DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$name."','".$price."','".$description."','".$qty."','Active')");
		}
		else
		{			
			mysql_query("INSERT INTO additional  VALUES (
			CONCAT('ADD', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$name."','".$price."','".$description."','".$qty."','Active')");
		}
		
		//get last id additional
		$result = mysql_query("SELECT ID_Additional FROM additional ORDER BY ID_Additional DESC LIMIT 1");
		if( $row = mysql_fetch_array($result) ){
			$idAdd = $row['ID_Additional'];
		}
		
		//insert additional_history
		$count2 = mysql_query("SELECT ID_Additional_History as 'Flag' FROM additional_history ORDER BY ID_Additional_History DESC LIMIT 1") or die(mysql_error());
		
		$temp2;
		while ($row = mysql_fetch_array($count2)) {
			$temp2 = $row[0];
		}
		
		if((SUBSTR(strval($temp2), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO additional_history VALUES (
			CONCAT('ADH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT th.ID_Tax_History FROM tax_history th ORDER BY th.ID_Tax_History DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idAdd."','".$name."','".$price."','".$description."','".$qty."','".$idUser."','Insert',now())");
		}
		else
		{			
			mysql_query("INSERT INTO additional_history VALUES (
			CONCAT('ADH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idAdd."','".$name."','".$price."','".$description."','".$qty."','".$idUser."','Insert',now())");
		}
		
		header("location:additional.php");
	}
	
	function duplicateCheck($name)
	{
		$duplicateCheck = mysql_query("SELECT Additional_Name FROM additional WHERE Additional_Name = '".$name."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			return false;
		}
		return true;
	}

	
?>