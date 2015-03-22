<?php
	session_start();
	include("select_db.php");
	
	$id = $_GET['idOffer'];
	$idUser = $_SESSION['idUser'];
	
	
	//save offer history
	$result = mysql_query("SELECT * FROM offer WHERE ID_Offer = '".$id."'");
	while ($row = mysql_fetch_array($result))
	{
		$idOffer = $row['ID_Offer'];
		$title = $row['Title'];
		$file = $row['File'];
		$description = $row['Description'];
		$from = $row['From_Date'];
		$until = $row['Until_Date'];
	}
		
	$count = mysql_query("SELECT ID_Offer_History as 'Flag' FROM offer_history ORDER BY ID_Offer_History DESC LIMIT 1") or die(mysql_error());
	
	$temp;
	while ($row = mysql_fetch_array($count)) {
		$temp = $row[0];
	}
	
	if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
	{
		mysql_query("INSERT INTO offer_history VALUES (
		CONCAT('OFH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
		LPAD((SUBSTR((SELECT oh.ID_Offer_History FROM offer_history oh ORDER BY oh.ID_Offer_History DESC LIMIT 1),6) + 1 ), 5, 0)),
		'".$idOffer."','".$title."','".$file."','".$description."','".$from."','".$until."','".$idUser."','Delete',now())");
	}
	else
	{
		mysql_query("INSERT INTO offer_history VALUES (
		CONCAT('OFH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
		'".$idOffer."','".$title."','".$file."','".$description."','".$from."','".$until."','".$idUser."','Delete',now())");
	}
	
	//get id offer history
	$result = mysql_query("SELECT ID_Offer_History FROM offer_history ORDER BY ID_Offer_History DESC LIMIT 1");
	while ($row = mysql_fetch_array($result))
	{
		$idHistory = $row['ID_Offer_History'];
	}
	
	//insert to detail offer history
	detail = mysql_query("SELECT * FROM detail_offer WHERE ID_Offer = '".$id."'");
	while($row = mysql_fetch_array($detail))
	{
		mysql_query("INSERT INTO detail_offer_history VALUES (
		'".$idHistory."','".$idOffer."','".$row['ID_RoomType']."','".$row['Price']."')");
	}
	
	//delete offer
	mysql_query("UPDATE offer SET Status='Delete' WHERE ID_Offer = '".$id."'");
	header("location:offer.php");
?>

