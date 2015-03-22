<?php
	include("select_db.php");
	include("picture_path.php");
	
	$idUser = $_SESSION['idUser'];
	$name = $_POST['name'];
	$picture = $_FILES['picture']['name'];
	$temp = $_FILES['picture']['tmp_name'];
	$price = $_POST['price'];
	$capacity = $_POST['capacity'];
	$description = $_POST['description'];
	$facility = $_POST['facility'];


	if($name == "")
	{
		header("location:addRoomType.php?errorMsg=Name must be filled!");
	}
	else if(duplicateCheck($name)==false)
	{
		header("location:addRoomType.php?errorMsg=Please insert different name!");
	}
	else if($_FILES['picture']['error'] != 0)
	{
		header("location:addRoomType.php?errorMsg=Image must be chosen!");
	}
	else if ($_FILES['picture']['type'] != "image/jpg" && $_FILES['picture']['type'] != "image/png" && $_FILES['picture']['type'] != "image/jpeg" && $_FILES['picture']['type'] != "image/gif")
	{
		header("location:addRoomType.php?errorMsg=Image extention must be .jpg or .png or .jpeg. or .gif format!");
	}
	else if($price == "")
	{
		header("location:addRoomType.php?errorMsg=Price must be filled!");
	}
	else if(!ctype_digit($price))
	{
		header("location:addRoomType.php?errorMsg=Price must be numbers!");
	}
	else if($capacity == "")
	{
		header("location:addRoomType.php?errorMsg=Capacity must be filled!");
	}
	else if(!ctype_digit($capacity))
	{
		header("location:addRoomType.php?errorMsg=Capacity must be numbers!");
	}
	else if($description == "")
	{
		header("location:addRoomType.php?errorMsg=Description must be filled!");
	}
	else if($facility == "")
	{
		header("location:addRoomType.php?errorMsg=Facility must be filled!");
	}
	else
	{


		//insert to roomtype
		$count = mysql_query("SELECT ID_RoomType as 'Flag' FROM roomtype ORDER BY ID_RoomType DESC LIMIT 1") or die(mysql_error());
		
		$temp;
		while ($row = mysql_fetch_array($count)) {
			$temp = $row[0];
		}
		
		if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO roomtype VALUES (
			CONCAT('TYP', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT ty.ID_RoomType FROM roomtype ty ORDER BY ty.ID_RoomType DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$name."','".$price."','".$capacity."','".$description."','".$facility."','Active')");
		}
		else
		{			
			mysql_query("INSERT INTO roomtype VALUES (
			CONCAT('TYP', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$name."','".$price."','".$capacity."','".$description."','".$facility."','Active')");
		}
		
		//get id roomtype
		$result = mysql_query("SELECT ID_RoomType FROM roomtype ORDER BY ID_RoomType DESC LIMIT 1");
		if( $row = mysql_fetch_array($result) ){
			$idRoom = $row['ID_RoomType'];
		}
		
		//insert to roomtype_pic
		$ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
		$count3 = mysql_query("SELECT ID_RoomType_Pic as 'Flag' FROM roomtype_pic ORDER BY ID_RoomType_Pic DESC LIMIT 1") or die(mysql_error());
		
		$temp3;
		while ($row = mysql_fetch_array($count3)) {
			$temp3 = $row[0];
		}
		
		if((SUBSTR(strval($temp3), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO roomtype_pic VALUES (
			CONCAT('PIR', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT rp.ID_RoomType_Pic FROM roomtype_pic rp ORDER BY rp.ID_RoomType_Pic DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idRoom."','".$name.".".$ext."','YES')");
		}
		else
		{			
			mysql_query("INSERT INTO roomtype_pic VALUES (
			CONCAT('PIR', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idRoom."','".$name.".".$ext."','YES')");
		}
		
		//insert to roomtype_history
		$count2 = mysql_query("SELECT ID_RoomType_History as 'Flag' FROM roomtype_history ORDER BY ID_RoomType_History DESC LIMIT 1") or die(mysql_error());
		
		$temp2;
		while ($row = mysql_fetch_array($count2)) {
			$temp2 = $row[0];
		}
		
		if((SUBSTR(strval($temp2), 3, -5)) == strval(date("y")))
		{
			mysql_query("INSERT INTO roomtype_history VALUES (
			CONCAT('RTH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
			LPAD((SUBSTR((SELECT rh.ID_RoomType_History FROM roomtype_history rh ORDER BY rh.ID_RoomType_History DESC LIMIT 1),6) + 1 ), 5, 0)),
			'".$idRoom."','".$name."','".$price."','".$capacity."','".$description."','".$facility."','".$idUser."','Insert',now())"		);
		}
		else
		{			
			mysql_query("INSERT INTO roomtype_history VALUES (
			CONCAT('RTH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idRoom."','".$name."','".$price."','".$capacity."','".$description."','".$facility."','".$idUser."','Insert',now())");
		}
		move_uploaded_file($_FILES['picture']['tmp_name'], $pathRoom. $name.'.'.$ext);


        $profile= mysql_query("SELECT * FROM aboutus");
        $hotel= [];
        while($row = mysql_fetch_array($profile,true)){
            $hotel[]=$row;
        }
        $hotel = $hotel[0];
        
        $send= array(
        "nama" => $hotel['Name'], 
        "alamat" => $hotel['Address'], 
        "telephone"=> $hotel['Telephone'], 
        "email"=> $hotel['Email'], 
        "linkweb"=> $hotel['Link_Web'],
        "roomtype"=> array(
        	"name"=>$name,
        	 "price"=>$price, 
        	 "capacity"=>$capacity,
        	  "description"=>$description,
        	   "facility"=>$facility,
        	    "picture"=>"http://protohotel.asia/resources/images/hotel/room/".$name.'.'.$ext));     
                                                                               
        

        $urlDinas = "http://protodinas.asia/integration/addroomtype";
     	$urlAgent = "http://protoagent.asia/project/handler/addroomtype";
     	$urlDesti = "http://protodesti.com/Skripsi2/backend/insertkamarhotel.php";
     	
     	//$sending = [$urlDinas];
     	$sending = "http://server.projectsuroto.com:11223/akomodasi/addroomtype";
        $data_string = json_encode($send);
        $response= [];
        //foreach($sending as $key => $value){
        	$curl = curl_init($sending);
		curl_setopt($curl, CURLOPT_USERAGENT,"Everyday Smart Hotel");
		curl_setopt($curl, CURLOPT_HTTPHEADER,array('akiong: rendy'));  
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		#curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($curl, CURLOPT_TIMEOUT_MS, 60000);
		$response[] = curl_exec($curl);
		curl_close($curl);
        //}
        //header("location:roomType.php");
        print_r($response);
        print_r($data_string);
        die;


		
	}
	
	function duplicateCheck($name)
	{
		$duplicateCheck = mysql_query("SELECT RoomType_Name FROM roomtype WHERE RoomType_Name = '".$name."'");
		while($row = mysql_fetch_array($duplicateCheck)){
			return false;
		}
		return true;
	}

	
?>