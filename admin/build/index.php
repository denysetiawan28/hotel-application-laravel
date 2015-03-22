<?php
	session_start();
	if( !isset($_SESSION['name']) ){
		header("location:sign-in.php");
	}
	include("select_db.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="fav/fav.png" rel="icon"/>
    <title>Everyday Smart Hotel Admin</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>

    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>
	
    <script>
		function expired()
		{
			<?php 
				$today = date("Y-m-d");
				$test = mysql_query("SELECT ID_Events FROM events WHERE Date < '".$today."'");
				while($row = mysql_fetch_array($test))
				{	
					$id = $row['ID_Events'];
					mysql_query("UPDATE events SET Status='Expired' WHERE ID_Events='".$id."' ");
					
				} 
				
				$test1 = mysql_query("SELECT ID_Offer FROM offer WHERE Until_Date < '".$today."' ");
				while($row = mysql_fetch_array($test1))
				{	
					$id = $row['ID_Offer'];
					mysql_query("UPDATE offer SET Status='Expired' WHERE ID_Offer='".$id."' ");
					
				} 
			?>
		
		}		
	</script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class="" onLoad="expired()"> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo $_SESSION['name']; ?>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                        	<li><a tabindex="-1" href="changePassword.php">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="doLogout.php">Logout</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="index.php"><span class="first">Everyday Smart Hotel</span> <span class="second">Panel</span></a>
        </div>
    </div>
    
	<?php 
		include("navigation.php");
	
	?>
	
    <div class="content">
        
        <div class="header">
            <h1 class="page-title">Home</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="#">Dashboard</a></li> <span class="divider">/</span>
            <li><a href="index.php">Home</a></li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    

<div class="row-fluid">

    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i><strong>Welcome, <?php echo $_SESSION['name']; ?></strong></i>
    </div>

    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">Latest Stats</a>
        <div id="page-stats" class="block-body collapse in">
			<?php
				//get jumlah news
				$result = mysql_query("SELECT COUNT(ID_News) AS 'newsCount' FROM news WHERE Status='Active'");
				while($row = mysql_fetch_array($result))
				{ 
					$newsCount = $row['newsCount']; 
				};
				
				//get jumlah events
				$result = mysql_query("SELECT COUNT(ID_Events) AS 'eventsCount' FROM events WHERE Status='Active'");
				while($row = mysql_fetch_array($result))
				{ 
					$eventsCount = $row['eventsCount']; 
				};
				
				//get jumlah offer
				$result = mysql_query("SELECT COUNT(ID_Offer) AS 'offerCount' FROM offer WHERE Status='Active'");
				while($row = mysql_fetch_array($result))
				{ 
					$offerCount = $row['offerCount']; 
				};
				
				//get jumlah feedback
				$result = mysql_query("SELECT COUNT(ID_Feedback) AS 'feedbackCount' FROM feedback");
				while($row = mysql_fetch_array($result))
				{ 
					$feedbackCount = $row['feedbackCount']; 
				};
				
				//get jumlah newsletter
				$result = mysql_query("SELECT COUNT(ID_Newsletter) AS 'newsletterCount' FROM newsletter");
				while($row = mysql_fetch_array($result))
				{ 
					$newsletterCount = $row['newsletterCount']; 
				};
				
			?>
            <div class="stat-widget-container">
                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><a href="news.php" ><?php echo $newsCount; ?></a></p>
                        <p class="detail">News</p>
                    </div>
                </div>

                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><a href="events.php" ><?php echo $eventsCount; ?></a></p>
                        <p class="detail">Events</p>
                    </div>
                </div>
				
                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><a href="offer.php" ><?php echo $offerCount; ?></a></p>
                        <p class="detail">Offer</p>
                    </div>
                </div>
                
                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><a href="feedback.php" ><?php echo $feedbackCount; ?></a></p>
                        <p class="detail">Feedback</p>
                    </div>
                </div>
                
                <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title"><a href="newsletter.php" ><?php echo $newsletterCount; ?></a></p>
                        <p class="detail">Newsletter</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="block span6">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Events History</a>
        <div id="tablewidget" class="block-body collapse in">
        	<table class="table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Created_By</th>
                  <th>Action</th>
                  <th>Created_Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$result = mysql_query("SELECT eh.Title, eh.Date, eh.Time, us.Name, eh.Action, eh.Created_Date FROM events_history eh JOIN user us ON eh.ID_User=us.ID_User ORDER BY Created_Date DESC LIMIT 5");
					while($row = mysql_fetch_array($result))
					{
				?>
					<tr>
                        <td><?php echo $row['Title']; ?></td>
                        <td><?php echo $row['Date']; ?></td>
                        <td><?php echo $row['Time']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Action']; ?></td>
                        <td><?php echo $row['Created_Date']; ?></td>
                    </tr>
                <?php
					}
				?>
              </tbody>
            </table>
            <p align="right"><a href="eventsHistory.php">More...</a></p>
        </div>
    </div>
    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">Offer History </a>
        <div id="widget1container" class="block-body collapse in">
            <table class="table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>From_Date</th>
                  <th>Until_Date</th>
                  <th>Created By</th>
                  <th>Action</th>
                  <th>Created Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$result = mysql_query("SELECT oh.Title, oh.From_Date, oh.Until_Date, us.Name, oh.Action, oh.Created_Date FROM offer_history oh JOIN user us ON oh.ID_User=us.ID_User ORDER BY Created_Date DESC LIMIT 5");
					while($row = mysql_fetch_array($result))
					{
				?>
					<tr>
                        <td><?php echo $row['Title']; ?></td>
                        <td><?php echo $row['From_Date']; ?></td>
                        <td><?php echo $row['Until_Date']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Action']; ?></td>
                        <td><?php echo $row['Created_Date']; ?></td>
                    </tr>
                <?php
					}
				?>
              </tbody>
            </table>
            <p align="right"><a href="offerHistory.php">More...</a></p>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="block span6" style="width:100%;">
        <div class="block-heading">
            <span class="block-icon pull-right">
                <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"></a>
            </span>

            <a href="#widget2container" data-toggle="collapse">Booking History</a>
        </div>
        <div id="widget2container" class="block-body collapse in" st>
            <table class="table">
              <thead>
                <tr>
                  <th>Guest Name</th>
                  <th>Arrive</th>
                  <th>Depart</th>
                  <th>Number nights</th>
                  <th>Occupancy</th>
                  <th>RoomType Name</th>
                  <th>Quantity</th>
                  <th>Flight_Detail</th>
                  <th>Arrival Time</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$result = mysql_query("SELECT CONCAT(gs.First_name, ' ',gs.Last_name) AS GuestName, bo.Arrive, bo.Depart, bo.Number_nights, bo.Occupancy, rt.RoomType_Name, db.Quantity, ex.Flight_detail, ex.Arrival_time, bo.Booking_Status FROM booking bo JOIN detail_booking db ON bo.ID_Booking=db.ID_Booking JOIN roomtype rt ON db.ID_RoomType=rt.ID_RoomType JOIN guest gs ON bo.ID_Booking=gs.ID_Booking JOIN extra ex ON bo.ID_Booking=ex.ID_Booking ORDER BY Arrive DESC LIMIT 10");
					while($row = mysql_fetch_array($result))
					{
				?>
					<tr>
                        <td><?php echo $row['GuestName']; ?></td>
                        <td><?php echo $row['Arrive']; ?></td>
                        <td><?php echo $row['Depart']; ?></td>
                        <td><?php echo $row['Number_nights']; ?></td>
                        <td><?php echo $row['Occupancy']; ?></td>
                        <td><?php echo $row['RoomType_Name']; ?></td>
                        <td><?php echo $row['Quantity']; ?></td>
                        <td><?php echo $row['Flight_detail']; ?></td>
                        <td><?php echo $row['Arrival_time']; ?></td>
                        <td><?php echo $row['Booking_Status']; ?></td>
                    </tr>
                <?php
					}
				?>
              </tbody>
            </table>
            <p align="right"><a href="bookingHistory.php">More...</a></p>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="block span6">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">RoomType History</a>
        <div id="tablewidget" class="block-body collapse in">
        	<table class="table">
              <thead>
                <tr>
                  <th>RoomType_Name</th>
                  <th>Price</th>
                  <th>Created By</th>
                  <th>Action</th>
                  <th>Created Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$result = mysql_query("SELECT rh.RoomType_Name, rh.Price, us.Name, rh.Action, rh.Created_Date FROM roomtype_history rh JOIN user us ON rh.ID_User=us.ID_User ORDER BY Created_Date DESC LIMIT 5");
					while($row = mysql_fetch_array($result))
					{
				?>
					<tr>
                        <td><?php echo $row['RoomType_Name']; ?></td>
                        <td><?php echo $row['Price']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Action']; ?></td>
                        <td><?php echo $row['Created_Date']; ?></td>
                    </tr>
                <?php
					}
				?>
              </tbody>
            </table>
            <!--p align="right"><a href="news.php">More...</a></p-->
        </div>
    </div>
    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">Tax History </a>
        <div id="widget1container" class="block-body collapse in">
            <table class="table">
              <thead>
                <tr>
                  <th>Tax Name</th>
                  <th>Tax(%)</th>
                  <th>Created By</th>
                  <th>Action</th>
                  <th>Created Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$result = mysql_query("SELECT th.Tax_Name, th.Tax, us.Name, th.Action, th.Created_Date FROM tax_history th JOIN user us ON th.ID_User=us.ID_User ORDER BY Created_Date DESC LIMIT 5");
					while($row = mysql_fetch_array($result))
					{
				?>
					<tr>
                        <td><?php echo $row['Tax_Name']; ?></td>
                        <td><?php echo $row['Tax']*100; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Action']; ?></td>
                        <td><?php echo $row['Created_Date']; ?></td>
                    </tr>
                <?php
					}
				?>
              </tbody>
            </table>
            <!-- p align="right"><a href="events.php">More...</a></p-->
        </div>
    </div>
</div>

                    
                    <footer>
                        <hr>

                        <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                       	<p>&copy; 2014 Everyday Smart Hotel</p>
                    </footer>
                    
            </div>
        </div>
    </div>
    


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>

