<?php
	include("select_db.php");
	include("picture_path.php");
	$idAboutUs = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$telp = $_POST['telp'];
	$email = $_POST['email'];
	$about = $_POST['about'];
	$concept = $_POST['concept'];
	$vision = $_POST['vision'];
	$mision = $_POST['mision'];
	$web = $_POST['web'];
	$book = $_POST['book'];
	
	if($name == "")
	{
		header("location:aboutus.php?errorMsg=Name must be filled!&id=$idAboutUs");
	}
	else if($address == "")
	{
		header("location:aboutus.php?errorMsg=Address must be filled!&id=$idAboutUs");
	}
	else if($telp == "")
	{
		header("location:aboutus.php?errorMsg=Telephone must be filled!&id=$idAboutUs");
	}
	else if(!ctype_digit($telp))
	{
		header("location:aboutus.php?errorMsg=Telephone must be number!&id=$idAboutUs");
	}
	else if($email == "")
	{
		header("location:aboutus.php?errorMsg=Email must be filled!&id=$idAboutUs");
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("location:aboutus.php?errorMsg=Invalid Email format!&id=$idAboutUs");
	}
	else if($about == "")
	{
		header("location:aboutus.php?errorMsg=About must be filled!&id=$idAboutUs");
	}
	else if($concept == "")
	{
		header("location:aboutus.php?errorMsg=Concept must be filled!&id=$idAboutUs");
	}
	else if($vision == "")
	{
		header("location:aboutus.php?errorMsg=Vision must be filled!&id=$idAboutUs");
	}
	else if($mision == "")
	{
		header("location:aboutus.php?errorMsg=Mision must be filled!&id=$idAboutUs");
	}
	else if($web == "")
	{
		header("location:aboutus.php?errorMsg=Link Web must be filled!&id=$idAboutUs");
	}
	else if($book == "")
	{
		header("location:aboutus.php?errorMsg=Link Book must be filled!&id=$idAboutUs");
	}
	else
	{	/*
		//update aboutus
		mysql_query("UPDATE aboutus SET Name='".$name."', Address='".$address."', Telephone='".$telp."', Email='".$email."', About='".$about."', Vision='".$vision."', Mision='".$mision."', Link_Web='".$web."', Link_Book='".$book."' WHERE ID_Aboutus='".$idAboutUs."'");
		
		header("location:aboutus.php?id=1");
*/

        $data = mysql_query("SELECT * FROM aboutus LIMIT 1");
        $profile = [];
        while($row = mysql_fetch_array($data, true)){
            $profile[]=$row;
        }
        $profile= $profile[0];

        $gallery = mysql_query("SELECT * FROM gallery where Status='Main'");
        $gambar = [];
        while($row = mysql_fetch_array($gallery, true)){
            $gambar[]=$row;
        }   
        $gambar= $gambar[0];
        
        $fasilitasHotel= [];
        $query = mysql_query("SELECT Facility_Name FROM facility where Status='Active'");
        while($row = mysql_fetch_array($query,true)){
        	$fasilitasHotel[] = $row;
        }
        
	$data = [];
	foreach($fasilitasHotel as $k=>$v){
		foreach($v as $key=>$value)
			$data[]=$value;
	} 
	
	$gallery= [];
        $queryy = mysql_query("SELECT Gallery_Picture FROM gallery where Status!='Delete'");
        while($row = mysql_fetch_array($queryy,true)){
        	$gallery[] = $row;
        }
        
	$dataa = [];
	foreach($gallery as $k=>$v){
		foreach($v as $key=>$value)
			$dataa[]="http://protohotel.asia/resources/images/hotel/gallery/".$value;
	}           

	$old = array(
        "logo" => "http://protohotel.asia/resources/icon/".$profile['Logo'], 
        "nama" => $profile['Name'], 
        "alamat" => $profile['Address'], 
        "telephone"=> $profile['Telephone'], 
        "email"=> $profile['Email'], 
        "latitude"=> $profile['Latitude'],
        "longitude"=>$profile['Longitude'], 
        "linkweb"=>$profile['Link_Web'], 
        "linkbook"=>$profile['Link_Book'],
        "gambar"=>$dataa,
        "fasilitas"=>$data
        ); 
        
        
        mysql_query("UPDATE aboutus SET Name='".$name."', Address='".$address."', Telephone='".$telp."', Email='".$email."', About='".$about."', Vision='".$vision."', Mision='".$mision."', Link_Web='".$web."', Link_Book='".$book."' WHERE ID_Aboutus='".$idAboutUs."'");
	
	
        $new = array(
         "logo" => "http://protohotel.asia/resources/icon/".$profile['Logo'], 
         "nama" => $name,
         "alamat" => $address,
         "telephone" => $telp,
         "email"=> $email,
         "latitude" => $profile['Latitude'],
         "longitude" => $profile['Longitude'],
         "linkweb" => $web,
         "linkbook" => $book,
         "gambar"=>$dataa,
         "fasilitas"=>$data
         );                                                      
        
        $send = 
        [
	   "hotel"=>
	        [
	            "old"=>$old,
	            "new"=>$new
	        ]
        ];
     	
     	//$urlDinas = "http://protodinas.asia/integration/updateakomodasi";
     //	$urlAgent = "http://protoagent.asia/project/handler/updateakomodasi";
     	$urlDesti= "http://protodesti.com/Skripsi2/backend/inserthotel.php";
     	
     	$sending= "http://server.projectsuroto.com:11223/updateakomodasi";
     	//$sending = [$urlAgent, $urlDinas, $urlDesti];
     	$data_string = json_encode($send);
        $response= [];
        //foreach($sending as $key => $value){
        	$curl = curl_init($sending);
		curl_setopt($curl, CURLOPT_USERAGENT,"Everyday Smart Hotel");
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response[] = curl_exec($curl);

		//set_time_limit(0);
		//$result = curl_exec($curl); 
		//print_r(curl_getinfo($curl));
		//print_r($result);
		//print_r($response);
		//print_r($data_string);
		//header("location:aboutus.php?id=1");
		curl_close($curl);
        //}
       
        header("location:aboutus.php?id=1");
        //print_r(curl_getinfo($curl));
	//print_r($response);
	//print_r($response);
	
        die;/**/
	
	
	
        
	}


	
?>