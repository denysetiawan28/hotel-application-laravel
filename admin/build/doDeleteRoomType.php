<?php

	include("select_db.php");
	
	$id = $_GET['idRoom'];
	$idUser = $_SESSION['idUser'];
	
	
	//save roomtype history
	$result = mysql_query("SELECT * FROM roomtype WHERE ID_RoomType = '".$id."'");
	while ($row = mysql_fetch_array($result))
	{
		$idRoom = $row['ID_RoomType'];
		$name = $row['RoomType_Name'];
		$price = $row['Price'];
		$capacity = $row['Capacity'];
		$description = $row['Description'];
		$facility = $row['Facility'];
	}
		
	$count = mysql_query("SELECT ID_RoomType_History as 'Flag' FROM roomtype_history ORDER BY ID_RoomType_History DESC LIMIT 1") or die(mysql_error());
	
	$temp;
	while ($row = mysql_fetch_array($count)) {
		$temp = $row[0];
	}
	
	if((SUBSTR(strval($temp), 3, -5)) == strval(date("y")))
	{
		mysql_query("INSERT INTO roomtype_history VALUES (
		CONCAT('RTH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), 
		LPAD((SUBSTR((SELECT rh.ID_RoomType_History FROM roomtype_history rh ORDER BY rh.ID_RoomType_History DESC LIMIT 1),6) + 1 ), 5, 0)),
		'".$idRoom."','".$name."','".$price."','".$capacity."','".$description."','".$facility."','".$idUser."','Delete',now())");
	}
	else
	{
		mysql_query("INSERT INTO roomtype_history VALUES (
		CONCAT('RTH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
		'".$idRoom."','".$name."','".$price."','".$capacity."','".$description."','".$facility."','".$idUser."','Delete',now())");
	}
	
	//delete roomtype
	mysql_query("UPDATE roomtype SET Status='Delete' WHERE ID_RoomType = '".$idRoom."'");


        $profile= mysql_query("SELECT * FROM aboutus where ID_Aboutus = '1'");
        $hotel= [];
        while($row = mysql_fetch_array($profile,true)){
            $hotel[]=$row;
        }
	//print_r($hotel);
        $chek= mysql_query("SELECT * FROM roomtype WHERE ID_RoomType='".$id."'");
        $room= [];
        while($row = mysql_fetch_array($chek,true)){
            $room[]=$row;
        }
        $room= $room[0];
        $hotel=$hotel[0];
	
        $send= array(
        "nama" => $hotel['Name'], 
        "alamat" => $hotel['Address'], 
        "telephone"=> $hotel['Telephone'], 
        "email"=> $hotel['Email'], 
        "linkweb"=> $hotel['Link_Web'],
        "roomtype"=> array(
        	"name"=>$room['RoomType_Name'],
        	 "price"=>$room['Price'], 
        	 "capacity"=>$room['Capacity'],
        	  "description"=>$room['Description'],
        	   "facility"=>$room['Facility']
        	   ));     
                                                                               
        //print_r($send);

        //$data_string = json_encode($data);
	//print_r($data_string );
	$urlDinas = "http://protodinas.asia/integration/deleteroomtype";
     	$urlAgent = "http://protoagent.asia/project/handler/deleteroomtype";
     	$urlDesti = "http://protodesti.com/Skripsi2/backend/deletekamarhotel.php";
     	
     	//$sending = [$urlDinas];
     	$sending = "http://server.projectsuroto.com:11223/akomodasi/deleteroomtype";
        $data_string = json_encode($send);
        $response= [];
        //foreach($sending as $key => $value){
        	$curl = curl_init($sending);
		curl_setopt($curl, CURLOPT_USERAGENT,"Everyday Smart Hotel");
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response[] = curl_exec($curl);
        //}
        print_r($response);
        print_r($data_string);
        //header("location:roomType.php");
        die;

?>