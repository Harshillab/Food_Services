<?php
session_start();


include("connection.php");
extract($_REQUEST);
$arr=array();
if(isset($_GET['msg']))
{
	$loginmsg=$_GET['msg'];
}
else
{
	$loginmsg="";
}
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
	// shuffle($arr);

	
}

//print_r($arr);

 if(isset($addtocart))
 {
	 
	if(!empty($_SESSION['cust_id']))
	{
		 
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
if(isset($message))
 {
	 
	 if(mysqli_query($con,"insert into tblmessage(fld_name,fld_email,fld_phone,fld_msg) values ('$nm','$em','$ph','$txt')"))
     {
		 echo "<script> alert('We will be Connecting You shortly')</script>";
	 }
	 else
	 {
		 echo "failed";
	 }
 }

?>
<html>
  <head>
     <title>Home</title>
	 <!--bootstrap files-->
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <!--bootstrap files-->
	 
	 <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
     
	 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	 
	 <script>
	 //search product function
            $(document).ready(function(){
	
	             $("#search_text").keypress(function()
	                      {
	                       load_data();
	                       function load_data(query)
	                           {
		                        $.ajax({
			                    url:"fetch2.php",
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
			                         $('#result').html(data);			
		                              }
	                                });
	                              });
	                            });
								
								//hotel search
								$(document).ready(function(){
	
	                            $("#search_hotel").keypress(function()
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
				                               $('#resulthotel').html(data);
			                                  }
		                                });
	                             }
	
	                           $('#search_hotel').keyup(function(){
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

								
							// 	$(document).ready(function(){  
    						// 		$("#hide").click(function(){  
        					// 			$($('#resulthotel').hide(data);  
    						// 	});  
							// });
</script>
<style>


body{
     /* background-image:url("our_image/bg1.jfif"); */
	 background-repeat: no-repeat;
	 background-attachment: fixed;
	 background-position: center;
	 margin:  0 auto;
}

      h5{
        color: #D0E9ED;
      }

      ul li {list-style:none;}
      ul li a{color:white; font-weight:bold;}
      ul li a:hover{text-decoration:none;}


.container-fluid.animatedParent {
    position:absolute;
    
}


/* our code */

span.logo1 {
    position: relative;
    top: -7;
}

a.nav-link.pp {
    position: relative;
    top: 6;
}

.pp {
    position: relative;
    top: 6;
}

.pp1 {
    position: relative;
    top: 4;
}

.pp_up {
    position: relative;
    top: -6;
}

/* grid */

 *{
 	padding: 0;
 	margin: 0;
 	box-sizing: border-box;
 }


 body{
 	background-color: #f3f3f3;
 	font-family: 'Poppins',sans-serif;
 }

 


 .menu{
 	padding: 0 10px 30px 10px;
 	display: grid;
 	grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
 	grid-gap:  20px 40px;
 }	

 .heading{
 	background-color: #cb202d;
 	color: #ffffff;
 	margin-bottom: 30px;
 	padding: 30px 0;
 	grid-column:  1/-1;
 	text-align: center;
 }

 .heading>h1{
 	font-weight: 400;
 	font-size: 30px;
 	letter-spacing: 10px;
 	margin-bottom: 18px;
 }

  .heading>h1{
 	font-weight: 600;
 	font-size: 22px;
 	letter-spacing: 5px;
 }

 .food-items{
 	display: grid;
 	position: relative;
 	grid-template-rows: auto 1fr;
 	border-radius: 15px;
 	box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
 	opacity: 1;
 }

 .food-items img{
 	position: relative;
 	width: 100%;
 	border-radius: 15px 15px 0 0 ;

 }


/*  .food-items:hover {
    transform: scale(1.011);
    opacity: 0.7;
} */



 h1{
 	grid-column: 1/-1;
 	text-align: center;
 }

 .details{
 	padding: 20px 10px;
 	display: grid;
 	grid-template-rows: auto 1fr 50px;
 	grid-row-gap: 15px;
 }

 .details-sub{
 	display: grid;
 	grid-template-columns: auto auto;
 }

 .details-sub>h5{
 	font-weight: 600;
 	font-size: 18px;
 }

 .price{
 	text-align: right;
 }

 .details>p{
 	color: #6f6f6f;
 	font-size: 15px;
 	line-height: 28px;
 	font-weight: 400;
 	align-items: stretch;
 }

.details>button{

	border: none;
	font-size: 16px;
	font-weight: 600;
	border-radius: 5px;
	width: 180px;
	text-align: center;

}

/* #google_translate_element {
    display: none;
}
 */



/* landing page */


.second img{
			max-width: 98.88vw;
			max-height: 70vw;
		}

		.third{
			display: grid;
			grid-template-columns: 1fr 1fr;
			max-height: 67.2%;

		}

		.third img{
			max-width: 100%;
			max-height: 81%;
			border:  2px solid black;

		}

		.span1{
			text-align: center;
			max-height:80%;
			border:  2px solid black;
			background: #f3f3f3;

		}

		.span1 p{
			letter-spacing: 2px;
			word-spacing: 10px;
			padding: 0 10px;
		}

		.span1 h3{
			font-family: Brush Script MT ,Cursive;
		}

		.four{
			 /* position: relative; */
		  background-image: url("img/icecream.png");
		  /* Set a specific height */
		  min-height: 500px; 
		  /* Create the parallax scrolling effect */
		  background-attachment: fixed;
		  background-position: center;
		  background-repeat: no-repeat;
		  background-size: cover;
		}


		.four p{
			height: 15%;
			text-align: center;
			font-size: 5rem;
			color: red;
			font-family:  Brush Script MT ,Cursive;
		}



/*  */

		.five{
			display: grid;
			grid-template-columns: 1fr 1fr;
			max-height: 75%;

		}

		.five img{
			max-width: 100%;
			max-height: 81%;
			border:  2px solid black;

		}

		.span2{
			text-align: center;
			max-height:80% ;
			border:  2px solid black;
			background: #f3f3f3;
		}

		.span2 p{
			letter-spacing: 2px;
			word-spacing: 10px;
			padding: 0 10px;
		}



/*  */

		.second .content {
		  position: absolute;
		  bottom: 30%;
		  background: rgb(0, 0, 0); /* Fallback color */
		  background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
		  color: #f1f1f1;
		  width: 100%;
		  padding: 20px;

		}

		.content h1{
			font-size: 5em;
			/* word-spacing: 50px; */
		}



		@media only screen and (max-width: 800px){
		  .content h1{
		    font-size: 2.5em;
		  }
		  .second .content{
		  	position: absolute;
		  	bottom: 45%;
		  	padding: 5%;
		  }

		}

		@media only screen and (max-width: 520px){
		  .content h1{
		    font-size: 2em;
		  }
		  .second .content{
		  	position: absolute;
		  	bottom: 60%;
		  	padding: 5%;
		  }

		}


		/* grid */



		@media only screen and (max-width: 800px){

	.third img{
			max-width: 100vw;
			max-height: 80%;
			border:  2px solid black;

		}

		  .third{
		  		display: grid;
		  		grid-template-columns: 1fr;
		  		min-height: 95vh;
		  }

		.span1{
			position: relative;
			text-align: center;
			
			top: -42%;
			height: 10%;
			border: none;

			background: #f3f3f3;
			
		}

		.span1 p{
			letter-spacing: 1px;
			word-spacing: 3px;
			padding: 0 3px;
			font-size: 1rem;
			border:  2px solid black;
			
		}

		.span1 h3{			
			font-family: Brush Script MT ,Cursive;
		}

		h3{
			font-size: 1.5rem;
		}

		h2{
			font-size: 1.7rem;

		}


		.four{
			position: relative;
			top: 50%;
	/* 		min-height: 50%; */
			margin: 40% 0%;
		}

		.four p{
			height: 15%;
			text-align: center;
			font-size: 3.5rem;
			color: red;
			font-family:  Brush Script MT ,Cursive;
		}


		.five{
				display: grid;
		  		grid-template-columns: 1fr;
		  		min-height: 95vh;
		}

		.five img{
			position: relative;
			top: 20%;
		}


		.span2{
			position: relative;
			text-align: center;
			top: -400%;
			border: none;
		}

		.span2 p{
			letter-spacing: 1px;
			word-spacing: 3px;
			padding: 0 3px;
			font-size: 1rem;
			border:  2px solid black;

			
		}

		.span2 h3{			
			font-family: Brush Script MT ,Cursive;
		}



		.myfooter{
			position: relative;
			top: -10%;

		}

	}


		@media only screen and (max-width: 630px){

		.span2{
			position: relative;
			text-align: center;
			
			top: -390%;
			
		}

		.span2 p{
			letter-spacing: 1px;
			word-spacing: 2px;
			padding: 0 2px;
			font-size: 0.9rem;
			
		}

		.span2 h3{			
			font-family: Brush Script MT ,Cursive;
		}


		.myfooter{
			position: relative;
			top: 0%;
		}

	}

		@media only screen and (max-width: 545px){

			.five{
				height: 100vw;
			}


		.span2{
			position: relative;
			text-align: center;
			
			top: -350%;
			height:100% ;
			
		}

		.span2 p{
			letter-spacing: 1px;
			word-spacing: 2px;
			padding: 0 2px;
			font-size: 0.9rem;
			
		}

		.span2 h3{			
			font-family: Brush Script MT ,Cursive;
			font-size: 1rem;
		}

		.span h2{
			font-size: 1.3rem;
		}

		.myfooter{
			position: relative;
			top: -10%;
		}
}

</style>
  </head>
  
    
	<body>
	




<div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:white;"></div>
<div id="resulthotel" style=" margin:0px auto; position:fixed; top:150px;right:750px; background:yellow;  z-index: 3000; " ></div>



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



<!-- visibility: hidden; -->

<!--menu ends-->

		  <form method="post">
          <?php
			if(empty($cust_id))
			{
			?>
			
            <?php

			}
			else
			{
			?>


<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="our_image/brooke-lark-4J059aGa5s4-unsplash%20(2).jpg" alt="Los Angeles" class="d-block w-100">
      <div class="carousel-caption">
        <!-- <h3>Los Angeles</h3>
        <p>We had such a great time in LA!</p> -->
      </div>   
    </div>

    <div class="carousel-item">
      <img src="our_image/randy-fath-otQ6orzFTlk-unsplash.jpg" alt="Chicago" class="d-block w-100">
      <div class="carousel-caption">
        <!-- <h3>Chicago</h3>
        <p>Thank you, Chicago!</p> -->
      </div>   
    </div>

    <div class="carousel-item">
      <img src="our_image/gabrielle-henderson-djY0xDWCEUM-unsplash.jpg" alt="New York" class="d-block w-100">
      <div class="carousel-caption">
        <!-- <h3>New York</h3>
        <p>We love the Big Apple!</p> -->
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
			
			<?php
			}
			?>
			</form>

<!--slider ends-->
<!--container 1 starts-->

<br><br>
		  <form method="post">
          <?php
			if(empty($cust_id))
			{
			?>

		    <?php
				include("landing_page.php");
			?>

            <?php

			}
			else
			{
			?>
		    <?php
				include("products.php");
			?>
			
			<?php
			}
			?>
			</form>

<!--container 1 ends-->

<!--footer primary-->
<br><br>
	     
		     <?php
			include("footer.php");
			?> 
	</body>
</html>