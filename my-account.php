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
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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

<style>
.my-div{
display:none;}
</style>
<?php
include "header.php";
?>


<?php
include "config.php";
if(isset($_POST['p-update']))
	{
		$fname=$_POST['fname'];
    $lname=$_POST['lname'];
		$no=$_POST['phone'];
    
	$sql="UPDATE users SET fname='$fname', lname='$lname', phone='$no' WHERE email='$email'";
		
  if (mysqli_query($con, $sql)) {
    echo '<script type="text/javascript">personalinfo();</script>';
   } else {
    echo "Error: " . $sql ." ". mysqli_error($con);
   }
   mysqli_close($con);

  }
  ?>
 

   
   <div class="cartpage">
 <h2 class="headmycart">MY ACCOUNT</h2>  
</div>

<div class="cartcont">
        <div class="form-billing">
          <div class="my-acc">

          <form class="billing-form" method="POST">

            <div class="my-mainp">
       <div class="custom-control custom-radio">
       <label class="pay-option"><input type="radio" data-target-id="1" name="payment" value="COD" class="radioBtn" required>
              <span class="pay-ltr">MY PROFILE</span></label>

         <div class="my-div me_1" data-target="1">
         <div class="my-profile">
  <lable  class="my-p"><b><h3>Personal Information</h3></b></lable>
  <lable class="my-sub">Name</lable><br>
  <div class="flex_container">
    <div>
  <input type="textbox" name="fname" class="p-info" value="<?php echo "".$fname; ?>" required></div>
  <div><input type="textbox" name="lname" class="p-info lnaam" value="<?php echo "".$lname; ?>" required></div>
  </div>


  <lable  class="my-sub">Contact No</lable><br>
  <input type="textbox" name="phone" class="p-info" value="<?php echo "".$phone; ?>" required><br>
  <lable  class="my-sub">Email Address</lable><br>
  <input type="textbox" class="p-info not-allowed" value="<?php echo "".$email; ?>" disabled><br>

  <button type="submit" name="p-update" class="p-sub" >UPDATE</button>

</div> 
</form>
</div>
           </div> 


<?php
include "config.php";
if(isset($_POST['pass-update']))
	{
    $old = $_POST['oldpass'];
    $new = $_POST['newpass'];
   
    $sql = "SELECT password FROM users WHERE password='$old' && email= '$useremail'";
  $result = $con->query($sql);
  if ($result->num_rows > 0) 
  {
	 $sql="UPDATE users SET password='$new' WHERE email='$email'";
   if (mysqli_query($con, $sql)) 
   {
    echo '<script type="text/javascript">passchanged();</script>';
   } 
  }
  else{
    echo '<script type="text/javascript">currentpassnot();</script>';
      }
}
  ?>

   <div class="custom-control custom-radio">
   <label class="pay-option"> <input type="radio" data-target-id="2" name="payment" value="Online Payment" class="radioBtn" required>
              <span class="pay-ltr">CHANGE PASSWORD</span></label>
      <div class="my-div me_2" data-target="2"> <br>
      <form class="on-pay" method="post" name="changep" onsubmit="return(changepass());">   

  <lable class="my-sub">Current Password</lable><br>
  <input type="password" name="oldpass" class="p-info" required><br>
  <lable class="my-sub">New Password</lable><br>
  <input type="password" name="newpass"  class="p-info" required><br>
  <lable class="my-sub">Confirm Password</lable><br>
  <input type="password" name="cnewpass"  class="p-info" required><br>
  <button type="submit" name="pass-update" class="p-sub" >UPDATE</button>

  
</form>


    </div>
 </div>
</div>
<div class="left-myacc">
  <div class="progress">
  <b>YOUR CHECKOUT PROGRESS</b>
  </div>
<div class="myaccitem">
  <ul>
    <li><a href ="" >My Account</a></li>
    <li><a href ="" >Shipping / Billing Address</a></li>
    <li><a href ="" >Order History</a></li>
    <li><a href ="" >Payment Pending Order</a></li>
  <ul>
</div>

</div>

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
                                        </div></div>
</div>

            
</body>
</html>
