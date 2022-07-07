<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--External links-->
        <link rel = "icon" href ="images/favicon.png" sizes="16x16" type = "image/x-icon"> 
        <link rel="stylesheet" href="index.css">
        <script src="index.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <link rel='stylesheet' href='stylea.css' type='text/css' media='all' />

        
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400&display=swap" rel="stylesheet">
                        <!--icon-->
<script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>

        <title>Rent Bazar</title>
</head>
<body>
                                <!-- pre Loader -->
<div id="loader">
<img src="images/rent1.png">
<div class="linePreloader"></div>
</div>
<div id="content" class="animate__animated animate__fadeIn">
                
                                <!-- Header 1-->
 
<?php
ob_start();
include "header.php"; 
if(isset($_POST['place_order'])) 
{
if(!isset($_SESSION['uname'])){
        echo '<script type="text/javascript">placerror();</script>';
}
else{
        header("location:placeorder.php");
        }
        }
?>    
        
        
        <div class="cartpage">
 <h2 class="headmycart">MY CART</h2>
    </div>





<div class="cartcont">



<?php echo $qa; ?>

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
}

?>



<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td></td>
<td class="bold-iname"><b>ITEM NAME</b></td>
<td class="bold-iname"><b>RENTAL PERIOD</b></td>
<td class="bold-iname"><b>ITEM PRICE</b></td>
<td class="bold-iname"><b>RENT</b></td>
<td></td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr class="img-im">
<td class="img-img"><img class="cartproduct" src='<?php echo $product["image"]; ?>'/></td>
<td class="img-img"><?php echo $product["name"]; ?><br />

</td>
<td class="img-img">
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onchange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1 Month</option>
<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2 Months</option>
<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3 Months</option>
<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5 Months</option>
<option <?php if($product["quantity"]==6) echo "selected";?> value="6">6 Months</option>
</select>
</form>
</td>
<td class="img-img"><?php echo "Rs ".$product["price"]." /Month "; ?></td>
<td class="img-img"><?php echo "Rs ".$product["price"]*$product["quantity"]; ?></td>
<td class="img-img"><form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove ripple'><img width="30px" src="https://cdn2.iconfinder.com/data/icons/thin-line-color-1/21/33-128.png" ></button>
</form></td>
<!-- <td></td> -->

</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<span class="totalp">
<strong>TOTAL: <?php echo" Rs " .$total_price; ?></span></strong>
</span>
</td>
</tr>
<td colspan="5" align="right">
<div class="shopmor">
<div class="shopa">
<a href="shop.php">
<button type="button" class="btn btn-primary mos">CONTINUE SHOPPING</button>
</a>
</div>
<div>
<form method="post" action="">
<button type="submit" name="place_order" class="btn btn-primary placeorder">Checkout</button>
</form>
</div>
</div>
</td>

</tbody>
</table>
  <?php
}else{
	echo "<div>   <center>
	<lord-icon class='maincart'
	src='https://cdn.lordicon.com/slkvcfos.json'
	trigger='hover'
	colors='primary:#121331,secondary:#08a88a'
	stroke='70'
	scale='60'
	style='width:300px;height:300px'>
	</lord-icon><br>
      <h2>Your cart is empty!<br><br>
<a href='shop.php'>
<button class='btn btn-primary shopnow'>Shop now</button>
</a>
      </center><br></div>";
	}
	
?>
</div>
<div style="clear:both;">
</div>





                                <!-- Footer-->
        <div class="topfooter"></div>
        <footer>
        <div class="footermenu">
        <div class="footer-content1">
                <h2>NEED ASSISTANCE?</h2>
                <p>PHONE:-<br>cell (+91) 9898-776-504</p>
                <p>MAIL:-<br>contactus@rentbazar.com</p>
        </div>

        <div class="footer-content2">
                <h2>COMPANY</h2>
                <ul>
                        <li class="f-li"><a href="aboutus.php">About Us</a></li>
                        <li class="f-li"><a href="terms&condi.php">Terms & Conditions</a></li>
                        <li class="f-li"><a href="# ">Privacy Policy</a></li>
                        <li class="f-li"><a href=" #">-------</a></li>
                </ul>
        </div>

        <div class="footer-content3">
               
                <H2>INFORMATION</H2>
                <ul>
                        <li class="f-li"><a href="my-account.php">My Account</a></li>
                        <li class="f-li"><a href="sitemap.php">SiteMap</a></li>
                        <li class="f-li"><a href="#">PAQs</a></li>
                </ul>
        </div>

        <div class="footer-content4">
                <h2>NEWSLETTERS</h2>
                <p>Get all the latest information on events, sales and offers. Sign up for newsletter today.</p>
                <div class="newsletter">
                <form action="" method="post">
                <input type ="email" class="newsbox" placeholder="E-mail address" required>
                <button type="submit" class="newsbutton"><b>Go</b></button>
                </form>
                </div>
        </div></div>
        <hr><div class="copy">
        <img class="copyright" src="https://img.icons8.com/ios-glyphs/30/ffffff/copyright.png"/>RentBazar. 2021. All Rights Reserved
        <img class="copyimg" src="images/payment.png"></div>
        </footer>
        <div class="bottom"></div>



                         <!-- div for preloader don't delete "stupid" -->
                                        </div>
                                        </div>
</body>
</html>