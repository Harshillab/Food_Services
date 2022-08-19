<?php
session_start();
include("connection.php");
extract($_REQUEST);
$arr=array();

if(isset($_SESSION['cust_id']))
{
	 $cust_id=$_SESSION['cust_id'];
	 $cquery=mysqli_query($con,"select * from tblcustomer where fld_email='$cust_id'");
	 $cresult=mysqli_fetch_array($cquery);
}
else
{
	$cust_id="";
}
 

$query=mysqli_query($con,"select  tblvendor.fld_name,tblvendor.fldvendor_id,tblvendor.fld_email,
tblvendor.fld_mob,tblvendor.fld_address,tblvendor.fld_logo,tbfood.food_id,tbfood.foodname,tbfood.cost,
tbfood.cuisines,tbfood.paymentmode 
from tblvendor inner join tbfood on tblvendor.fldvendor_id=tbfood.fldvendor_id;");
while($row=mysqli_fetch_array($query))
{
	$arr[]=$row['food_id'];
	shuffle($arr);
}

//print_r($arr);

 if(isset($addtocart))
 {
	 
	if(!empty($_SESSION['cust_id']))
	{
		 $_SESSION['cust_id']=$cust_id;
		header("location:form/cart.php?product=$addtocart");
	}
	else
	{
		header("location:form/?product=$addtocart");
	}
 }
 
 if(isset($login))
 {
	 header("location:form/index.php");
 }
 if(isset($logout))
 {
	 session_destroy();
	 header("location:index.php");
 }
 $query=mysqli_query($con,"select tbfood.foodname,tbfood.fldvendor_id,tbfood.cost,tbfood.cuisines,tbfood.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbfood inner  join tblcart on tbfood.food_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
  $re=mysqli_num_rows($query);
?>
<html>
  <head>
     <title>Home</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
     
	 <style>
	 .carousel-item {
		height: 100vh;
		min-height: 350px;
		background: no-repeat center center scroll;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
	 }

  body{
     /* background-image:url("24-7/827001%20(1).jpg"); */
/* 	 background-repeat: no-repeat;
	 background-attachment: fixed;
	 background-position: center; */
		  min-width: 100%;
		  /* Create the parallax scrolling effect */
/* 		  background-attachment: fixed;
		  background-position: center;
		  background-repeat: no-repeat;
		  background-size: cover;   */
		  /* background-color: #08D6D8; */
		  background: #005C97;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #363795, #005C97);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #363795, #005C97); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}



	 </style>
	 
	 
	 <script>
	 //search product function
            $(document).ready(function(){
	
	             $("#search_text").keypress(function()
	                      {
	                       load_data();
	                       function load_data(query)
	                           {
		                        $.ajax({
			                    url:"fetch.php",
			                    method:"post",
			                    data:{query:query},
			                    success:function(data)
			                                 {
				                               $('#result').html(data);
			                                  }
		                                });
	                             }
	
	                           $('#search_text').keyup(function(){
		                       var search = $(this).val();
		                           if(search != '')
		                               {
			                             load_data(search);
		                                }
		                            else
		                             {
			                         load_data();			
		                              }
	                                });
	                              });
	                            });
</script>
<style>
      h5{
        color: #D0E9ED;
      }

      ul li {list-style:none;}
      ul li a{color:white; font-weight:bold;}
      ul li a:hover{text-decoration:none;}

/* our css */

a.nav-link {
    font-weight: bold;
}

.about_pp{
	position: relative;
	top: 7;
}

.pp {
    position: relative;
    top: 7;
}




		.container-fluid .content {
		  position: absolute;
		  bottom: 20%;
		  left: 65%;
/* 		  background: rgb(0, 0, 0); /* Fallback color */
		  /* background: rgba(0, 0, 0, 0.5); Black background with 0.5 opacity */ 
		  background-color: white;
		  color: black;
		  width: 25%;
		  height: 50%;
		  padding: 20px;
		}

		.content h1{
			/* font-size: 5em; */
			text-align: center;
			/* word-spacing: 50px; */
		}

		.text{
			max-width: 80%;
			max-height: 50%;
			margin: 0 auto;
		}


</style>
  </head>
  
    
	<body>
	<!--navbar start-->

<div id="result" style="position:fixed;top:100; right:50;z-index: 3000;width:350px;background:white;"></div>
<!--  navbar code start-->

		  <form method="post">
          <?php
			if(empty($cust_id))
			{
			?>

					 <?php
						include("login.php");
					?>

            <?php

			}
			else
			{
			?>

					 <?php
						include("logout.php");
					?>

			<?php
			}
			?>
			</form>

<!-- navbar code end  -->
<br><br>
<!-- <div class="container-fluid">
  <img src="24-7/767254.jpg" width='100%'/>
  <div class="content">

	    		<h1>FOOD</h1>
	    		<h1>SERVICES</h1>
	  		</div>
</div> -->
<br><br>
<div class="container-fluid" style="">
	<div class="text">
<h1 style="color:white; text-align:center;">About Food Services</h1>
<br>
<h4 style="color:white; text-align:center; text-transform:uppercase;">we do this by</h4>
<h4 style="color:white; text-align:center; text-transform:uppercase;">Helping people discover great places around them.</h4><br>
<p style="color:white; text-align:center; font-size:20px;">Our team gathers information from every restaurant on a regular basis to ensure our data is fresh. Our vast community of food lovers share their reviews and photos, so you have all that you need to make an informed choice.
<br>
Building amazing experiences around dining.
<br>Starting with information for over 1 million restaurants (and counting) globally, we're making dining smoother and more enjoyable with services like online ordering and table reservations.
</p>
</div>
</div>

<br><br>
<div class="container-fluid" style="background:white; text-transform:uppercase;padding:20px; border-left:10px solid black"><h3>locate us</h3></div>
<div class="container-fluid">
<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="304" id="gmap_canvas" src="https://maps.google.com/maps?q=hotel%20limontree&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.emojilib.com">emojilib.com</a></div><style>.mapouter{position:relative;text-align:right;height:304px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:304px;width:100%;}</style></div>
</div>


			 <?php
				include("footer.php");
			?>







	</body>
</html>