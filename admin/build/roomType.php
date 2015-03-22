<?php
	session_start();
	if( !isset($_SESSION['name']) ){
		header("location:sign-in.php");
	}
	include("select_db.php");
	include("picture_path.php");
	
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
	
    <script src="media/js/jquery.dataTables.js" type="text/javascript"></script>
        <style type="text/css">
            @import "media/css/demo_table_jui.css";
            @import "media/themes/smoothness/jquery-ui-1.8.4.custom.css";
			
        </style>
		
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $('#datatables').dataTable({
                    "sPaginationType":"full_numbers",
                    "aaSorting":[[0, "desc"]],
                    "bJQueryUI":true
                });
				$(document).on('click','.removeRoomType',function() {
					var id = $(this).parents('tr').find('td:eq(1)').text();
					$('.btn-delete').attr({href: 'doDeleteRoomType.php?idRoom=' + id});
				});
            })
            
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
            
            <h1 class="page-title">Room Type</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="#">Manage Rooms</a></li> <span class="divider">/</span>
            <li><a href="roomType.php">Room Type</a></li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    <a href="addRoomType.php"><button class="btn btn-primary"><i class="icon-plus"></i> New Room Type</button></a>
  <div class="btn-group">
  </div>
</div>
<div>
    <table id="datatables" class="display">
      <thead>
        <tr>
          <th>Main Picture</th>
          <th>ID RoomType</th>
          <th>Name</th>
          <th>Price</th>
          <th>Capacity</th>
          <th>Description</th>
          <th>Facility</th>
          <th style="width: 26px;">Action</th>
        </tr>
      </thead>
      <tbody>
      
      	<?php 
			$result = mysql_query("SELECT rp.Picture, rt.ID_RoomType, rt.RoomType_Name, rt.Price, rt.Capacity, rt.Description, rt.Facility FROM roomtype rt INNER JOIN roomtype_pic rp ON rp.ID_RoomType=rt.ID_RoomType WHERE rt.Status='Active' AND rp.Main_Pic='YES'");
			while($row = mysql_fetch_array($result)){
		?>
        <tr>
          <td><a href="<?php echo $pathRoom.$row['Picture']; ?>", target="_blank"><img src="<?php echo $pathRoom.$row['Picture']; ?>" width="100px" height="100px"></a></td>
          <td><?php echo $row['ID_RoomType']; ?></td>
          <td><?php echo $row['RoomType_Name']; ?></td>
          <td><?php echo $row['Price']; ?></td>
          <td><?php echo $row['Capacity']; ?></td>
          <td><?php echo $row['Description']; ?></td>
          <td><?php echo $row['Facility']; ?></td>
          <td>
              <a href="updateRoomType.php?idRoom=<?php echo $row['ID_RoomType']; ?>"><i class="icon-pencil"></i></a>
              <a href="#myModal" class="removeRoomType" role="button" data-toggle="modal"><i style="margin-left:20px;" class="icon-remove"></i></a>
          </td>
        </tr>
        <?php
			}
		?>
      </tbody>
    </table>
</div>

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the room type?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <a href="#" class="btn btn-danger btn-delete">Delete</a>
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