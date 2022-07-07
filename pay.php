<!DOCTYPE html>
<html lang="en">
<head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--External links-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel = "icon" href ="images/favicon.png" sizes="16x16" type = "image/x-icon"> 
        <link rel="stylesheet" href="index.css">
        <script src="index.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <link rel="stylesheet" href="stylea.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400&display=swap" rel="stylesheet">
                        <!--icon-->
<script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>

        <title>Rent Bazar</title>
</head>
<body>

                            <!-- pre Loader -->
 <div id="loader" >
<img src="images/rent1.png">
<div class="linePreloader"></div>
</div>
<div id="content" class="animate__animated animate__fadeIn">



<?php
 error_reporting(0);

include "config.php";
// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location:rentbazar.php');

}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: rentbazar.php');
}
$useremail = $_SESSION['uname'];
$sql = "SELECT id,fname,lname,email,phone FROM users WHERE email= '$useremail'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc())    {
$id = $row["id"]; 
$fname = $row["fname"]; 
$lname = $row["lname"]; 
$phone = $row["phone"];
$email = $row["email"];
   }
} else {
   echo "Something Error in User's Database";
}
$con->close();
?>
<?php
include "header.php"
?>
<?php
if(isset($_SESSION['status'])){
 echo $_SESSION['status'];
unset($_SESSION['status']);
}
?>




<style>
.my-div{
display:none;}
</style>

                        <!--PaGE CONTENT  -->
                        <?php
if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
}
?>
<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
}
?>

<?php
if(isset($_SESSION["shopping_cart"]))
    $total_price = 0;
?>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
            
    
   <div class="cartpage">
 <h2 class="headmycart">PAYMENT</h2>  
</div>

<div class="cartcont">


<?php
if(isset($_SESSION["shopping_cart"]))
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr >
<td class="bold-iname"><b>ITEM NAME</b></td>
<td class="bold-iname"><b>RENTAL PERIOD</b></td>
<td class="bold-iname"><b>ITEM PRICE</b></td>
<td class="bold-iname"><b>RENT</b></td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr class="img-im">
<td class="img-img">
<center><img class="cartproduct" src='<?php echo $product["image"]; ?>'/><br><?php echo $product["name"]; ?></center></td>
<td class="img-img">
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<?php echo "<center>".$product["quantity"]." Month</center>"; ?>
</td>
<td class="img-img"> <?php echo "<center>Rs ".$product["price"]."</center>"; ?></td>
<td class="img-img"><?php echo "<center>Rs ".$product["price"]*$product["quantity"]."</center>"; ?></td>

</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="4" align="right">
<span class="totalp">
<strong><b>TOTAL:- <?php echo " Rs ".$total_price; ?></b></strong></span>
</span>
</td>
</tr>

</td>
</tbody>
</table>

        <div class="form-billing">
          <div class="pay-cont">
          <form class="billing-form" method="POST">
          <div class="hp">Select Your Payment Method</div>
            <div class="">
       <div class="custom-control custom-radio">
       <label class="pay-option">
         <input type="radio" data-target-id="1" name="payment" value="COD" class="radioBtn" onclick="generateCaptcha();" required>
              <span class="pay-ltr">CASH ON DELIVERY</span></label><br>

         <div class="my-div me_1" data-target="1"> <br>
         <div class="captcha">
       <div>
<input type="text" class="captcha-main" id="mainCaptcha" readonly="readonly"> 
<img class="captcha-ref"  onclick="generateCaptcha();" src="https://img.icons8.com/external-flatart-icons-flat-flatarticons/64/000000/external-refresh-arrows-flatart-icons-flat-flatarticons.png"/>
</div>
<div>
<input type="text" class="captcha-enter" placeholder="Enter Captcha" id="txtInput" maxlength="4"></div>
<div>         
<input id="Button1" name="cod" class="btn btn-primary captcha-sub" type="button" value="Confirm Order"  onclick="CheckValidCaptcha();"></div><br></div>  <br>  
<span id="s" style="color:red"></span> <br></form>
</div>
           </div> <br>

<?php
include "config.php";
if(isset($_POST['amt']))
{
    $amt = $_POST['amt'];
    $name = $_POST['name'];
    $payment_status="Pending";

 date_default_timezone_set("Asia/Calcutta");
    $added_on=date("d-m-Y g:i:s A");

    $select_order = "select * from orders where email='$useremail'";
    $run_order = mysqli_query($con,$select_order);
    while($row_cart = mysqli_fetch_array($run_order)){
    $o_id = $row_cart['id'];
    }
    
    mysqli_query($con,"update orders set payment_type='$payment_status' WHERE email='$useremail' ORDER BY id DESC LIMIT 1");

    mysqli_query($con,"insert into payment(user_id,order_id,name,email,phone,amount,payment_status,time) values('$id','$o_id','$name','$email','$phone','$amt','$payment_status','$added_on')");

  

    $_SESSION['OID']=mysqli_insert_id($con);

    
}
if(isset($_POST['payment_id']) && isset($_SESSION['OID']))
{
    $payment_id=$_POST['payment_id'];
    mysqli_query($con,"update payment set payment_status='Complete',payment_id='$payment_id' where id='".$_SESSION['OID']."'");

    mysqli_query($con,"update orders set payment_type='Paid Online',transaction_id='$payment_id'  WHERE email='$useremail' ORDER BY id DESC LIMIT 1");
}
?>

           
   <div class="custom-control custom-radio">
   <label class="pay-option">
      <input type="radio" data-target-id="2" name="payment" value="Online Payment" class="radioBtn" required>
              <span class="pay-ltr">ONLINE PAYMENT</span></label><br>
      <div class="my-div me_2" data-target="2"> <br>
      <form class="on-pay">   
<input type="textbox" class="pay-detail" name="name" id="name" value="<?php echo "".$fname." ".$lname; ?>" disabled>
<br/><br/>

<input type="textbox" class="pay-detail" name="email" id="email" value="<?php echo "".$email; ?>" disabled>
<br/><br/>

<input type="textbox" class="pay-detail" name="phone" id="phone" value="<?php echo"".$phone; ?>" disabled >
<br/><br/>
    
<input type="textbox" class="pay-amount" name="amt" id="amt"  value="<?php echo"".$total_price; ?>" disabled/>
<br/><br/>
   
<input type="button" class="btn btn-primary pay-sub" name="btn" id="btn" value="Pay Now" onclick="pay_now()"/>
</form>

</div>
    </div>
    </div>
        </div>
 

           
<div class="shipping_detail">
<?php
include "config.php";
$sql = "SELECT * FROM orders  WHERE email='$useremail' ORDER BY id DESC LIMIT 1";
$result = $con->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc())    {
$ad = $row["address"]; 
$ad2 = $row["address2"]; 
$c = $row["city"]; 
$s = $row["state"]; 
$zc = $row["zipcode"]; 
   }
} else {
   echo "";
}
$con->close();
echo "<div class='shipdet'>Shipping Details</div>";
echo "<div class='dadd'><b>".$fname." ".$lname."</b>";
echo "<br>".$ad;
echo "<br>".$ad2;
echo "<br>".$c." ,".$s." -" .$zc;
echo "<br><br><b>Phone No:- </b>".$phone;
echo "<br><b>Email:- </b>".$email;
echo "</div>";

?>
<a href="placeorder.php"><center>
<input type="button" class="btn btn-primary chg-add" value="CHANGE ADDRESS"></center>
</a>
</div>


        </div>
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
                                        </div>]
</div>
           

            
</body>
</html>
