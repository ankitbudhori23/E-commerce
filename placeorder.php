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
 error_reporting(0);
ob_start();
include "header.php"; 

?>   


<?php
include "config.php";
// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: rentbazar.php');

}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: rentbazar.php');
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
   echo "Something Error in User's Database";
}
$con->close();
?>

<?php
if(isset($_SESSION['status'])){
 echo $_SESSION['status'];
unset($_SESSION['status']);
}

?>
        



<?php 
include "config.php";
    if(isset($_POST['bill-submit']))
    {    
      $first_name =  $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email =  $_POST['email'];
      $address = $_POST['address'];
      $address2 = $_POST['address2'];
      $state = $_POST['state'];
      $city = $_POST['city'];
      $zipcode = $_POST['zipcode'];
      $total_price=$_POST['totlp'];
      
      date_default_timezone_set("Asia/Calcutta");
      $insertdate = date("d-m-Y g:i:s A");
      $orderno = rand();
      $sql = "INSERT INTO orders (user_id,first_name,last_name,email,address,address2,city,state,zipcode,order_time,order_no,total_price) VALUES ('$id','$first_name','$last_name','$email','$address','$address2','$city','$state','$zipcode','$insertdate','$orderno','$total_price')";
      if (mysqli_query($con, $sql)) {
        $lid= mysqli_insert_id($con);
        $_cookie['last'] = $lid;
        header('Location: pay.php');
       } else {
        echo "Error: " . $sql ." ". mysqli_error($con);
       }


       foreach($_SESSION["shopping_cart"] as $orddet ){
        $oname=$orddet['name'];
        $oprice=$orddet['price'];
        $oqty=$orddet['quantity'];
        $otot = $_POST['totlp'];
        $ocode = $orddet['code'];
                    $select_order = "select * from orders where email='$useremail'";
                    $run_order = mysqli_query($con,$select_order);
                    while($row_cart = mysqli_fetch_array($run_order)){
                    $o_id = $row_cart['id'];
                    }

                    $select_code = "select * from products where code='$ocode'";
                    $run_code = mysqli_query($con,$select_code);
                    while($row_cart = mysqli_fetch_array($run_code)){
                    $c_id = $row_cart['id'];
                    }
        $insorddet= "INSERT INTO order_details (order_id,product_id,product_name,product_price,month,total_price) VALUES ('$o_id','$c_id','$oname','$oprice','$oqty','$otot')";
        $run_asd = mysqli_query($con,$insorddet);
       }

       mysqli_close($con);
        }
?>


                        <!--PaGE CONTENT  -->
                        
<div class="cartpage">
 <h2 class="headmycart">SHIPPING DETAILS</h2>  
</div>

<div class="cartcont">
        <div class="form-billing">
          <div class="a">
          <form method="POST" class="billing-form  needs-validation" novalidate >
                          <?php
                        foreach($_SESSION["shopping_cart"] as $ank){
                          $totlp += ($ank["price"]*$ank["quantity"]);
                        }
                          ?>
                        <input type ="hidden" value="<?php echo $totlp; ?>" name="totlp">
          <div class="form-row fre">
              <div class="col-md-6 mb-3 md-form md-outline  not-allowed ">
                <label class="shiplbl" for="validationCustom012jg">First name</label>
                <input type="text" class="form-control billfrm" id="validationCustom012jg" name="first_name" value="<?php echo "$fname" ?>" required  disabled>
                <input type="hidden"  class="hidden" id="firstName" name="first_name" value="<?php echo "$fname" ?>" >
              </div>
              <div class="col-md-6 mb-3 md-form md-outline  not-allowed ">
                <label class="shiplbl" for="validationCustom022q4">Last name</label>
                <input type="text" class="form-control billfrm" id="validationCustom022q4" name="last_name"  value="<?php echo "$lname" ?>" required disabled >
                <input type="hidden" class="hidden" id="lastName" name="last_name"  value="<?php echo "$lname" ?>" >
              </div>
          </div>

              <div class="mb-3 md-form md-outline  not-allowed ">
                <label class="shiplbl" for="validationCustomUsername27yt">Email</label>
                <input type="text" class="form-control billfrm" id="validationCustomUsername27yt" aria-describedby="inputGroupPrepend2" name="email"  value="<?php echo "$email" ?>"  required disabled >
                <input type="hidden" class="hidden" id="email" name="email"  value="<?php echo "$email" ?>" >
              </div>
 
            <div class=" mb-3 md-form md-outline">
              <label  class="shiplbl" for="validationCustom032nbc">Flat, House no., Building, Apartment</label>
              <input type="text" class="form-control billfrm" id="validationCustom032nbc"  pattern=".{8,}" name="address" required>
              <div class="invalid-feedback bill">
                Please provide a valid address.
              </div>
            </div>
            <div class=" mb-3 md-form md-outline">
              <label class="shiplbl" for="validationqCustom01weq42">Area, Street, Sector, Village</label>
              <input type="text" class="form-control billfrm" id="validationqCustom01weq42" pattern=".{8,}" name="address2" required>
              <div class="invalid-feedback bill">
                Please provide a valid address.
              </div>
            </div>

            <div class="form-row qwe">
            <div class="col-md-4 mb-3 md-form md-outline">
              <label class="shiplbl" for="validationCusqqtom052">City</label>
              <input type="text" class="form-control billfrm" id="validationCusqqtom052" pattern=".{4,}" name="city" required>
              <div class="invalid-feedback bill">
                Please provide a valid City.
              </div>
            </div>

            <div class="col-md-4 mb-3 md-form md-outline">
              <label  class="shiplbl" for="valid12ationCusqqtom052">State</label>
              <input type="text" class="form-control billfrm" id="valid12ationCusqqtom052" pattern=".{4,}" name="state" required>
              <div class="invalid-feedback bill">
                Please provide a valid State.
              </div>
            </div>
            <div class="col-md-4 mb-3 md-form md-outline">
              <label class="shiplbl" for="validationCusdwqqtom052">Zip</label>
              <input type="text" class="form-control billfrm" id="validationCusdwqqtom052" name="zipcode"  pattern="[0-9]{6}" title="6 numeric characters only" placeholder="* * * * * *" required>
              <div class="invalid-feedback bill">
                Please provide a valid Zip.
              </div>
            </div>
          </div>
            <hr>  
            <button class="btn btn-primary btn-sm btn-rounded billing-sumbitbtn" type="submit" name="bill-submit">PROCEED TO PAYMENT</button>
        </div>
      </form>

    
        <div class="billing-form2">
          <div class="">
              <h2>MY CART</h2>
            
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
if(isset($_SESSION["shopping_cart"]))
    $total_price = 0;
?>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){ 
?>
<table class="billtable">
<tr>
<td class="tright"><?php echo $product["name"]. " (".$product["quantity"]. " Month)"?></td>
<td class="tleft"><?php echo "Rs ".$product["price"]*$product["quantity"]; ?></td>
</tr>

<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr class="totalbill">

<td class="tright"><b class="billtotal-b">TOTAL</b>
</td>
<td class="tleft"><b class="billtotal-b"><?php echo"Rs ".$total_price; ?></b></td>
</tr>
</table>
<br>
<a href="cart.php">
<button class="btn btn-primary goback-cart">
Edit My Cart</button></a>
</div>
       </div>
        </div>
      </div>
    

<script>
  (function() {
  'use strict';
  window.addEventListener('load', function() {
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.getElementsByClassName('needs-validation');
  // Loop over them and prevent submission
  var validation = Array.prototype.filter.call(forms, function(form) {
  form.addEventListener('submit', function(event) {
  if (form.checkValidity() === false) {
  event.preventDefault();
  event.stopPropagation();
  }
  form.classList.add('was-validated');
  }, false);
  });
  }, false);
  })();
  </script>

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
                                        
                                       
</body>
</html>



