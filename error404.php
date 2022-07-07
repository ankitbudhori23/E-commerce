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
  <script src="slideimg.js"></script>
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
                
                                   <!-- Header 1-->

<?php
ob_start();
include "header.php"; 

?>    
 

                                <!-- Banner offer -->
        <div class="banner" id="banner">
                <form action="" class="form-banner">
                        <img src="images/">
                        </form>
                      </div>

                        
                     <img class="error404" src="images/e404.jpg">
                     
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
    if(isset($_POST['contact_us']))
    {    

      $name =  $_POST['name'];
      $email =  $_POST['email'];
      $mobile = $_POST['mobile'];
      $message = $_POST['message'];
      $customer_type = $_POST['customer'];
  
      date_default_timezone_set("Asia/Calcutta");
      $insertdate = date("d-m-Y g:i:s A");

      $sql = "INSERT INTO contact_us(name,email,mobile,message,customer_type,msg_send_time) VALUES('$name','$email','$mobile','$message','$customer_type','$insertdate')";
               

      if (mysqli_query($con, $sql)) {
        echo '<script type="text/javascript">feedback_submit();</script>';
       } else {
        echo "Error: " . $sql ." ". mysqli_error($con);
       }
       mysqli_close($con);

        }
?>
	
                <div class="feedback">
                    <form class="" method="POST">
                        <label for="name">NAME</label><br>
                          <input class="feed-input" type="text" name="name" id="name" pattern="[A-Za-z ]+" title="Use Letters Only"  required><br><br>
        
                        <label for="Email">EMAIL</label><br>
                          <input class="feed-input" type="email" name="email" id="Email" required><br><br>
        
                        <label for="mobile">MOBILE NO.</label><br>
                          <input class="feed-input" type="text" name="mobile" id="mobile" pattern="[0-9]{10}" title="10 numeric characters only"  required><br><br>
        
                        <label for="msg">LEAVE YOUR MESSAGE HERE</label><br>
                          <textarea class="feed-input" name="message" id="msg" cols="1" rows="1" required ></textarea><br><br>

        
 <label for="customer">CUSTOMER TYPE?</label><br><br>
            
   <label><input type="radio" name="customer" value="new"  required>
                         NEW CUSTOMER<br><br></label>
                          
   <label><input type="radio" name="customer" value="Existing" required>
                            EXISTING CUSTOMER</label><br><br>
                            <br>
                  <button class="feed-sumbit" type="submit" name="contact_us" value="submit">Submit</button>
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
