<?php
	session_start();
	
	include("select_db.php");
	include("picture_path.php");
	$idUser = $_SESSION['idUser'];
	$title = $_POST['title'];
	$file = $_FILES['filename']['name'];
	$description = $_POST['description'];
	$from = $_POST['from'];
	$until = $_POST['until'];
	$detail = $_POST['roomDetail'];
	
	$id_arr = array();
	$price_arr = array();
	
	
	
	//print_r( count($detail) );
	foreach( $detail as $details ){
		//echo $temp.'<br/>';
		$temp = explode("-",$details);
		$id_arr = array_values($id_arr);
		$id_arr[] = $temp[0];
		
		$price_arr = array_values($price_arr);
		$price_arr[] = $temp[2];
	}
	
	/*for($i = 0;$i < count($id_arr);$i++)
		{
			echo $id_arr[$i];
			echo $price_arr[$i];
			
		}*/
		
	// count($id_arr) -> untuk ambil banyak array
	
	/*if(isset($_POST['submit'])){
	$selected_val = $_POST['roomDetail'];  // Storing Selected Value In Variable
	echo "You have selected :" .$selected_val;  // Displaying Selected Value
	}
	
	$detail = json_decode($_POST['id']);
	for($i = 1;$i < count($detail);$i++)
		{
			echo $detail[$i];
		
		}
	
	if($_POST) 
	{
        echo "<pre>";
        print_r($_POST['roomDetail']);
        echo "</pre>";
	}	
	
	
	if ($_SERVER['REQUEST_METHOD']=='post') {
		$array = $_POST['roomDetail'];
		echo $array;
	}*/
	
	if($title == "")
	{
		header("location:addOffer.php?errorMsg=Name must be filled!");
	}
	else if($_FILES['filename']['error'] != 0)
	{
		header("location:addOffer.php?errorMsg=Image must be chosen!");
	}
	else if($description == "")
	{
		header("location:addOffer.php?errorMsg=Description must be filled!");
	}
	else if($from == "")
	{
		header("location:addOffer.php?errorMsg=From Date must be filled!");
	}
	else if($until == "")
	{
		header("location:addOffer.php?errorMsg=From Date must be filled!");
	}
	else if($from > $until)
	{
		header("location:addOffer.php?errorMsg=From Date cannot can not be smaller than  Until Date!");
	}
	else
	{
		//insert to offer
		$count = mysql_query("SELECT ID_Offer as 'Flag' FROM offer ORDER BY ID_Offer DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO offer VALUES (
			CONCAT('OFR', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT of.ID_Offer FROM offer of ORDER BY of.ID_Offer DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$title."','".$file."','".$description."','".$from."','".$until."','Active')");
		}
		else
		{			
			mysql_query("INSERT INTO offer VALUES (
			CONCAT('OFR', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$title."','".$file."','".$description."','".$from."','".$until."','Active')");
		}
		
		
		//get last id offer
		$result = mysql_query("SELECT ID_Offer as 'Flag' FROM offer ORDER BY ID_Offer DESC LIMIT 1");
		if( $row = mysql_fetch_array($result) ){
			$idOffer = $row[0];
		}
	
		//insert to offer_history
		$count2 = mysql_query("SELECT ID_Offer_History as 'Flag' FROM offer_history ORDER BY ID_Offer_History DESC LIMIT 1") or die(mysql_error());
		
		$temp2;
		while ($row2 = mysql_fetch_array($count2)) {
			$temp2 = $row2[0];
		}
		
		if((SUBSTR(strval($temp2), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO offer_history VALUES (
			CONCAT('OFH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT oh.ID_Offer_History FROM offer_history oh ORDER BY oh.ID_Offer_History DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idOffer."','".$title."','".$file."','".$description."','".$from."','".$until."','".$idUser."','Insert',now())");
		}
		else
		{			
			mysql_query("INSERT INTO offer_history VALUES (
			CONCAT('OFH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idOffer."','".$title."','".$file."','".$description."','".$from."','".$until."','".$idUser."','Insert',now())");
		}
		
		//get last id offer history
		$result2 = mysql_query("SELECT ID_Offer_History FROM offer_history ORDER BY ID_Offer_History DESC LIMIT 1");
		if( $row2 = mysql_fetch_array($result2) ){
			$idHistory = $row2['ID_Offer_History'];
		}

		//insert detail offer n detail offer history
		for($i = 0;$i < count($id_arr);$i++)
		{
			mysql_query("INSERT INTO detail_offer VALUES (
			'".$idOffer."','".$id_arr[$i]."','".$price_arr[$i]."')");
			
			mysql_query("INSERT INTO detail_offer_history VALUES (
			'".$idHistory."','".$idOffer."','".$id_arr[$i]."','".$price_arr[$i]."')");
		
		}	
		
		header("location:offer.php");
		move_uploaded_file($_FILES['filename']['tmp_name'], $pathOffer.$file);
		
	}
	
	
?>