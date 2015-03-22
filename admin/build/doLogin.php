<?php
	session_start();
	include("select_db.php");
	
	$user = $_POST['username'];
	$pass = $_POST['password'];
	
	if($user == "" || $pass == ""){
		header("location:sign-in.php?errorMsg=Username and Password must be filled!!");
	}
	else{
		$result = mysql_query("SELECT * FROM user WHERE Username = '".$user."' AND Password = '".$pass."' AND Status='Active'");
		if( $row = mysql_fetch_array($result) ){
			$_SESSION['idUser'] = $row['ID_User'];
			$_SESSION['role'] = $row['Role'];
			$_SESSION['name'] = $row['Name'];
			header("location:index.php");
		}
		else{
			header("location:sign-in.php?errorMsg=Invalid Username or Password!");
		}
	}
?>