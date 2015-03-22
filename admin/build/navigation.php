<?php
	if( !isset($_SESSION['name']) ){
		header("location:sign-in.php");
	}

?>

<!DOCTYPE html>
<html lang="en">
	<body>
		<div class="sidebar-nav">
        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><a href="index.php">Home</a></li>
        </ul>

        <?php if ($_SESSION['role'] == 'Admin') { ?>
        <a href="users.php" class="nav-header" ><i class="icon-user"></i>Manage Users</a>
        
        <a href="#room-menu" class="nav-header collapsed" data-toggle="collapse" ><i class="icon-briefcase"></i>Manage Rooms<i class="icon-chevron-up"></i></a>
        <ul id="room-menu" class="nav nav-list collapse">
            <li><a href="roomType.php">Room Type</a></li>
            <li><a href="facility.php">Facility</a></li>
        </ul>
        
        <a href="#charges-menu" class="nav-header collapsed" data-toggle="collapse" ><i class="icon-money"></i>Manage Charges<i class="icon-chevron-up"></i></a>
        <ul id="charges-menu" class="nav nav-list collapse">
            <!--<li><a href="roomTypePrice.php">Room Type</a></li>-->
            <li><a href="tax.php">Tax</a></li>
            <li><a href="additional.php">Additional</a></li>
        </ul>
        
        <a href="#info-menu" class="nav-header collapsed" data-toggle="collapse" ><i class="icon-asterisk"></i> Manage Information<i class="icon-chevron-up"></i></a>
        <ul id="info-menu" class="nav nav-list collapse">
            <li><a href="news.php">News</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="offer.php">Offer</a></li>
        </ul>
        
        <a href="#hotel-menu" class="nav-header collapsed" data-toggle="collapse" ><i class="icon-exclamation-sign"></i> Hotel Information<i class="icon-chevron-up"></i></a>
        <ul id="hotel-menu" class="nav nav-list collapse">
            <li><a href="aboutus.php?id=1">About Us</a></li>
            <li><a href="gallery.php">Gallery</a></li>
        </ul>
        
        <a href="travel.php" class="nav-header" ><i class="icon-cloud"></i>Manage Travel</a>
        <a href="destination.php" class="nav-header" ><i class="icon-cogs"></i>Manage Destination</a>
        <a href="faq.php" class="nav-header" ><i class="icon-book"></i> FAQ</a>
		<?php } ?>
        
        
        
        
        <a href="#history-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-comments"></i>History<i class="icon-chevron-up"></i></a>
        <ul id="history-menu" class="nav nav-list collapse">
        	<?php if ($_SESSION['role'] == 'Admin') { ?>
            	<li ><a href="roomTypeHistory.php">Room Type History</a></li>
                <!--li ><a href="facilityHistory.php">Facility History</a></li-->
                <li ><a href="taxHistory.php">Tax History</a></li>
                <li ><a href="additionalHistory.php">Additional History</a></li>
                <!--li ><a href="faqHistory.php">FAQ History</a></li-->
            <?php } ?>
            <li ><a href="bookingHistory.php">Booking History</a></li>
            <li ><a href="newsHistory.php">News History</a></li>
            <li ><a href="eventsHistory.php">Events History</a></li>
            <li ><a href="offerHistory.php">Offer History</a></li>
        </ul>
        
        <a href="feedback.php" class="nav-header" ><i class="icon-comment"></i>Feedback</a>
        <a href="newsletter.php" class="nav-header" ><i class="icon-bookmark"></i>  Newsletter</a>
        
        
    </div>
</body>
</html>