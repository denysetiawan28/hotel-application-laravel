<?php
	session_start();
	include("select_db.php");
	
	$idUser = $_SESSION['idUser'];
	$idTax = $_POST['id'];
	$name = $_POST['name'];
	$tax = $_POST['tax'];
	
	if($name == "")
	{
		header("location:updateTax.php?errorMsg=Name must be filled!&idTax=$idTax");
	}
	else if(duplicateCheck($name,$idTax)==false)
	{
		header("location:updateTax.php?errorMsg=Please insert different name!&idTax=$idTax");
	}
	else if($tax == "")
	{
		header("location:updateTax.php?errorMsg=Tax must be filled!&idTax=$idTax");
	}
	else if(!ctype_digit($tax))
	{
		header("location:updateTax.php?errorMsg=Tax must be number!&idTax=$idTax");
	}
	else
	{		
		//update tax
		mysql_query("UPDATE tax SET Tax_Name='".$name."', Tax= '".($tax/100)."' WHERE ID_Tax='".$idTax."'");
		
		
		//save tax history
		$count = mysql_query("SELECT ID_Tax_History as 'Flag' FROM tax_history ORDER BY ID_Tax_History DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO tax_history VALUES (
			CONCAT('TXH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT th.ID_Tax_History FROM tax_history th ORDER BY th.ID_Tax_History DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idTax."','".$name."','".($tax/100)."','".$idUser."','Update',now())");
		}
		else
		{
			mysql_query("INSERT INTO tax_history VALUES (
			CONCAT('TXH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idTax."','".$name."','".($tax/100)."','".$idUser."','Update',now())");
		}
		
		header("location:tax.php");
	}
	
	
	function duplicateCheck($name,$idTax)
	{
		$cekID = mysql_query("SELECT ID_Tax, Tax_Name FROM tax WHERE ID_Tax = '".$idTax."'");
		while($row = mysql_fetch_array($cekID))
		{
			$currentID = $row[0];
			$currentName = $row[1];
		}
	
		$duplicateCheck = mysql_query("SELECT ID_Tax, Tax_Name FROM tax WHERE Tax_Name = '".$name."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			if($row[0]==$currentID && $row[1]==$currentName)
			{
				return true;
				break;
			}
			else
				return false;
		}
		return true;
	}
	
?>