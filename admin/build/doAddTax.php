<?php
	session_start();
	include("select_db.php");
	
	$idUser = $_SESSION['idUser'];
	$name = $_POST['name'];
	$tax = $_POST['tax'];

	
	if($name == "")
	{
		header("location:addTax.php?errorMsg=Name must be filled!");
	}
	else if(duplicateCheck($name)==false)
	{
		header("location:addTax.php?errorMsg=Please insert different name!");
	}
	else if($tax == "")
	{
		header("location:addTax.php?errorMsg=Tax must be filled!");
	}
	else if(!ctype_digit($tax))
	{
		header("location:addTax.php?errorMsg=Tax must be number!");
	}
	else
	{
		//insert to tax
		$count = mysql_query("SELECT ID_Tax as 'Flag' FROM tax ORDER BY ID_Tax DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO tax VALUES (
			CONCAT('TAX', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT tx.ID_Tax FROM tax tx ORDER BY tx.ID_Tax DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$name."','".($tax/100)."','Active')");
		}
		else
		{			
			mysql_query("INSERT INTO tax  VALUES (
			CONCAT('TAX', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$name."','".($tax/100)."','Active')");
		}
		
		//get last id tax
		$result = mysql_query("SELECT ID_Tax FROM tax ORDER BY ID_Tax DESC LIMIT 1");
		if( $row = mysql_fetch_array($result) ){
			$idTax = $row['ID_Tax'];
		}
		
		//insert to tax_history
		$count2 = mysql_query("SELECT ID_Tax_History as 'Flag' FROM tax_history ORDER BY ID_Tax_History DESC LIMIT 1") or die(mysql_error());
		
		$temp2;
		while ($row = mysql_fetch_array($count2)) {
			$temp2 = $row[0];
		}
		
		if((SUBSTR(strval($temp2), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO tax_history VALUES (
			CONCAT('TXH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT th.ID_Tax_History FROM tax_history th ORDER BY th.ID_Tax_History DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idTax."','".$name."','".($tax/100)."','".$idUser."','Insert',now())");
		}
		else
		{			
			mysql_query("INSERT INTO tax_history VALUES (
			CONCAT('TXH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idTax."','".$name."','".($tax/100)."','".$idUser."','Insert',now())");
		}
		
		header("location:tax.php");
	}
	
	function duplicateCheck($name)
	{
		$duplicateCheck = mysql_query("SELECT Tax_Name FROM tax WHERE Tax_Name = '".$name."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			return false;
		}
		return true;
	}

	
?>