<?php
	session_start();
	include("select_db.php");

	$idUser = $_SESSION['idUser'];
	$idOffer = $_POST['idOffer'];
	$title = $_POST['titles'];
	$file = $_POST['filename'];
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
	
		for($i = 0;$i < count($id_arr);$i++)
		{
			echo $id_arr[$i];
			echo $price_arr[$i];
			
		}	
		
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
		header("location:updateOffer.php?errorMsg=Name must be filled!&idOffer=$idOffer");
	}
	else if($description == "")
	{
		header("location:addOffer.php?errorMsg=Description must be filled!&idOffer=$idOffer");
	}
	else if($from == "")
	{
		header("location:addOffer.php?errorMsg=From Date must be filled!&idOffer=$idOffer");
	}
	else if($from >= $until)
	{
		header("location:addOffer.php?errorMsg=From Date cannot can not be greater than Until Date!&idOffer=$idOffer");
	}
	else if($until == "")
	{
		header("location:addOffer.php?errorMsg=From Date must be filled!&idOffer=$idOffer");
	}
	else if($from == $until)
	{
		header("location:addOffer.php?errorMsg=From Date cannot be same with Until Date!&idOffer=$idOffer");
	}
	else
	{
		//update offer
		mysql_query("UPDATE offer SET Title='".$title."', File='".$file."', Description='".$description."', From_Date='".$from."', Until_Date='".$until."' WHERE ID_Offer='".$idOffer."'");
		
		
		//save offer_history
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
			'".$idOffer."','".$title."','".$file."','".$description."','".$from."','".$until."','".$idUser."','Update',now())");
		}
		else
		{			
			mysql_query("INSERT INTO offer_history VALUES (
			CONCAT('OFH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idOffer."','".$title."','".$file."','".$description."','".$from."','".$until."','".$idUser."','Update',now())");
		}
		
		//get last id offer history
		$result2 = mysql_query("SELECT ID_Offer_History FROM offer_history ORDER BY ID_Offer_History DESC LIMIT 1");
		if( $row2 = mysql_fetch_array($result2) ){
			$idHistory = $row2[0];
		}

		//insert detail offer n detail offer history
		mysql_query("DELETE FROM detail_offer WHERE ID_Offer = '".$idOffer."'");
		for($i = 0;$i < count($id_arr);$i++)
		{
			mysql_query("INSERT INTO detail_offer VALUES (
			'".$idOffer."','".$id_arr[$i]."','".$price_arr[$i]."')");
			
			mysql_query("INSERT INTO detail_offer_history VALUES (
			'".$idHistory."','".$idOffer."','".$id_arr[$i]."','".$price_arr[$i]."')");
		
		}	
		
		header("location:offer.php");
		//move_uploaded_file($_FILES['filename']['tmp_name'], "images/offer/" . $file);
		
	}
	
	
?>