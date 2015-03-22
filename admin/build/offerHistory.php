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
            
            <h1 class="page-title">Offer History</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="#">History</a></li> <span class="divider">/</span>
            <li><a href="offerHistory.php">Offer History</a></li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">

   <div class="btn-group">
  </div>
</div>
<div>
    <table id="datatables" class="display">
      <thead>
        <tr>
          <th>ID_Offer_History</th>
          <th>ID_Offer</th>
          <th>Title</th>
          <th>File</th>
          <th>From_Date</th>
          <th>Until_Date</th>
          <th>Created by</th>
          <th>Action</th>
          <th>Created Date</th>
          <th style="width: 26px;">View</th>
        </tr>
      </thead>
      <tbody>
      	<?php
			$result = mysql_query("SELECT oh.ID_Offer_History, oh.ID_Offer, oh.Title ,oh.From_Date, oh.Until_Date, us.Name, oh.Action, oh.Created_Date FROM offer_history oh JOIN user us ON oh.ID_User=us.ID_User");
			while($row = mysql_fetch_array($result)){
		?>
        <tr>
          <td><?php echo $row['ID_Offer_History']; ?></td>
          <td><?php echo $row['ID_Offer']; ?></td>
          <td><?php echo $row['Title']; ?></td>
          <td><a href="../../../public/resources/images/hotel/offer/<?php echo $row['File']; ?>", target="_blank"><img src="../../../public/resources/images/hotel/offer/<?php echo $row['File']; ?>" width="100px" height="100px"></a></td>
          <td><?php echo $row['From_Date']; ?></td>
          <td><?php echo $row['Until_Date']; ?></td>
          <td><?php echo $row['Name']; ?></td>
          <td><?php echo $row['Action']; ?></td>
          <td><?php echo $row['Created_Date']; ?></td>
          <td>
              <input type="button" class="input-mini btn" onClick="javaScript:showDetail('<?php echo $row['ID_Offer_History']; ?>');" value="View"/> 
          </td>
        </tr>
        <?php
			}
		?>
      </tbody>
    </table>
    
    <div class="well" id="detail"></div>
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
		
		function showDetail(id){
			//var str = document.getElementById("room").value; 
			if (id=="") {
				document.getElementById("detail").innetHTML="";
				return;
			} 
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			} else { // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() 
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200) 
				{
				  	document.getElementById("detail").innerHTML=xmlhttp.responseText;
				}
			}			
			xmlhttp.open("GET","getDetailOffer.php?idHistory="+id,true);
			xmlhttp.send();
		}
    </script>
    
  </body>
</html>
