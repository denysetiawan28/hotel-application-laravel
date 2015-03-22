<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idTax'];
	$idUser = $_SESSION['idUser'];
	
	//save tax history
	$result = mysql_query("SELECT * FROM tax WHERE ID_Tax = '".$id."'");
	while ($row = mysql_fetch_array($result))
	{
		$idTax = $row['ID_Tax'];
		$name = $row['Tax_Name'];
		$tax = $row['Tax'];
	}
		
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
		'".$idTax."','".$name."','".$tax."','".$idUser."','Delete',now())");
	}
	else
	{
		mysql_query("INSERT INTO tax_history VALUES (
		CONCAT('TXH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
		'".$idTax."','".$name."','".$tax."','".$idUser."','Delete',now())");
	}
	
	//delete tax
	mysql_query("UPDATE tax SET Status='Delete' WHERE ID_Tax = '".$id."'");
	header("location:tax.php");
?>

