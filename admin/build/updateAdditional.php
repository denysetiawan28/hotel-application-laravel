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
            
            <h1 class="page-title">Update Additional</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="#.php">Manage Charges</a> <span class="divider">/</span></li>
            <li><a href="additional.php">Additional</a> <span class="divider">/</span></li>
            <li class="active">Update Additional</li>
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
	  	$id = $_GET['idAdd'];

		$result = mysql_query("SELECT * FROM additional WHERE ID_Additional = '".$id."'");
		while ($row = mysql_fetch_array($result))
		{
			$id = $row['ID_Additional'];
			$name = $row['Additional_Name'];
			$price = $row['Price'];
			$description = $row['Description'];
			$qty= $row['Quantity'];
		}
	  
	  ?>
   <form id="tab" action="doUpdateAdditional.php" method="post">
   		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
   		<label>Additional Name</label>
        <input type="text" class="input-xlarge" name="name" placeholder="additional name" value="<?php echo $name; ?>">
        <label>Price</label>
        <input type="text" class="input-xlarge" name="price" placeholder="example : 100000" value="<?php echo $price; ?>">
        <label>Description</label>
        <textarea rows="5" cols="50" class="input-xlarge" name="description" placeholder="description" ><?php echo $description; ?></textarea>
        <label>Max Quantity</label>
        <select id="qty" name="qty" class="input-xlarge">
        	<?php if($qty=='1') {?>
			<option value="1" selected="selected">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		<?php } else if($qty=='2') { ?>
			<option value="1">1</option>
			<option value="2" selected="selected">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		<?php } else if($qty=='3') { ?>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3" selected="selected">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		<?php } else if($qty=='4') { ?>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4" selected="selected">4</option>
			<option value="5">5</option>
		<?php } else if($qty=='5') { ?>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5" selected="selected">5</option>
		<?php } ?>
	</select><br/><br/>
        <div style="color:#FF0000">
			<?php
                if(isset($_GET['errorMsg'])){
                    echo $_GET['errorMsg'];
                }
            ?>
        </div><br/><br/>
        <div>
            <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
            <a href="additional.php" class="btn btn-primary">Cancel</a>
        </div>
    </form>
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