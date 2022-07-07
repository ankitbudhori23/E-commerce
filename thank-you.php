<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--External links-->
        <link rel = "icon" href ="images/favicon.png" sizes="16x16" type = "image/x-icon"> 
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="stylea.css">

        <script src="index.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        
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




<?php
 error_reporting(0);
include "config.php";
// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: index.php');

}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php');
}
?>

<?php
if(isset($_SESSION['status'])){
 echo $_SESSION['status'];
unset($_SESSION['status']);
}

$useremail =$_SESSION['uname'];
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
   echo "error in users bd";
}
$con->close();
?>

<?php
include "header.php";
?>



                                                <!-- Order Placed Thank You -->
       
       <div class="cartpage">
 <h2 class="headmycart">ORDER PLACED</h2>  
</div>
       
<div class="cartcont">
<center>
             <br> <h1>THANK YOU!,YOUR ORDER HAS BEEN PLACED!</h1>
              <a href='index.php'>
<button class='btn btn-primary shopnow'>SHOP MORE</button></a>
</center>
<br>       <br>     
<div class="oreceipt">

             <p>Dear,<b><?php echo " ".$fname." ".$lname;?></b></p>
              <p>We have received your order! Once your order ships, you will receive an email with tracking information and a copy of your receipt. Please take a moment to confirm the information below is correct.</p>
              <br>       <br>     
              <h2>Your Order</h2>
<br>
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
          
<?php
if(isset($_SESSION["shopping_cart"]))
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>

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
<strong><b>TOTAL:-</b><?php echo" Rs ".$total_price; ?></span></strong>
</span>
</td>
</tr>

</td>
</tbody>
</table>
        
       
  <br><br>        
              <h2>Billing Address</h2>
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

$orderno = $row["order_no"]; 
$otime =$row["order_time"]; 
$ptype =$row["payment_type"]; 
$pid =$row["transaction_id"]; 
   }
} else {
   echo "";
}
$con->close();

        echo "<b>".$fname." ".$lname."</b>";
         echo "<br>".$ad;
         echo "<br>".$ad2;
         echo "<br>".$c." ,".$s." -" .$zc;
         echo "<br><br><b>Phone No:- </b>".$phone;
         echo "<br><b>Email:- </b>".$email;
?>

<br>  <br>  <br>        
              <h2>Order Details</h2>            
                <strong>Order Number:</strong><?php echo " ".$orderno; ?> <br>
                <strong>Order Date:</strong> <?php echo " ".$otime; ?><br>
                <strong>Payment Method:</strong> <?php echo " ".$ptype; ?><br>
                <strong>Reference Number:</strong> <?php echo " ".$pid; ?><br><br>
  
              <p">If you have any questions, please do not hesitate to contact our Customer Support Team on (+91) 9898-776-504 or via Email <a href="#"> contactus@rentbazar.com</a>.</p>
              <br>  
              <h3 >Delivery</h3>
              <p >Please note shipping is to the door only, Monday to Saturday. Additional charges will be applied if the delivery address is changed after the order has shipped or if the delivery company is required to make multiple delivery attempts.</p>
              <p >Requesting specific delivery dates or time frames may also result in additional charges. All shipments require a signature upon delivery.</p>
              <br>  
              <h3 >Tracking Number</h3>
              <p>Once your order has been shipped, you will receive a confirmation including tracking information via email.</p>
              <br>  <br>  
  
    </div>
        </div>


                                                        <!-- FeebBack -->

                                                        <div class="contact-form"> <center><h1>CONTACT US!</h1></center>
                <div class="Contact">
                  <!-- <h2>Contact US!</h2> -->
                    <p class="text">
                        Our complaint resolution process is designed to ensure fast and effcient resolution of your issue at the first point of contact while we always aim to provide you with awesome customer service. We understand that there will be times when you may wish to expres dissatisfaction with our products, service, staff or policies.
                    </p>
                    <p><b>Phone:</b> 9870762321 </p>
                   <p><b>Email:</b> contactus@rentbazar.com </p>
                    <p class="us-head">Registered Office:</p><p>------------<br>-----------</p>
                    <p class="us-head">Branch Office:</p><p>---------------<br>-------------------<br>-------------------</p>
                    <h2>Need Help?</h2>
                    <p class="help">
                        You can drop us an email at contactus@rentbazar.com or call our customer care executive on 
                        Monday to Friday (Between 10:00am to 9:00pm)
                    </p>
                </div>




<?php 
include "config.php";
    if(isset($_POST['contact_us']))
    {    

      $name =  $_POST['name'];
      $email =  $_POST['email'];
      $mobile = $_POST['mobile'];
      $message = $_POST['message'];
      $customer_type = $_POST['customer'];
  
      date_default_timezone_set("Asia/Calcutta");
      $insertdate = date("d-m-Y g:i:s A");

      $sql = "INSERT INTO contact_us(user_id,name,email,mobile,message,customer_type,msg_send_time) VALUES('$id','$name','$email','$mobile','$message','$customer_type','$insertdate')";
               

      if (mysqli_query($con, $sql)) {
        echo '<script type="text/javascript">feedback_submit();</script>';
       } else {
        echo "Error: " . $sql ." ". mysqli_error($con);
       }
       mysqli_close($con);

        }
?>
                <div class="feedback">

                  <form method="POST" class="needs-validation" novalidate>
                      <div class=" md-form">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control contus"   pattern="[A-Za-z ]{4,}" title="Use Letters Only" required>
                        <div class="valid-feedback valid-good">
                          Looks good!
                        </div>
                        <div class="invalid-feedback valid-error">
                          Enter Name
                        </div>
                      </div>
                      <div class="md-form">
                        <label for="Email">Email</label>
                        <input type="email" name="email" id="Email" class="form-control contus" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" required>
                        <div class="valid-feedback valid-good">
                          Looks good!
                        </div>
                        <div class="invalid-feedback valid-error">
                          Enter Email
                        </div>
                      </div>
                      <div class="md-form">
                        <label for="Mobile">Mobile</label>
                        <input type="text" class="form-control contus" name="mobile" id="mobile" pattern="[0-9]{10}" title="10 numeric characters only" required>
                        <div class="invalid-feedback valid-error">
                          Enter Mobile Number
                        </div>
                      </div>

                    
                      <div class="md-form">
                        <label for="message">Leave Your Message here </label>
                        <textarea  class="form-control md-textarea contus" name="message" id="msg" length="120" rows="2" minlength="10" required></textarea>
                        <div class="invalid-feedback valid-error">
                          Enter Your Messsage
                        </div>
                      </div>
                    <label for="customer">Customer Type?</label><br>
                    <div class="cust-type">
                      <label><div>
                          <input
                            class="form-check-input"
                            type="radio"
                            name="customer"
                            id="radioNoLabel1" required value="New Customer"/>
                          <span class="pointer "> New Customer</span>
                      </div></label><br>
                      <label><div>
                          <input
                            class="form-check-input"
                            type="radio"
                            name="customer"
                            id="radioNoLabel2"
                            value="Existing Customer" required/>
                            <span class="pointer "> Existing Customer</span>
                      </div></label>
                    </div><br><br>
                  <button class="btn btn-primary btn-sm btn-rounded feed-sumbit" name="contact_us" type="submit">Submit</button>
                  </form>
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
                                        </div>
                                        </div>
</body>
</html>