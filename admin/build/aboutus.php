<?php
	session_start();
	if( !isset($_SESSION['name']) ){
		header("location:sign-in.php");
	}
	include("select_db.php");
	include("picture_path.php");
	
	$idAboutUs = $_GET['id'];
	
	$map = mysql_query("SELECT * FROM aboutus WHERE ID_AboutUs = '".$idAboutUs."'");
	while ($row = mysql_fetch_array($map))
	{
		$lat = $row['Latitude'];
		$lng = $row['Longitude'];
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
		
		#content1{
			float: left;
			margin: 0;
			padding: 0 10px;
			width: 1000px;
			margin-bottom: 17px;
		}
		
		.left{
			/*background:#E1E1E1;*/
			float: left;
			width: 300px;
			height:100%; 
			padding:10px;
		}
		
		.right1{
			/*background:#E1E1E1;*/
			float: right;
			margin-left:0px;
			padding:10px;
			width: 600px;
			height:100%;  
		}
		
		.r1{
			/*background:green;*/
			float: left;
			padding:0px;
			width: 300px;
			height:100%;  
		}
		.r2{
			/*background:blue;*/
			float: right;
			margin-right:0px;
			padding:5px;
			width: 250px;
			height:100%;  
		}
		
		.right2{
			/*background:#E1E1E1;*/
			float: right;
			margin-left:0px;
			padding:10px;
			width: 600px;
			height:100%;  
		}
		
		.right3{
			background:#E1E1E1;
			float: right;
			margin-left:0px;
			padding:10px;
			width: 600px;
			height:100%;  
		}
    </style>
	
    <style>
			#map_canvas {
				width:300px;
				height:300px;
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
					zoom: 3,
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
            
            <h1 class="page-title">About Us</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="#">Hotel Information</a> <span class="divider">/</span></li>
            <li><a href="aboutus.php?id=1">About Us</a>
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
      	<?php
			$result = mysql_query("SELECT * FROM aboutus WHERE ID_AboutUs = '".$idAboutUs."'");
			while ($row = mysql_fetch_array($result))
			{
				$id = $row['ID_Aboutus'];
				$name = $row['Name'];
				$address = $row['Address'];
				$telp = $row['Telephone'];
				$email = $row['Email'];
				$about = $row['About'];
				$concept = $row['Concept'];
				$vision = $row['Vision'];
				$mision = $row['Mision'];
				$web = $row['Link_Web'];
				$book = $row['Link_Book'];
			}
	  
	  ?>
      
   <div id="content1">
   	<div class="left">
    <form id="tab" action="doUpdateAboutUs.php" method="post">
   		<input type="hidden" class="input-xlarge" name="id" value="<?php echo $id; ?>">
   		<label>Name</label>
        <input type="text" class="input-xlarge" name="name" placeholder="name" value="<?php echo $name; ?>">
        <label>Address</label>
        <textarea rows="5" cols="50" class="input-xlarge" name="address" placeholder="address"><?php echo $address; ?></textarea><br/>
        <label>Telephone</label>
        <input type="text" class="input-xlarge" name="telp" placeholder="telephone" value="<?php echo $telp; ?>">
        <label>Email</label>
        <input type="text" class="input-xlarge" name="email" placeholder="email" value="<?php echo $email; ?>">
        <label>About</label>
        <textarea rows="8" cols="50" class="input-xlarge" name="about" placeholder="about"><?php echo $about; ?></textarea><br/>
        <label>Concept</label>
        <textarea rows="8" cols="50" class="input-xlarge" name="concept" placeholder="concept"><?php echo $concept; ?></textarea><br/>
        <label>Vision</label>
        <textarea rows="8" cols="50" class="input-xlarge" name="vision" placeholder="vision"><?php echo $vision; ?></textarea><br/>
        <label>Mision</label>
        <textarea rows="8" cols="50" class="input-xlarge" name="mision" placeholder="mision"><?php echo $mision; ?></textarea><br/>
        <label>Link_Web</label>
        <input type="text" class="input-xlarge" name="web" placeholder="link web" value="<?php echo $web; ?>">
        <label>Link_Book</label>
        <input type="text" class="input-xlarge" name="book" placeholder="link book" value="<?php echo $book; ?>">
        <div style="color:#FF0000">
			<?php
                if(isset($_GET['errorMsg'])){
                    echo $_GET['errorMsg'];
                }
            ?>
        </div><br/>
        <div>
            <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
            <a href="events.php" class="btn btn-primary">Cancel</a>
        </div>
    </form>
    </div>
    
    <div class="right1">
       <div class="well">
       <table>
       	<tr>
        	<td>
            	<div class="r1">
			   <?php
                    $pic = mysql_query("SELECT * FROM aboutus WHERE ID_Aboutus = '1'");
                    while ($row = mysql_fetch_array($pic))
                    {
                ?>
                        <div class="well">
                            <table border=0 cellpadding="5px">
                                <tr>
                                    <td colspan="2"><img src="<?php echo $pathLogo.$row['Logo']; ?>" width="270px" height="270px"></td>
                                </tr>
                            </table>
                        </div>
                <?php
                    }
                ?>
                </div>
            </td>
            
            <td>
            	<div class="r2">
                <div class="well">
                    <form action="updateLogo.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <p><i><u>Update Logo</u></i></p>
                        <input type="file" name="logo"/><br/><br/>
                        <div style="color:#FF0000">
                            <?php
                                if(isset($_GET['errorPic'])){
                                    echo $_GET['errorPic'];
                                }
                            ?>
                        </div><br/>
                        <input type="submit" class="btn btn-primary" value="Update Logo"/>
                    </form>
                </div>
        		</div>
            </td>
        </tr>
       </table>
       </div>
    </div>
    
    <div class="right2">
       <div class="well">
       <table>
       	<tr>
        	<td>
            	<div class="r1">
			   <?php
                    $pic = mysql_query("SELECT * FROM aboutus WHERE ID_Aboutus = '1'");
                    while ($row = mysql_fetch_array($pic))
                    {
                ?>
                        <div class="well">
                            <table border=0 cellpadding="5px">
                                <tr>
                                    <td colspan="2"><img src="<?php echo $pathAboutUs.$row['AboutUsPic']; ?>" width="270px" height="270px"></td>
                                </tr>
                            </table>
                            </form>
                        </div>
                <?php
                    }
                ?>
                </div>
            </td>
            
            <td>
            	<div class="r2">
                <div class="well">
                    <form action="updatePic.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <p><i><u>Update Picture About Us</u></i></p>
                        <input type="file" name="picture"/><br/><br/>
                        <div style="color:#FF0000">
                            <?php
                                if(isset($_GET['errorPic1'])){
                                    echo $_GET['errorPic1'];
                                }
                            ?>
                        </div><br/>
                        <input type="submit" class="btn btn-primary" value="Update Picture"/>
                    </form>
                </div>
        		</div>
            </td>
        </tr>
       </table>
       </div>
    </div>
    
    <div class="right2">
       <div class="well">
       <table>
       	<tr>
        	<td>
            	<div class="r1">
			  		<div><div id="map_canvas"></div></div>
                </div>
            </td>
         
            <td>
            	<div class="r2">
                <div class="well">
                    <form id="tab" action="doUpdateMap.php" method="post">
                	<input type="hidden" class="input-xlarge" name="id" value="<?php echo $id; ?>"> 
                    <label>Latitude</label>
                    <input type="text" class="input-medium" name="latitude" id="lat" placeholder="latitude" value="<?php echo $lat; ?>">
                    <label>Longitude</label>
                    <input type="text" class="input-medium" name="longitude" id="long" placeholder="longitude" value="<?php echo $lng; ?>">
                    <div style="color:#FF0000">
                        <?php
                            if(isset($_GET['errorMap'])){
                                echo $_GET['errorMap'];
                            }
                        ?>
                    </div><br/>
                    <div>
                        <button class="btn btn-primary"><i class="icon-upload"></i> Update</button>
                    </div>
                </form>
                </div>
        		</div>
            </td>
        </tr>
       </table>
       </div>
    </div>
    
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
