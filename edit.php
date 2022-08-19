<?php
session_start();
include("connection.php");
extract($_REQUEST);
if(isset($_SESSION['cust_id']))
{
	 $cust_id=$_SESSION['cust_id'];
     $cquery=mysqli_query($con,"select * from tblcustomer where fld_email='$cust_id'");
   $cresult=mysqli_fetch_array($cquery);



  //  echo $cust_id;

}


if(isset($update))
{
  $query=mysqli_query($con,"select * from tblcustomer where fld_email='$email'");
	$row=mysqli_num_rows($query);
  
  $query1=mysqli_query($con,"select * from tblcustomer where fld_name='$name'");
	$row1=mysqli_num_rows($query1);

  $password = $_POST['password'];
	// $password = password_hash($password,PASSWORD_BCRYPT);
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);

  $id = $_REQUEST['cust_id'];

  if($row > 0)
	{
		$ermsg2="Email already registered with us";
	}
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL) || $email == ''){
		$ermsg2= "Invalid Email Id";
    $ermsg2= "Email should not be empty";
	}
  elseif($row1 > 0){
		
		$name_error="Username already registered with us";
	}
  elseif($name == ''){
		
		$name_error="Username should not be empty";
	}
  elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || $password == ''){
		$password_error = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    $password_error = 'Password Should not be empty';
  }
  elseif($mobile == ''){
		
		$mobile_error="Mobile Number should not be empty";
	}
  else
  {
  $update = mysqli_query($con,"UPDATE tblcustomer SET fld_name = '".$name ."',
								fld_email = '".$email ."',
								password = '".$password ."',		
								fld_mobile = '".$mobile ."' WHERE fld_email= '".$cust_id ."'");
								echo "Record Modified Successfully";
  }
}

$result = mysqli_query($con,"SELECT * FROM tblcustomer WHERE fld_email = '$cust_id' ");
$row= mysqli_fetch_array($result);
 

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <!-- <title>Material Login Form</title> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		
		<style>
      h5{
        color: #D0E9ED;
      }

      ul li {list-style:none;}
      ul li a{color:white; font-weight:bold;}
      ul li a:hover{text-decoration:none;}

		/* .tab-content>.active {
			display: block;
		} */

		.nav-link>.active{
			display: block;
		}

    .up {
    position: relative;
    top: -6px;
}

  input#name {
    width: 421px;
}


    .pp{
    position: relative;
    top: 5px;
  }


		</style>
</head>
<body>
<!--  navbar code start-->


<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:white; font-family: 'Permanent Marker', cursive;" class="logo1">Food Services</span></a>
    <?php
  if(!empty($cust_id))
  {
  ?>
  <a class="navbar-brand pp_up" style="color:white; text-decoration:none;"><i class="far fa-user">
    <?php echo $cresult['fld_name']; ?></i></a>
  <?php
  }
  ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" style="background-color: white;border: 1px solid white;" type="button"  data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
  
      <ul class="navbar-nav ml-auto ">
        

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
    </li>
        <li class="nav-item">
          <a class="nav-link pp text-light" href="edit.php">Edit</a>
        </li> 
    <li class="nav-item">
      <form method="post">
          <?php
      if(empty($cust_id))
      {
      ?>
      <a href="form/index.php?msg=you must be login first"><span style="color:red; font-size:30px;"><i class="fa fa-shopping-cart " aria-hidden="true">&nbsp;<span style="color:red;" id="cart"  class="badge badge-light ">0</span></i></span></a>
      
      &nbsp;&nbsp;&nbsp;
      <button class="btn btn-danger my-2 my-sm-0" name="login" type="submit">Log In</button>

            <?php

      }
      else
      {
      ?>
      <a href="form/cart.php"><span style=" color:green; font-size:30px;"><i class="fa fa-shopping-cart " aria-hidden="true">&nbsp;<span style="color:green;" id="cart"  class="badge badge-light"><?php 

       $query=mysqli_query($con,"select tbfood.foodname,tbfood.fldvendor_id,tbfood.cost,tbfood.cuisines,tbfood.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbfood inner  join tblcart on tbfood.food_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
      $re=mysqli_num_rows($query);

      if(isset($re)) { echo $re; }?></span></i></span></a>
      &nbsp;
      <button class="btn btn-success my-2 my-sm-0 up" name="logout" type="submit">Log Out</button>
      <?php
      }
      ?>
      </form>
        </li>
    
      </ul>
    
    </div>
  
</nav>




<!-- navbar code end  -->
<br><br><br><br><br>
<div class="middle" style=" margin:0px auto;width:427px;">
       <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#2188ff;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" id="update-tab" style="color:#BDDEFD;" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Update my Account</a>
          </li>
       </ul>
	   <br><br>
	   <div class="tab-content" id="myTabContent">
			
			<!--new account Section-- starts-->
            <div class="nav nav-tabs nabbar_inverse" id="update" role="tabpanel" aria-labelledby="home-tab">
			    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="name"  class="form-control" name="name" value="<?php if(isset($row['fld_name'])) {echo $row['fld_name'];}?>" required="required"/>
					  <div class="footer" style="color:red;"><?php if(isset($name_error)) { echo $name_error; }?></div>
                    </div>
					
					<div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" id="email" name="email" class="form-control" value="<?php if(isset($row['fld_email'])) {echo $row['fld_email'];}?>"  />
					  <div class="footer" style="color:red;"><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
                    </div>
					
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="password" class="form-control" id="pwd" value="<?php if(isset($row['password'])) {echo $row['password'];}?>" required/>
					          <div class="footer" style="color:red;"><?php if(isset($password_error)) { echo $password_error; }?></div>
                   </div>
				   
				   <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="tel" id="mobile" class="form-control" name="mobile" pattern="[6-9]{1}[0-9]{2}[0-9]{3}[0-9]{4}" value="<?php if(isset($row['fld_mobile'])) {echo $row['fld_mobile'];}?>" placeholder="" required>
					          <div class="footer" style="color:red;"><?php if(isset($mobile_error)) { echo $mobile_error; }?></div>
                    </div>
 
                  <button type="submit" name="update" style=" border:1px solid #2188ff;" class="btn btn-outline-primary">Update my Account</button>
			 </form>
			</div>
            

      </div>
	  </div>
	  <br><br> <br><br> <br><br>
<?php
include("footer.php");
?>
	   
</body>

