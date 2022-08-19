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
	<button class="navbar-toggler" type="button" data-toggle="collapse" style="background-color: white;border: 1px solid white;" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto ">
        
		<li class="nav-item"><!--hotel search-->
		     <a href="#" class="nav-link"><form method="post"><input type="text" name="search_hotel" id="search_hotel" placeholder="Search Hotels " class="form-control " /></form></a>
		  </li>
          <li class="nav-item">
		     <a href="#" class="nav-link"><form method="post"><input type="text" name="search_text" id="search_text" placeholder="Search by Food Name " class="form-control " /></form></a>
		  </li>
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
			<a href="form/index.php?msg=you must be login first"><span style="color:red; font-size:30px;"><i class="fa fa-shopping-cart pp" aria-hidden="true">&nbsp;<span style="color:red;" id="cart"  class="badge badge-light ">0</span></i></span></a>
			
			&nbsp;&nbsp;&nbsp;
			<button class="btn btn-danger my-2 my-sm-0" name="login" type="submit">Log In</button>

            <?php

			}
			else
			{
			?>
			<a href="form/cart.php"><span style=" color:green; font-size:30px;"><i class="fa fa-shopping-cart pp" aria-hidden="true">&nbsp;<span style="color:green;" id="cart"  class="badge badge-light"><?php if(isset($re)) { echo $re; }?></span></i></span></a>
			&nbsp;
			<button class="btn btn-success my-2 my-sm-0" name="logout" type="submit">Log Out</button>
			<?php
			}
			?>
			</form>
        </li>
		
      </ul>
	  
    </div>
	
</nav>