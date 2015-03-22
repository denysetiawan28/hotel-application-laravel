<?php
	session_start();
	include("select_db.php");
	include("picture_path.php");
	
	$idUser = $_SESSION['idUser'];
	$idRoom = $_POST['id'];
	$name = $_POST['name'];
	$picture = $_POST['picture'];
	$price = $_POST['price'];
	$capacity = $_POST['capacity'];
	$description = $_POST['description'];
	$facility = $_POST['facility'];
	
	if($name == "")
	{
		header("location:updateRoomType.php?errorMsg=Name must be filled!&idRoom=$idRoom");
	}
	else if(duplicateCheck($name,$idRoom)==false)
	{
		header("location:updateRoomType.php?errorMsg=Please insert different name!&idRoom=$idRoom");
	}
	else if($price == "")
	{
		header("location:updateRoomType.php?errorMsg=Price must be filled!&idRoom=$idRoom");
	}
	else if(!ctype_digit($price))
	{
		header("location:updateRoomType.php?errorMsg=Price must be numbers!&idRoom=$idRoom");
	}
	else if($capacity == "")
	{
		header("location:updateRoomType.php?errorMsg=Capacity must be filled!&idRoom=$idRoom");
	}
	else if(!ctype_digit($capacity))
	{
		header("location:updateRoomType.php?errorMsg=Capacity must be numbers!&idRoom=$idRoom");
	}
	else if($description == "")
	{
		header("location:updateRoomType.php?errorMsg=Description must be filledidRoom=$idRoom!");
	}
	else if($facility == "")
	{
		header("location:updateRoomType.php?errorMsg=Facility must be filled!idRoom=$idRoom");
	}
	else
	{	
		$profile= mysql_query("SELECT * FROM aboutus");
	        $hotel= [];
	        while($row = mysql_fetch_array($profile,true)){
	            $hotel[]=$row;
	        }
	        $hotel = $hotel[0];
	        
	        $roomtype= mysql_query("SELECT rt.RoomType_Name, rt.Price, rt.Capacity, rt.Description, rt.Facility, pc.Picture FROM roomtype rt JOIN roomtype_pic pc ON pc.ID_RoomType=rt.ID_RoomType where pc.ID_RoomType='".$idRoom."' and pc.Main_Pic='YES'");
	        $room= [];
	        while($row = mysql_fetch_array($roomtype,true)){
	            $room[]=$row;
	        }
	        $room= $room[0];
	        echo $room['Picture'];
	        
	        $old= array(
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
	        	   "facility"=>$room['Facility'],
	        	    "picture"=>"http://protohotel.asia/resources/images/hotel/room/".$room['Picture']));
        	    
        	    /*
		//update roomtype
		mysql_query("UPDATE roomtype SET RoomType_Name='".$name."', Price= '".$price."', Capacity='".$capacity."', Description='".$description."', Facility='".$facility."' WHERE ID_RoomType='".$idRoom."'");
		
		
		//save roomtype history
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
			'".$idRoom."','".$name."','".$price."','".$capacity."','".$description."','".$facility."','".$idUser."','Update',now())");
		}
		else
		{
			mysql_query("INSERT INTO roomtype_history VALUES (
			CONCAT('RTH', SUBSTRING(YEAR(CURRENT_TIMESTAMP),3,2), '00001'),
			'".$idRoom."','".$name."','".$price."','".$capacity."','".$description."','".$facility."','".$idUser."','Update',now())");
		}
		*/
		
	$new= array(
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
        	    "picture"=>"http://protohotel.asia/resources/images/hotel/room/".$room['Picture']));     
             
                                                                               
        $send = 
        [
	   "hotel"=>
	        [
	            "old"=>$old,
	            "new"=>$new
	        ]
        ];


	$urlDinas = "http://protodinas.asia/integration/updateroomtype";
     	$urlAgent = "http://protoagent.asia/project/handler/updateroomtype";
     	$urlDesti = "http://protodesti.com/Skripsi2/backend/updatekamarhotel.php";
     	
     	//$sending = [$urlDinas];
     	$sending = "http://server.projectsuroto.com:11223/akomodasi/updateroomtype";
        $data_string = json_encode($send);
        $response= [];
        //foreach($sending as $key => $value){
        	$curl = curl_init($sending);
		curl_setopt($curl, CURLOPT_USERAGENT,"Everyday Smart Hotel");
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($curl, CURLOPT_TIMEOUT_MS, 1);
		$response[] = curl_exec($curl);
        //}
        print_r($response);
        print_r($data_string);
        //header("location:roomType.php");
        die;
      
		
	}
	
	
	function duplicateCheck($name,$idRoom)
	{
		$cekID = mysql_query("SELECT ID_RoomType, RoomType_Name FROM roomtype WHERE ID_RoomType = '".$idRoom."'");
		while($row = mysql_fetch_array($cekID))
		{
			$currentID = $row[0];
			$currentName = $row[1];
		}
	
		$duplicateCheck = mysql_query("SELECT ID_RoomType, RoomType_Name FROM roomtype WHERE RoomType_Name = '".$name."'");
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