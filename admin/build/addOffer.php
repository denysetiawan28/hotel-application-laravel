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
	<script type="text/javascript">
		function getDetail(){
			var str = document.getElementById("room").value; 
			if (str == "") {
				document.getElementById("id").value = "";
				document.getElementById("name").value = "";
				document.getElementById("price").value = "";
				return;
			} 
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else { // code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() 
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					var response = xmlhttp.responseText;
					var temp = response.split("-");
				  	document.getElementById("id").value = temp[0];
					document.getElementById("name").value = temp[1];
					document.getElementById("price").value = temp[2];

				}
			}			
			xmlhttp.open("GET","getDetailRoom.php?idRoom="+str,true);
			xmlhttp.send();
		}
		
		//cek apakah ada id yang sama di selected room
		function checkList(list,value)
		{
			var cek = false;
			for(var x=0; x<list.options.length; x++){
				if(list.options[x].value==value || list.options[x].text==value){ 
					cek=true;
					break;
				}
			}
			return cek;
		}
		
		function getselected()
		{
			var x = document.getElementById("roomDetail");
			var rooms = new Array();
			for (i = 0; i < x.length; i++) { 
				rooms.push(x.options[i].value);	
			}
		}	
		
		
		
	</script>
    
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
			height:500px;  
			padding:10px;
		}
		
		.right{
			/*background:#E1E1E1;*/
			float: left;
			margin-left:30px;
			padding:10px;
			width: 300px;
			height:500px;  
		}
		
		.right1{
			/*background:#E1E1E1;*/
			float: left;
			margin-left:0px;
			padding:10px;
			width: 300px;
			height:500px;  
		}
		
		.bottom{
			/*background:#E1E1E1;*/
			float: left;
			margin-top:10px;
			width: 1000px;
			height:70px;  
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
    
    <script>
		//mendapatkan value dari selected room
		
	</script>
    
  </head>
	
  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class="" > 
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
            
            <h1 class="page-title">New Offer</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="#">Manage Information</a></li> <span class="divider">/</span>
            <li><a href="offer.php">Offer</a> <span class="divider">/</span></li>
            <li class="active">New Offer</li>
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
      	<form id="tab" action="doAddOffer.php" method="post" enctype="multipart/form-data">
        <div id="content">
          <div class="left">
          	<label>Title</label>
            <input type="text" class="input-xlarge" name="title" placeholder="title"><br/><br/>
            <label>File</label>
            <input type="file" name="filename"><br/><br/>
            <label>Description</label>
            <textarea rows="5" cols="50" class="input-xlarge" name="description" placeholder="description"></textarea><br/><br/>
            <label>From Date</label>
            <input type="date" class="input-large" name="from"><br/><br/>
            <label>Until Date</label>
            <input type="date" class="input-large" name="until">
          </div>
          
          <div class="right">
          	<label><strong>List Room</strong></label>
            <select id="room" name="room" class="input-xlarge" onChange="getDetail()">
                <option></option>
                    <?php		
                        $list = mysql_query("SELECT ID_RoomType, RoomType_Name FROM roomtype WHERE Status='Active'");
                        while($row = mysql_fetch_array($list))
                        { 
                    ?>
                            <option value="<?=$row['ID_RoomType']?>"><?=$row['RoomType_Name']?></option>
                    <?php
                        }
                    ?>
            </select><br/><br/>
            
            <label><i><u>Detail Room</u></i></label>
            <input type="hidden" id="id" name="id">
            <label>Name</label>
            <input type="text" class="input-large" id="name" name="name" readonly><br/><br/>
            <!--label>Picture</label-->
            <!--div id="picture"></div-->
            <!--a href="images/offer/$row['Picture']", target="_blank"><img src="images/offer/$row['Picture']" width="100px" height="100px"></a-->
            <label>Price</label>
            <span style="font-size:14px;" ><i>from : Rp.</i></span>
            <input type="text" class="input-large" id="price"  name="price" readonly><br/>
            <span style="font-size:14px;"><i>to : Rp.</i></span>
            <input type="text" class="input-large" id="price2" name="price2" placeholder="example : 100000"><br/><br/>
            <input type="button" class="btn btn-small" align="right" onClick="javaScript:addToList();" id="addtocart" value="Add" />

          </div>
          
          <div class="right1">
          	<label><strong>Selected Room</strong></label>
            <select class="input-xlarge" id="roomDetail" name="roomDetail[]" multiple="yes" size="10"></select><br/>
            <input type="button" class="btn btn-small" value="Remove" onClick="javaScript:removeList();"/>
          </div>
          
          <div class="bottom" align="center">
          	<div style="color:#FF0000">
				<?php
                    if(isset($_GET['errorMsg'])){
                        echo $_GET['errorMsg'];
                    }
                ?>
            </div><br/>
            <div>
                <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Save</button>
                <a href="offer.php" class="btn btn-primary">Cancel</a>
            </div>
          </div>
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
		
		function addToList()
		{
			var selectValue = document.getElementById('roomDetail');
			var optionValue = document.getElementById('room').value;
			var id = document.getElementById('id');
			var name = document.getElementById('name');
			var price = document.getElementById('price2').value;
			
			if(checkList(selectValue,id.value))
			{
				alert('Room already exists');
				return false;
			}
			else if(room.value == 0)
			{
				alert('No room which can be added to List');
				return false;
			}
			else if(price == "")
			{
				alert('Price must be filled');
				return false;
			}
			
			var selectBoxOption = document.createElement("option");
			selectBoxOption.value = id.value + "-"+ name.value + "-" + price2.value;
			selectBoxOption.selected = true;
			selectBoxOption.text = id.value + "-"+ name.value + "-" + price2.value;
			selectValue.add(selectBoxOption, null); 
			
			return true;
			
		}
		
		function removeList()
		{
			var selectValue = document.getElementById('roomDetail');
			
			if(selectValue.options.length == 0){
				alert('You have already remove all selected room');
				return false;
			}
				
			var removeIndex = selectValue.options.selectedIndex;
			selectValue.remove(removeIndex);
			
			return true;
		}
		
    </script>
    
  </body>
</html>

