<?php
	session_start();
	if( !isset($_SESSION['name']) ){
		header("location:sign-in.php");
	}
	include("select_db.php");
	include_once "picture_path.php";
	$lat = $_GET['latitude'];
	$long = $_GET['longitude'];
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
	
    <style>
			#map_canvas {
				width:450px;
				height:400px;
			}
		</style>
		
		
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
		
		
		<script>
			var geocoder;
			var marker;
			var infowindow;
		
		  function initialize() {
			var map_canvas = document.getElementById('map_canvas');
			var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>);
			var map_options = {
			  center: latlng,
			  zoom: 16,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var map = new google.maps.Map(map_canvas, map_options);
			
			geocoder = new google.maps.Geocoder();
			
			
			marker = new google.maps.Marker({
				position: latlng,
				map: map
			});
				
			map.streetViewControl = false;
			infowindow = new google.maps.InfoWindow({
				content: "(1.10, 1.10)"
			});
			
			
			google.maps.event.addListener(marker, "click", function (event) {
                    alert(this.position);
			}); 

			
		  }
		  google.maps.event.addDomListener(window, 'load', initialize);
		  
		  
		function toggleBounce() {
			  if (marker.getAnimation() != null) {
				marker.setAnimation(null);
			  } else {
				marker.setAnimation(google.maps.Animation.BOUNCE);
			  }
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
  <body class=""> 
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
                        	<li><a tabindex="-1" href="changepassword.php">Change Password</a></li>
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
            
            <h1 class="page-title">View Destination</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="destination.php">Destination</a> <span class="divider">/</span></li>
            <li class="active">View Destination</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    
  </div>
</div>
<div class="well">
    <!--<ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Information</a></li>
    </ul>-->
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      
		<?php
        $id = $_GET['idDestination'];
    
        $result = mysql_query("SELECT * FROM destination WHERE ID_Destination = '".$id."'");
        while ($row = mysql_fetch_array($result))
        {
            $name = $row['Dest_Name'];
			$picture = $row['Dest_Picture'];
            $description = $row['Dest_Description'];
			$telp = $row['Dest_Telp'];
            $email = $row['Dest_Email'];
            $latitude = $row['Latitude'];
            $longitude = $row['Longitude'];
			$link = $row['Web_Link'];
        }
      
      ?>
      <table width="900">
      	<tr>
        	<td><div id="map_canvas"></div></td>
            <td>
                <label>Name</label>
                <input type="text" class="input-xlarge" name="name" value="<?php echo $name; ?>" disabled> 
                <label>Picture</label>
                <div><a href="<?php echo $pathDestinasi.$picture; ?>", target="_blank"><img src="<?php echo $pathDestinasi.$picture; ?>" width="150px" height="150px"></a></div><br/>
                <label>Description</label>
                <textarea rows="3" cols="50" class="input-xlarge" name="description" disabled><?php echo $description; ?></textarea>
                <label>Telephone</label>
                <input type="text" class="input-xlarge" name="telp" value="<?php echo $telp; ?>" disabled> 
                <label>Email</label>
                <input type="text" class="input-xlarge" name="email" value="<?php echo $email; ?>" disabled> 
                <label>Latitude</label>
                <input type="text" class="input-xlarge" name="latitude" id="lat" value="<?php echo $latitude; ?>" disabled>
                <label>Longitude</label>
                <input type="text" class="input-xlarge" name="longitude" id="long" value="<?php echo $longitude; ?>" disabled>
                <label>Website Link</label>
                <input type="text" class="input-xlarge" name="link" value="<?php echo $link; ?>" disabled> 
                <br/><br/>
                <div>
                    <a href="destination.php"><button class="btn">Back to Destination</button></a>
                </div>
               
            </td>
        </tr>
      </table>
   
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

