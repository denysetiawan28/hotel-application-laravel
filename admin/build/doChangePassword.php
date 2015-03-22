<?php
	session_start();
	include("select_db.php");
	
	$id = $_SESSION['id'];
	$old = $_POST['oldPassword'];
	$new = $_POST['newPassword'];
	$cnfrm = $_POST['cnfrmPassword'];
	
	if($old == "" && $new == "" && $cnfrm == ""){
		header("location:changePassword.php?errorMsg=All field must be filled!");
	}
	else if($old == ""){
		header("location:changePassword.php?errorMsg=Old password must be filled!");
	}
	else if($new == ""){
		header("location:changePassword.php?errorMsg=New password must be filled!");
	}
	else if($cnfrm == ""){
		header("location:changePassword.php?errorMsg=Confirm new password must be filled!");
	}
	else if($new != $cnfrm ){
		header("location:changePassword.php?errorMsg=New Password and Confirm New Password must be same!");
	}
	else{
		$result = mysql_query("SELECT Password FROM user WHERE ID_User = '".$id."' AND Password = '".$old."'");
		if( $row = mysql_fetch_array($result) ){
			mysql_query("UPDATE user SET Password = '".$new."' WHERE ID_User = '".$id."'");
			header("location:changePassword.php?errorMsg=Success change your password!");
		}else 
		{
			header("location:changePassword.php?errorMsg=Please enter your correct old password!");
		}
		
	}
?>