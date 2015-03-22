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
		#content{
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
		
		.right{
			/*background:#E1E1E1;*/
			float: left;
			margin-left:15px;
			padding:10px;
			width: 300px;
			height:100%;  
		}
		
		.right1{
			/*background:#E1E1E1;*/
			float: left;
			margin-left:0px;
			padding:10px;
			width: 300px;
			height:200px;  
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
            
            <h1 class="page-title">Update Facility</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="#">Manage Rooms</a></li> <span class="divider">/</span>
            <li><a href="facility.php">Facility</a></li><span class="divider">/</span>
            <li class="active">Update Facility</li>
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
	  	$id = $_GET['idFacility'];

		$result = mysql_query("SELECT * FROM facility WHERE ID_Facility = '".$id."'");
		while ($row = mysql_fetch_array($result))
		{
			$id = $row['ID_Facility'];
			$name = $row['Facility_Name'];
			$description = $row['Description'];
		}
	  
	  ?>
   
   <div id="content">
   	<div class="left">
       <form id="tab" action="doUpdateFacility.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Name</label>
            <input type="text" class="input-xlarge" name="name" value="<?php echo $name; ?>">
            <label>Description</label>
            <textarea rows="4" cols="50" class="input-xlarge" name="description"><?php echo $description; ?></textarea>
            <div style="color:#FF0000">
                <?php
                    if(isset($_GET['errorMsg'])){
                        echo $_GET['errorMsg'];
                    }
                ?>
            </div><br/>
            <div>
                <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
                <a href="facility.php" class="btn btn-primary">Cancel</a>
            </div>
        </form>
    </div>
    
    <div class="right">
    	<?php
			$pic = mysql_query("SELECT * FROM facility_pic WHERE ID_Facility = '".$id."' AND Main_Pic !='Delete'");
			while ($row = mysql_fetch_array($pic))
			{
		?>
				<div class="well">
                	<form action="doFacilityMainPicture.php" method="post">
                    <input type="hidden" name="idPic" value="<?php echo $row['ID_Facility_Pic']; ?>"/>
                    <input type="hidden" name="idFacility" value="<?php echo $row['ID_Facility']; ?>"/>
                    <table border=0 cellpadding="5px">
						<tr>
							<td colspan="2"><img src="<?php echo $pathFacility.$row['Picture']; ?>" width="270px" height="270px"></td>
						</tr>
						<tr>
							<?php
								if($row['Main_Pic']=="YES")
								{
							?>
									<td align="left"><a href="#" class="btn" style="background:#00FF33;"><i class="icon-check"></i> Main Picture</a></td>
                            <?php
								}
								else
								{
							?>
									<td align="left"><input type="submit" class="btn btn-block" value="Main Picture" name="submit"/></td> 
							<?php
                            	}
							?>
                            <td align="right"><a href="doDeletePictureFacility.php?idPic=<?php echo $row['ID_Facility_Pic']; ?>&idFacility=<?php echo $row['ID_Facility']; ?>"><i class="icon-remove"></i> Delete</a></td>
						</tr>
					</table>
                    </form>
				</div>
		<?php
			}
		?>
    </div>
    
    <div class="right1">
   	 	<div class="well">
        	<form action="doAddFacilityPic.php" method="post" enctype="multipart/form-data">
    		<input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
                <p><i><u>New Picture</u></i></p>
                <input type="file" name="picture"/><br/><br/>
                <div style="color:#FF0000">
					<?php
                        if(isset($_GET['errorPic'])){
                            echo $_GET['errorPic'];
                    	}
					?>
				</div><br/>
                <input type="submit" class="btn btn-primary" value="Add New Picture"/>
            </form>
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
