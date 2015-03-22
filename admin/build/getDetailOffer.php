<?php
	include("select_db.php");
	$idHistory = $_GET['idHistory'];

	$detail="SELECT rt.RoomType_Name, do.Promo FROM detail_offer_history do INNER JOIN roomtype rt ON do.ID_RoomType=rt.ID_RoomType WHERE ID_Offer_History='".$idHistory."'";
	//$detail="SELECT rt.RoomType_Name, db.Quantity, db.Price FROM book db INNER JOIN roomtype rt ON db.ID_RoomType=rt.ID_RoomType";
	$result = mysql_query($detail);
		echo '<table class="table">
            <thead>
            <tr>
              <th>RoomType_Name</th>
              <th>Promo</th>
            </tr>
			</thead>';
	while($row = mysql_fetch_array($result)) {
		echo 
            '<tbody>
			<tr>
			  <td>'.$row['RoomType_Name'].'</td>
			  <td>'.$row['Promo'].'</td>
			</tr>
            </tbody>
          ';
	} 	
		echo '</table><br/><br/>';
	
?>