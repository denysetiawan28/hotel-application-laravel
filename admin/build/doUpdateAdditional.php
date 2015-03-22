<?php
	session_start();
	include("select_db.php");
	
	$idUser = $_SESSION['idUser'];
	$idAdd = $_POST['id'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$description = $_POST['description'];	
	$qty= $_POST['qty'];
	
	if($name == "")
	{
		header("location:updateAdditional.php?errorMsg=Name must be filled!&idAdd=$idAdd");
	}
	else if(duplicateCheck($name,$idAdd)==false)
	{
		header("location:updateAdditional.php?errorMsg=Please insert different name!&idAdd=$idAdd");
	}
	else if($price == "")
	{
		header("location:updateAdditional.php?errorMsg=Price must be filled!&idAdd=$idAdd");
	}
	else if(!ctype_digit($price))
	{
		header("location:updateAdditional.php?errorMsg=Price must be number!&idAdd=$idAdd");
	}
	else if($description == "")
	{
		header("location:updateAdditional.php?errorMsg=Description must be filled!&idAdd=$idAdd");
	}
	else
	{		
		//update additional
		mysql_query("UPDATE additional SET Additional_Name='".$name."', Price= '".$price."' , Description= '".$description."', Quantity= '".$qty."' WHERE ID_Additional='".$idAdd."'");
		
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
			'".$idAdd."','".$name."','".$price."','".$description."','".$qty."','".$idUser."','Update',now())");
		}
		else
		{			
			mysql_query("INSERT INTO additional_history VALUES (
			CONCAT('ADH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idAdd."','".$name."','".$price."','".$description."','".$qty."','".$idUser."','Update',now())");
		}
		
		header("location:additional.php");
	}
	
	
	function duplicateCheck($name,$idAdd)
	{
		$cekID = mysql_query("SELECT ID_Additional, Additional_Name FROM additional WHERE ID_Additional = '".$idAdd."'");
		while($row = mysql_fetch_array($cekID))
		{
			$currentID = $row[0];
			$currentName = $row[1];
		}
	
		$duplicateCheck = mysql_query("SELECT ID_Additional, Additional_Name FROM additional WHERE Additional_Name = '".$name."'");
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