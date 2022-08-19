<?php
session_start();
include("connection.php");
extract($_REQUEST);
if(isset($_SESSION['id']))
{
	header("location:food.php");
}
  if(isset($login))
  {
	$sql=mysqli_query($con,"select * from tblvendor where fld_email='$username' && fld_password='$pswd' ");
    if(mysqli_num_rows($sql))
	{
	 $_SESSION['id']=$username;
	header('location:food.php');	
	}
	else
	{
	$admin_login_error="Invalid Details";	
	}
  }

  if(isset($_POST['forgetpass'])){ 
    $login=$_REQUEST['email'];
    $query = "select * from  tblvendor where (fld_email='$login')"; 
    $res = mysqli_query($con,$query);
    $result=mysqli_fetch_array($res);



    if($result > 0)
    {
     $token = bin2hex(random_bytes(50));
     $tokendata = mysqli_query($con,"UPDATE pass_reset1 SET `token`= '".$token."' WHERE email = '$login' "); 
   $credits= "<br> All rights are reserved | Food Services ";
   $linkvalue = "http://localhost/Food_Services/form/password-reset.php?token=".$token;
   $html = "Hello <b>" .$result['fld_name'] . "</b>, <br><br>  Forgot Your Password ? No problem - you can rest it below 
   <br><br>

   <a href='".$linkvalue."'>
   <button class='cc' style='
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 13px 29px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;' > RESET PASSWORD </button> 
   </a>

    <br><br> <b> Don't need to reset your password </b> <br><br>
      Ignore this email, there are no further steps.
      <br> <br>
      Thanks!
     <br> <br> <center>".$credits."</center>";
     smtp_mailer($login,'Hi',$html);
      echo "yes";
    }
  else{
    echo "NO NO";
  }
    // $to= $_REQUEST['email'];
    // $token = bin2hex(random_bytes(50));
    // $credits="All rights are reserved | Food Services "; 
    // $subject="You have received password reset email"; 
    // $msg="Your password reset link <br> http://localhost/Food_Services/form/password-reset.php?token=".$token." <br> Reset your password with this link .Click or open in new tab<br><br> <br> <br> <center>".$credits."</center>"; 
  
    
  }
  
  
  
  function smtp_mailer($to,$subject, $msg){
  
      require_once("form/smtp/class.phpmailer.php");
  
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "foodservices1111@gmail.com";
    // $mail->Password = "HarshilVishal@#4";
    $mail->Password = "Harshil@12";
    $mail->SetFrom("foodservices1111@gmail.com");
    $mail->Subject = $subject;
    $mail->Body =$msg;
    $mail->AddAddress($to);
    
    if(!$mail->Send()){
      echo "Mailer Error: ";
    }else{
      echo  ' <div class="myclass"> Message has been sent <br /> </div> '; 
    }
  }
  
  ?>

<head>
  <meta charset="UTF-8">
    <title>Hotel Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		
		<style>
		/* ul li{} */
		/* ul li a {color:white;padding:40px; } */
		/* ul li a:hover {color:b;} */

      h5{
        color: #D0E9ED;
      }

      ul li {list-style:none;}
      ul li a{color:white; font-weight:bold;}
      ul li a:hover{text-decoration:none;}
    
		</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:white;font-family: 'Permanent Marker', cursive;">Food Services</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"  style="background-color: white;border: 1px solid white;" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link text-light" href="index.php">Home
                
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="aboutus.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="contact.php">Contact</a>
        </li>
		
		
      </ul>
	  
    </div>
	
</nav>
<br><br><br><br><br><br>
<div class="middle" style="padding:40px; border:1px solid #2188ff; margin:0px auto; width:400px;">
       <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#2188ff;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Hotel Login</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="forgetpass-tab" style="color:#BDDEFD;" data-toggle="tab" href="#forgetpass" role="tab" aria-controls="forgetpass" aria-selected="true">Forget Password</a>
          </li>
         
              <!-- <a class="nav-link" id="profile-tab" style="color:white;"    aria-controls="profile" aria-selected="false">Welcome</a> -->
          
       </ul>
	   <br><br>
	   <div class="tab-content" id="myTabContent">
	   <!--login Section-- starts-->
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
			    <div class="footer" style="color:red;"><?php if(isset($admin_login_error)){ echo $admin_login_error;}?></div>
			  <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                           <label for="username">Username:</label>
                           <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" />
                        </div>
                        <div class="form-group">
                             <label for="pwd">Password:</label>
                             <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" />
                        </div>
                        
                          <button type="submit" name="login" class="btn btn-outline-primary">Log In</button>
                          <a href="vendor-new.php"><button type="button" name="new" class="btn btn-outline-warning">Sign Up for New Account</button></a>
                 </form>
			</div>
			<!--login Section-- ends-->

      <!-- Forget Password Section-- starts -->

      <div class="tab-pane fade" id="forgetpass" role="tabpanel" aria-labelledby="profile-tab">
      <form method="post" enctype="multipart/form-data">

					
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required/>
          </div>



        <button type="submit" onclick="myFunction()" name="forgetpass" style=" border:1px solid #2188ff;" class="btn btn-outline-primary">Send Link</button>
        <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
      </form>
			</div>
			
            
      </div>
    
  </div>
       <br><br><br><br><br>
         <?php
      include("footer.php");
      ?> 
</body>
	 



<script>
function myFunction() {
  alert("Link will be sent to you, Please wait for 10 sec !!!");
}
</script>