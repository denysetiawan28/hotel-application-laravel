<?php
	include("select_db.php");
	$idBooking = $_GET['idBooking'];

	$detail="SELECT rt.RoomType_Name, db.Quantity, db.Price, db.Price_Status FROM detail_booking db INNER JOIN roomtype rt ON db.ID_RoomType=rt.ID_RoomType WHERE db.ID_Booking='".$idBooking."'";
	//$detail="SELECT rt.RoomType_Name, db.Quantity, db.Price FROM book db INNER JOIN roomtype rt ON db.ID_RoomType=rt.ID_RoomType";
	$result = mysql_query($detail);
		echo '<table class="table">
            <thead>
            <tr>
              <th>RoomType_Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Price Status</th>
            </tr>
			</thead>';
	while($row = mysql_fetch_array($result)) {
		echo 
            '<tbody>
			<tr>
			  <td>'.$row['RoomType_Name'].'</td>
			  <td>'.$row['Quantity'].'</td>
			  <td>'.$row['Price'].'</td>
			  <td>'.$row['Price_Status'].'</td>
			</tr>
            </tbody>
          ';
	} 	
		echo '</table><br/><br/>';
	
	
	$guest="SELECT CONCAT(gs.First_Name,' ',gs.Last_Name) AS Guest_Name, gs.No_identity, gs.Email, gs.Telephone, gs.Address, gs.Country, gs.City, gs.State, gs.Post_code FROM guest gs INNER JOIN booking bo ON gs.ID_Booking=bo.ID_Booking WHERE bo.ID_Booking='".$idBooking."'";
	//$guest="SELECT gs.Title, gs.First_Name, gs.Last_Name, gs.No_identity, gs.Email, gs.Telephone, gs.Address, gs.Country, gs.City, gs.State, gs.Post_code FROM guest gs INNER JOIN book bo ON gs.ID_Booking=bo.ID_Booking";
	$result2 = mysql_query($guest);
		echo '<table class="table">
            <thead>
            <tr>
              <th>Guest Name</th>
              <th>No Identity</th>
              <th>Email</th>
              <th>Telephone</th>
              <th>Address</th>
              <th>Country</th>
              <th>City</th>
              <th>State</th>
              <th>Post Code</th>
            </tr>
			</thead>';
	while($row2 = mysql_fetch_array($result2)) {
		echo 
			'<tbody>
			<tr>
			  <td>'.$row2['Guest_Name'].'</td>
			  <td>'.$row2['No_identity'].'</td>
			  <td>'.$row2['Email'].'</td>
			  <td>'.$row2['Telephone'].'</td>
			  <td>'.$row2['Address'].'</td>
			  <td>'.$row2['Country'].'</td>
			  <td>'.$row2['City'].'</td>
			  <td>'.$row2['State'].'</td>
			  <td>'.$row2['Post_code'].'</td>
			</tr>
            </tbody>';
    } 	
		echo '</table><br/><br/>';
	
	
	$extra="SELECT ex.Arrival_time, ex.Flight_detail, ex.Description FROM extra ex INNER JOIN booking bo ON ex.ID_Booking=bo.ID_Booking WHERE bo.ID_Booking='".$idBooking."'";
	//$extra="SELECT ex.Arrival_time, ex.Flight_detail, ex.Description FROM extra ex INNER JOIN book bo ON ex.ID_Booking=bo.ID_Booking";
	$result3 = mysql_query($extra);
		echo '<table class="table">
            <thead>
            <tr>
              <th>Arrival Time</th>
              <th>Flight_detail</th>
              <th>Description</th>
            </tr>
			</thead>';
	while($row3 = mysql_fetch_array($result3)) {
		echo 
			'<tbody>
			<tr>
			  <td>'.$row3['Arrival_time'].'</td>
			  <td>'.$row3['Flight_detail'].'</td>
			  <td>'.$row3['Description'].'</td>
			</tr>
            </tbody>';
    } 	
		echo '</table><br/><br/>';
		
	
	$payment="SELECT py.Credit_Type, py.Credit_Number, py.Credit_Holder, py.Credit_Expiry FROM payment py INNER JOIN booking bo ON py.ID_Booking=bo.ID_Booking WHERE bo.ID_Booking='".$idBooking."'";	
	//$payment="SELECT py.Credit_Type, py.Credit_Number, py.Credit_CVV,  py.Credit_Name, py.Credit_Expiry FROM payment py INNER JOIN book bo ON py.ID_Booking=bo.ID_Booking";
	$result4 = mysql_query($payment);
		echo '<table class="table">
            <thead>
            <tr>
              <th>Credit Type</th>
              <th>Credit Number</th>
			  <th>Credit Holder</th>
			  <th>Credit Expiry</th>
            </tr>
			</thead>';
	while($row4 = mysql_fetch_array($result4)) {
		echo 
			'<tbody>
			<tr>
			  <td>'.$row4['Credit_Type'].'</td>
			  <td>'.$row4['Credit_Number'].'</td>
			  <td>'.$row4['Credit_Holder'].'</td>
			  <td>'.$row4['Credit_Expiry'].'</td>
			</tr>
            </tbody>';
    } 	
		echo '</table><br/><br/>';
		
	
	$additional="SELECT ad.Additional_Name, da.Quantity, da.Price FROM detail_additional da INNER JOIN additional ad ON da.ID_Additional=ad.ID_Additional WHERE da.ID_Booking='".$idBooking."'";	
	$result5 = mysql_query($additional);
		echo '<table class="table">
            <thead>
            <tr>
              <th>Additional Name</th>
              <th>Quantity</th>
			  <th>Price</th>
            </tr>
			</thead>';
	while($row5 = mysql_fetch_array($result5)) {
		echo 
			'<tbody>
			<tr>
			  <td>'.$row5['Additional_Name'].'</td>
			  <td>'.$row5['Quantity'].'</td>
			  <td>'.$row5['Price'].'</td>
			</tr>
            </tbody>';
    } 	
		echo '</table><br/><br/>';
?>