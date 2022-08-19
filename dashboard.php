
<?php
session_start();
include("connection.php");
extract($_REQUEST);
if(!isset($_SESSION['admin']))
{
	header("location:admin.php");
	
}
else
{
	$admin_username=$_SESSION['admin'];
}
if(isset($logout))
{
	unset ($_SESSION['admin']);
	setcookie('logout','loggedout successfully',time() +5);
	header("location:admin.php");
}
if(isset($delete))
{
	header("location:deletefood.php?id=$delete");
}
if(isset($deleteVendor))
{
	header("location:deleteVendor.php?Vendorid=$deleteVendor");
}
$admin_info=mysqli_query($con,"select * from tbadmin where fld_username='$admin_username'");
$row_admin=mysqli_fetch_array($admin_info);
$user= $row_admin['fld_username'];
$pass= $row_admin['fld_password'];

//update
if(isset($update))
{
if(mysqli_query($con,"update tbadmin set fld_password='$password'"))
{
	//$_SESSION['pas_update_success']="Password Updated Successfully Login with New Password";
    unset ($_SESSION['admin']);
	header("location:admin_info_update.php");
}
else
{
	echo "failed";
}

}

if(isset($add))
{

	$coupon_code = $_POST['coupon_code'];
	$discount = $_POST['discount'];
	$que = mysqli_query($con,"insert into coupon_code(`coupon_code`,`discount`) values('$coupon_code','$discount')");
		
}
	
?>
<html>
  <head>
     <title>Admin control panel</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">   
		 <style>
		/* ul li{} */
		h5{
        color: #D0E9ED;
      }

      ul li {list-style:none;}
      ul li a{color:white; font-weight:bold;}
      ul li a:hover{text-decoration:none;}
#social-fb,#social-tw,#social-gp,#social-em{color:blue;}
#social-fb:hover{color:#4267B2;}
#social-tw:hover{color:#1DA1F2;}
#social-gp:hover{color:#D0463B;}
#social-em:hover{color:#D0463B;}

.pp {
    position: relative;
    top: 7;
}

.pl {
    position: relative;
    top: -5;
}


	 </style>
	 <script>
			function delRecord(id)
			{
				//alert(id);
				
				var x=confirm("You want to delete this record? All Food Items Of that Vendor Will Also Be Deleted");
				if(x== true)
				{
					
					//document.getElementById("#result").innerHTML="success";
				  window.location.href='deleteVendor.php?Vendorid=' +id;		
				}
				else
				{
					window.location.href='#';
				}
				
			}
		</script>
  
  </head>
  
    
	<body>

	
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
  
  <a class="navbar-brand pl" href="../index.php" ><span style="color:white;font-family: 'Permanent Marker', cursive;">Food Services</span></a>
  <?php
	if(!empty($admin_username))
	{
	?>
  	<a class="navbar-brand pl" style="color:white; text-decoration:none;" ><i class="far fa-user">Admin</i></a>
  <?php
  }
  ?>
  <button class="navbar-toggler" type="button" style="background-color: white;border: 1px solid white;" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
  
	<ul class="navbar-nav ml-auto">
	  <li class="nav-item active">
		<a class="nav-link pp text-light" href="index.php">Home
			  
			</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link pp text-light" href="aboutus.php">About</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link pp text-light" href="services.php">Services</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link pp text-light" href="contact.php">Contact</a>
	  </li>

	  <?php
		if(isset($_SESSION['admin']))
		{
			?>
			<li class="nav-item">
            <a class="nav-link" href="">
		      <form method="post">
			    <button type="submit" name="logout" class="btn btn-success">Log Out</button>
			  </form>
		    </a>
            </li>
			<?php
		}
		
		?>
	  
	  
	</ul>
	
  </div>
  
</nav>
<!--navbar ends-->
<br><br><br><br>
<!--details section-->
 
<div class="container">
       <!--tab heading-->
	   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#2188ff;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" style="color:#BDDEFD;" id="viewitem-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="viewitem" aria-selected="true">View Food Items</a>
          </li>
          <li class="nav-item">
              <a class="nav-link"  style="color:#BDDEFD;" id="manageaccount-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="manageaccount" aria-selected="false">Account Settings</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:#BDDEFD;"  id="ManageVendors-tab" data-toggle="tab" href="#ManageVendors" role="tab" aria-controls="ManageVendors" aria-selected="false">Manage Vendors</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:#BDDEFD;" id="orderstatus-tab" data-toggle="tab" href="#orderstatus" role="tab" aria-controls="orderstatus" aria-selected="false">Order status</a>
          </li>
		  
		  <li class="nav-item">
              <a class="nav-link" style="color:#BDDEFD;" id="coupon_code-tab" data-toggle="tab" href="#coupon_code" role="tab" aria-controls="coupon_code" aria-selected="false">Add Coupon Code</a>
          </li>

		  <li class="nav-item">
              <a class="nav-link" style="color:#BDDEFD;" id="coupon_codeactive-tab" data-toggle="tab" href="#coupon_codeactive" role="tab" aria-controls="coupon_codeactive" aria-selected="false">Coupon Code</a>
          </li>
		  
		  
       </ul>
	   <br><br>
	<!--tab 1 starts-->   
	   <div class="tab-content" id="myTabContent">
	   
            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="viewitem-tab">
                 <div class="container">
	               <table class="table">
                 <thead>
                    <tr>
                        <th scope="col">Hotel_Id</th>
                            <th scope="col">Food View</th>
                            <th scope="col">Food Cuisines</th>
                            <th scope="col">Hotel Name</th>
                            <th scope="col">Food Id</th>
                            
                            <th scope="col">Remove Vendor</th>
                     </tr>
                 </thead>
				 <tbody>
	<?php
	$query=mysqli_query($con,"select tblvendor.fldvendor_id,tblvendor.fld_name,tblvendor.fld_email,tbfood.food_id,tbfood.foodname,tbfood.cuisines,tbfood.fldimage from  tblvendor right join tbfood on tblvendor.fldvendor_id=tbfood.fldvendor_id");
	    while($row=mysqli_fetch_array($query))
		{
	
	?>			 
                
                    <tr>
                        <th scope="row"><?php echo $row['fldvendor_id'];?></th>
						<td><img src="image/restaurant/<?php echo $row['fld_email']."/foodimages/" .$row['fldimage'];?>" height="50px" width="100px">
						<br><?php echo $row['foodname'];?>
						</td>
						<td><?php echo $row['cuisines'];?></td>
                        <td><?php echo $row['fld_name'];?></td>
                        <td><?php echo $row['food_id'];?></td>
                       
                        
                        
                        
						<form method="post">
                        <td><a href=""><button type="submit" value="<?php echo $row['food_id']; ?>" name="delete"  class="btn btn-danger">Remove </button></td>
                        </form>
                   </tr>
		<?php
		}
		?>		   
                </tbody>
           </table>
	 
	 </div>   	
		  
		   <span style="color:green; text-align:centre;"><?php if(isset($success)) { echo $success; }?></span>
			
		
      	    </div>	 
	  
<!--tab 1 ends-->	   
			
			
			<!--tab 2 starts-->
            <div class="tab-pane fade" id="manageaccount" role="tabpanel" aria-labelledby="manageaccount-tab">
			    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="username" value="<?php if(isset($user)){ echo $user;}?>" class="form-control" name="name" readonly="readonly"/>
                    </div>
					
					
					
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="password" class="form-control" value="<?php if(isset($pass)){ echo $pass;}?>" id="pwd" required/>
                   </div>
				   
				   
 
                  <button type="submit" name="update" style="background:#2188ff; border:1px solid #2188ff;" class="btn btn-primary">Update</button>
                  <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
			 </form>
			</div>
			<!--tab 2 ends-->
			 
			 <div class="tab-pane fade show" id="ManageVendors" role="tabpanel" aria-labelledby="ManageVendors-tab">
			    <div class="container">
	               <table class="table">
                 <thead>
                    <tr>
                        <th scope="col"></th>
                            <th scope="col">Hotel Id/vendor Id</th>
                            <th scope="col">Name</th>
                            
                            
                            <th scope="col">Address</th>
                            <th scope="col">Remove Vendor</th>
                     </tr>
                 </thead>
				 <tbody>
	<?php
	$query=mysqli_query($con,"select  * from tblvendor");
	    while($row=mysqli_fetch_array($query))
		{
	
	?>			 
                
                    <tr>
                        
						<td><img src="image/restaurant/<?php echo $row['fld_email']."/" .$row['fld_logo'];?>" height="50px" width="100px"></td>
                        <th scope="row"><?php echo $row['fldvendor_id'];?></th>
						<td><?php echo $row['fld_name'];?></td>
						<td><?php echo $row['fld_address'];?></td>
                        
                        
                        
                        
                        
						<form method="post">
                        <td><a href="#"  style="text-decoration:none; color:white;" onclick="delRecord(<?php echo $row['fldvendor_id']; ?>)"><button type="button" class="btn btn-danger">Remove Vendor</a></a></td>
                        </form>
                   </tr>
		<?php
		}
		?>		   
                </tbody>
           </table>
	 
	 </div>   	
			 </div>
			 
			 <!--tab 4-->
			 <div class="tab-pane fade" id="orderstatus" role="tabpanel" aria-labelledby="orderstatus-tab">
               <table class="table">
			   <th>Order Id</th>
			   <th>Food Id</th>
			   <th>Customer Email Id</th>
			   <th>order Status</th>
			   <tbody>
			   <?php			   
			   $rr=mysqli_query($con,"select * from tblorder");
			   while($rrr=mysqli_fetch_array($rr))
			   {
				   $stat=$rrr['fldstatus'];
				   $foodid=$rrr['fld_food_id'];
				   $r_f=mysqli_query($con,"select * from tbfood where food_id='$foodid'");
				   $r_ff=mysqli_fetch_array($r_f);
			   
			   ?>
			   <tr>
			   <td><?php echo $rrr['fld_order_id']; ?></td>
			   <td><a href="searchfood.php?food_id=<?php echo $rrr['fld_food_id']; ?>"><?php echo $rrr['fld_food_id']; ?></td>
			   <td><?php echo $rrr['fld_email_id']; ?></td>
			   <?php
			   if($stat=="cancelled" || $stat=="Out Of Stock")
			   {
			   ?>
			   <td><i style="color:orange;" class="fas fa-exclamation-triangle"></i>&nbsp;<span style="color:red;"><?php echo $rrr['fldstatus']; ?></span></td>
			   <?php
			   }
			   else
				   
			   {
			   ?>
			   <td><span style="color:green;"><?php echo $rrr['fldstatus']; ?></span></td>
			   <?php
			   }
			   ?>
			   
			   </tr>
			   <?php
			   }
			   ?>
			   </tbody>
			   </table>
			</div>

			<div class="tab-pane fade" id="coupon_code" role="tabpanel" aria-labelledby="coupon_code-tab">
			    <form method="post">
                    <div class="form-group">
                      <label for="coupon_code">Coupon Code</label>
                      <input type="text" id="coupon_code" class="form-control" name="coupon_code"/>
                    </div>

					<div class="form-group">
                      <label for="discount">Discount</label>
                      <input type="text" id="discount" class="form-control" name="discount" />
                    </div>

					
					<div class="form-group">
                  <button type="submit" name="add" style="background:#2188ff; border:1px solid #2188ff;" class="btn btn-primary">Submit</button>
                    </div>
				</form>
			</div>
			 


			 <!-- tab 6 -->

			 <div class="tab-pane fade show" id="coupon_codeactive" role="tabpanel" aria-labelledby="coupon_codeactive-tab">
			    <div class="container">
	               <table class="table">
                 <thead>
                    <tr>
                        	<th scope="col">Coupon Code</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Status</th>
                     </tr>
                 </thead>
				 <tbody>
	<?php
	$query=mysqli_query($con,"select  * from coupon_code");
	    while($row=mysqli_fetch_array($query))
		{
			$status=$row['status'];
	?>			 
                
                    <tr>
						<td><?php echo $row['coupon_code'];?></td>
						<td><?php echo $row['discount'];?></td>
                        
                    	<td>
						<?php
							if(($status)=='0')
							{
							?>
							<a title="Click To Activate" href="action.php?status=<?php echo $row['id'];?>" 
							onclick="return confirm('Activate <?php echo $data?>');" class="color4 btn btn-success" 
							style="text-decoration:none;" >Activate</a>
							<?php
							}
							if(($status)=='1')
							{
							?>
							<a title="Click To Deactivate" href="action.php?status=<?php echo $row['id'];?>" 
							onclick="return confirm('De-activate <?php echo $data?>');" class="color4 btn btn-danger"
							style="text-decoration:none;" >Deactivate</a>
							<?php
							}
               			 ?> 
						
						</td>
                        
                   </tr>
		<?php
		}
		?>		   
                </tbody>
           </table>
	 
	 </div>   	
			 </div>
			 <!-- tab 6 ends -->
      
	  </div>
	</div>	 
	<br><br><br>
 <?php
			include("footer.php");
			?>
		  

</body>
	
</html>	