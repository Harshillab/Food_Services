<div class="menu">

<?php

$query=mysqli_query($con,"select tblvendor.fld_email,tblvendor.fld_name,tblvendor.fld_mob,
	  tblvendor.fld_phone,tblvendor.fld_address,tblvendor.fldvendor_id,tblvendor.fld_logo,tbfood.food_id,tbfood.foodname,tbfood.cost,
	  tbfood.cuisines,tbfood.paymentmode,tbfood.fldimage from tblvendor inner join
	  tbfood on tblvendor.fldvendor_id=tbfood.fldvendor_id");

  while($res=mysqli_fetch_array($query))
  {

$food_pic= "image/restaurant/".$res['fld_email']."/foodimages/".$res['fldimage'];
		
?>
<div class="food-items">

<img src="<?php echo $food_pic; ?>" alt="album-artwork" class="pic" width="700" height="300">

<div class="details">
	<div class="details-sub">
	
		<h4><?php echo $res['foodname'] ?></h4> 
		<!-- price  -->
		<h4 class="price">
			<?php echo "Rs ".$res['cost']; ?>&nbsp;for 1
		</h4>
	</div>
	<p class="para"> <?php echo $res['cuisines']; ?> </p>
	<button name="addtocart" class="btn btn-primary text-center" value="<?php echo $res['food_id'];?>">ADD TO CART</button>
</div>
		
</div>
<?php }  ?>

</div>