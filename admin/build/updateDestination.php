<?php
	session_start();
	if( !isset($_SESSION['name']) ){
		header("location:sign-in.php");
	}
	include("select_db.php");
	include_once "picture_path.php";
	$id = $_GET['idDes'];

	$result = mysql_query("SELECT * FROM destination WHERE ID_Destination = '".$id."'");
	while ($row = mysql_fetch_array($result))
	{
		$id = $row['ID_Destination'];
		$name = $row['Dest_Name'];
		$picture = $row['Dest_Picture'];
		$description = $row['Dest_Description'];
		$telp = $row['Dest_Telp'];
		$email = $row['Dest_Email'];
		$lat = $row['Latitude'];
		$lng = $row['Longitude'];
		$link = $row['Web_Link'];
	}
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
			var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);
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
			
			
			google.maps.event.addListener(map, 'click', function(event) {
				marker.setPosition(event.latLng);

				var yeri = event.latLng;

				var latlongi = "(" + yeri.lat().toFixed(6) + " , " +
						+yeri.lng().toFixed(6) + ")";

				infowindow.setContent(latlongi);

				document.getElementById('lat').value = yeri.lat().toFixed(6);
				document.getElementById('long').value = yeri.lng().toFixed(6);
				document.getElementById('coordinatesurl').value = 'http://www.latlong.net/c/?lat=' 
							+ yeri.lat().toFixed(6) + '&long='
							+ yeri.lng().toFixed(6);
				dec2dms();
			});
			
			
			
			
		  }
		  google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		
		
		
		
		<script type="text/javascript">

			var map;
			var geocoder;
			var marker;
			var infowindow;

			function initialize() 
			{
				<!--var latlng = new google.maps.LatLng(-6.188000721065539, 106.823072433471680);-->
				var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);
				var myOptions = {
					zoom: 5,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.HYBRID
				};
				map = new google.maps.Map(document.getElementById("latlongmap"),
						myOptions);
				geocoder = new google.maps.Geocoder();
				marker = new google.maps.Marker({
					position: latlng,
					map: map
				});

				map.streetViewControl = false;
				infowindow = new google.maps.InfoWindow({
					content: "(1.10, 1.10)"
				});

				google.maps.event.addListener(map, 'click', function(event) {
					marker.setPosition(event.latLng);

					var yeri = event.latLng;

					var latlongi = "(" + yeri.lat().toFixed(6) + " , " +
							+yeri.lng().toFixed(6) + ")";

					infowindow.setContent(latlongi);

					document.getElementById('lat').value = yeri.lat().toFixed(6);
					document.getElementById('long').value = yeri.lng().toFixed(6);
					document.getElementById('coordinatesurl').value = 'http://www.latlong.net/c/?lat=' 
								+ yeri.lat().toFixed(6) + '&long='
								+ yeri.lng().toFixed(6);
					dec2dms();
				});


				google.maps.event.addListener(map, 'mousemove', function(event) {
					var yeri = event.latLng;
					document.getElementById("mlat").value = yeri.lat().toFixed(6);
					document.getElementById("mlong").value = yeri.lng().toFixed(6);
				});

				codeAddress();
			}

			function codeAddress() {
				var address = document.getElementById("gadres").value;
				if (address == '') {
					alert("Address can not be empty!");
					return;
				}
				geocoder.geocode({'address': address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
						document.getElementById('lat').value = results[0].geometry.location.lat().toFixed(6);
						document.getElementById('long').value = results[0].geometry.location.lng().toFixed(6);
						var latlong = "(" + results[0].geometry.location.lat().toFixed(6) + " , " +
								+results[0].geometry.location.lng().toFixed(6) + ")";

						document.getElementById('coordinatesurl').value = 'http://www.latlong.net/c/?lat=' 
								+ results[0].geometry.location.lat().toFixed(6) + '&long='
								+results[0].geometry.location.lng().toFixed(6);
						
						marker.setPosition(results[0].geometry.location);
						map.setZoom(16);
						infowindow.setContent(latlong);

						if (infowindow) {
							infowindow.close();
						}

						google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(map, marker);
						});

						infowindow.open(map, marker);

						dec2dms();
					} else {
						alert("Lat and long cannot be found.");
					}
				});
			}

			function dec2dms( )
			{
				var mylat = document.getElementById("lat").value;
				var mylng = document.getElementById("long").value;
				var scriptUr1 = "dec2dms.php?lat=" + mylat;
				var scriptUr2 = "dec2dms.php?long=" + mylng;
				$.ajax({
					url: scriptUr1,
					type: 'get',
					dataType: 'html',
					async: true,
					success: function(data) {
						result = data;
						$('#dms-lat').val(result);
					}
				});
				$.ajax({
					url: scriptUr2,
					type: 'get',
					dataType: 'html',
					async: true,
					success: function(data) {
						result = data;
						$('#dms-long').val(result);
					}
				});

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
            
            <h1 class="page-title">Update Destination</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="destination.php">Manage Destination</a> <span class="divider">/</span></li>
            <li class="active">Update Destination</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    
  </div>
</div>
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Information</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      <table width="1000" border="0">
      	<tr>
        	<td rowspan="2"><div id="map_canvas"></div></td>
            <td>
            	<form action="updateLogoDestination.php" method="post" enctype="multipart/form-data">
                	<input type="hidden" class="input-xlarge" name="id" value="<?php echo $id; ?>"> 
                    <table border="0" width="450">
                    	<tr>
                        	<td width="150px" height="150px" >
                            	<label>Picture</label>
                   				<a href="<?php echo $pathDestinasi.$picture; ?>", target="_blank"><img src="<?php echo $pathDestinasi.$picture; ?>" width="150px" height="150px"></a><br/>
                            </td>
                            <td  width="100px" height="150px" align="right">
                            	<input type="file" name="logo"/><br/><br/>
                            	<div style="color:#FF0000">
									<?php
                                        if(isset($_GET['errorPic'])){
                                            echo $_GET['errorPic'];
                                        }
                                    ?>
                                </div><br/>
                                <input type="submit" class="btn btn-primary" value="Update Logo"/>
                            </td>
                        </tr>
                    </table>
                <form>
            </td>
        </tr>
      	<tr>
        	
            <td>
            	<form id="tab" action="doUpdateDestination.php" method="post">
                	<input type="hidden" class="input-xlarge" name="id" value="<?php echo $id; ?>"> 
                    <label>Name</label>
                    <input type="text" class="input-xlarge" name="name" placeholder="name" value="<?php echo $name; ?>"> 
                    <label>Description</label>
                    <textarea rows="3" cols="50" class="input-xlarge" name="description" placeholder="description"><?php echo $description; ?></textarea>
                    <label>Telephone</label>
                    <input type="text" class="input-xlarge" name="telp" placeholder="ex : 021123123" value="<?php echo $telp; ?>"> 
                    <label>Email</label>
                    <input type="text" class="input-xlarge" name="email" placeholder="ex : test@yahoo.com" value="<?php echo $email; ?>"> 
                    <label>Latitude</label>
                    <input type="text" class="input-xlarge" name="latitude" id="lat" placeholder="latitude" value="<?php echo $lat; ?>">
                    <label>Longitude</label>
                    <input type="text" class="input-xlarge" name="longitude" id="long" placeholder="longitude" value="<?php echo $lng; ?>">
                    <label>Website Link</label>
                	<input type="text" class="input-xlarge" name="link" placeholder="website link" value="<?php echo $link; ?>"> 
                    <div style="color:#FF0000">
                        <?php
                            if(isset($_GET['errorMsg'])){
                                echo $_GET['errorMsg'];
                            }
                        ?>
                    </div><br/>
                    <div>
                        <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
                        <a href="destination.php" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
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