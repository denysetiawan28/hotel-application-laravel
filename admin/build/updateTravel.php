<?php
	session_start();
	if( !isset($_SESSION['name']) ){
		header("location:sign-in.php");
	}
	include("select_db.php");
	include_once "picture_path.php";
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
    </style>

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
            
            <h1 class="page-title">Update Travel</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="#.php">Manage Travel</a> <span class="divider">/</span></li>
            <li class="active">Update Travel</li>
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
	  	$id = $_GET['idTravel'];

		$result = mysql_query("SELECT * FROM travel WHERE ID_Travel = '".$id."'");
		while ($row = mysql_fetch_array($result))
		{
			$id = $row['ID_Travel'];
			$logo = $row['Travel_Logo'];
			$name = $row['Travel_Name'];
			$address = $row['Travel_Address'];
			$telp = $row['Travel_Telp'];
			$email = $row['Travel_Email'];
			$diskon = $row['Travel_Diskon'];
			$link = $row['Web_Link'];
		}
	  
	  ?>
    <div id="content1">
   	<div class="left">
   	<form id="tab" action="doUpdateTravel.php" method="post">
   		<input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Travel Name</label>
        <input type="text" class="input-xlarge" name="name" placeholder="travel name" value="<?php echo $name; ?>">
        <label>Travel Address</label>
        <textarea rows="4" cols="50" class="input-xlarge" name="address" placeholder="travel address"><?php echo $address; ?></textarea>
        <label>Travel Telp</label>
        <input type="text" class="input-xlarge" name="telp" placeholder="example : 021464646" value="<?php echo $telp; ?>">
        <label>Travel Email</label>
        <input type="text" class="input-xlarge" name="email" placeholder="example : asdasd@yahoo.com" value="<?php echo $email; ?>">
        <label>Diskon (%)</label>
        <input type="text" class="input-medium" name="diskon" placeholder="example : 10" value="<?php echo $diskon; ?>">
        <label>Website Link</label>
        <input type="text" class="input-xlarge" name="link" placeholder="website link" value="<?php echo $link; ?>">
        <br/><br/>
        <div style="color:#FF0000">
			<?php
                if(isset($_GET['errorMsg'])){
                    echo $_GET['errorMsg'];
                }
            ?>
        </div>
        <div>
            <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
            <a href="travel.php" class="btn btn-primary">Cancel</a>
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
                    $pic = mysql_query("SELECT * FROM travel WHERE ID_Travel = '".$id."'");
                    while ($row = mysql_fetch_array($pic))
                    {
                ?>
                        <div class="well">
                            <table border=0 cellpadding="5px">
                                <tr>
                                    <td colspan="2"><img src="<?php echo $pathTravel.$row['Travel_Logo']; ?>" width="200px" height="200px"></td>
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
                    <form action="updateLogoTravel.php" method="post" enctype="multipart/form-data">
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
