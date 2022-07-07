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
        <link rel='stylesheet' href='stylea.css' type='text/css' media='all' />
        <script src="index.js"></script>
        <script src="slideimg.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400&display=swap" rel="stylesheet">
                        <!--icon-->
<script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
<!-- MDB -->
<link rel="stylesheet" href="custom css/mdb.min.css" />
 <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="custom css/bootstrapaa.css">
  <!-- Material Design Bootstrap -->
   <link rel="stylesheet" href="custom css/mdbaa.css">
 
  

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

// Check user login or not
include "config.php";
if(!isset($_SESSION['uname'])){
    header('Location:rentbazar.php');

}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location:rentbazar.php');
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
if(isset($_SESSION['status'])){
 echo $_SESSION['status'];
unset($_SESSION['status']);
}

?>



                
                                <!-- Header 1-->
     <header class="header1">
                <header class ="mini-head">
                <a href="index.php" class="ripple"><img class="logo" src="images/logo.png "> </a>

                <div class="search">
  <form name="searchform" method="get" action="search.php" onsubmit="return(searcherror());">
    <input class="searchbox" type="text" placeholder="What are you looking?" name="searchproducts" id="searchpro" autocomplete="off">

  <button class="search-b ripple" type="submit">
	<lord-icon class="icon"
         src="https://cdn.lordicon.com/msoeawqm.json"
         trigger="morph"
         colors="primary:#121331,secondary:#08a88a"
         stroke="100"
         scale="60"
         style="width:40px;height:44px">
        </lord-icon>
</button>
</form>
                </div>

                <!-- For cart counter -->
                <?php
include "config.php";
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "
        <script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
		  toast.addEventListener('mouseenter', Swal.stopTimer)
		  toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	    })
	    
	    Toast.fire({
		icon: 'success',
		title: 'Product added to cart!'
	    })
	    </script>
	";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = '
		<script>
	const Toast = Swal.mixin({
		toast: true,
		position: "top",
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
		  toast.addEventListener("mouseenter", Swal.stopTimer)
		  toast.addEventListener("mouseleave", Swal.resumeTimer)
		}
	    })
	    
	    Toast.fire({
		icon: "error",
		title: "Product already added to cart!"
	    })
	    </script>
		';	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "
	<script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
		  toast.addEventListener('mouseenter', Swal.stopTimer)
		  toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	    })
	    
	    Toast.fire({
		icon: 'success',
		title: 'Product added to cart!'
	    })
	    </script>
	";
	}
	}
}
?>
                <div class="cart-button">
                      <a  href="cart.php ">
                      <div class="cart-counter">
                          <?php $count=0;
                          if(isset($_SESSION['shopping_cart']))
                          {
                            $count=count($_SESSION['shopping_cart']);
                          }
                          echo ($count); 
                          ?>
                      </div>
                      <lord-icon class="carticon ripple"
                              src="https://cdn.lordicon.com/slkvcfos.json"
                              trigger="hover"
                              colors="primary:#121331,secondary:#08a88a"
                              stroke="70"
                              scale="60">
                      </lord-icon>
                      </a>
                   <div class="dropdown">
                        <button class="dropbtn ripple"><lord-icon class="avatar"
                                src="https://cdn.lordicon.com/dxjqoygy.json"
                                trigger="hover"
                                colors="primary:#08a88a,secondary:#08a88a"
                                stroke="120"
                                scale="60">
                        </lord-icon>
<span class="user-name">
<?php
echo "".strtoupper("$fname");
?></span>
</button>
                        
                        <div class="dropdowncontenthome">
<div class="ripple">
<div class="d-name">
<a href="my-account.php">
<img class="d-userimg" src="https://avatars.dicebear.com/api/initials/
<?php
	echo "".$fname." ".$lname;
	?>.svg">
<div class="d-username">
<span class="d-fname">
<?php
	echo "".$fname." ".$lname;
	?></span><br><?php
	echo "".$email;
	?>
</a>
</div>
</div>
</div>

<div class="d-1flex">     
  <a href="orders.php"><div class="d-orders ripple"><img src="images/icons/orders.png" width="40px">Orders</div></a>
   	<a href="cart.php"><div class="d-mycart ripple"><img src="images/icons/mycart.png" width="40px"><br>My Cart</div></a>
<a href="#"><div class="d-rewards ripple"><img src="images/icons/reward.png" width="40px">Rewards</div></a>
</div>
      <div class="d-2flex">
        <a href="#"><div class="d-vouchers ripple"><img src="images/icons/voucher.png" width="40px">Vouchers</div></a>
			<a href="#"><div class="d-noti ripple"><img src="images/icons/notification.png" width="40px">Notification</div></a>
			<a href="#"><div class="d-wishlist ripple"><img src="images/icons/wishlist.png" width="40px"><br>Wish List</div></a>
    </div>
			
    <div class="ripple"><div class="d-feed"><a href="#"><img src="images/icons/feedback.png" width="45px"><div class="d-feedback"><span class="d-cfeed">My Feedback</span></a></div></div></div>
    <div class="ripple"><div class="d-feed"><a href="#"><img src="images/icons/support.png" width="45px"><div class="d-feedback"><span class="d-cfeed">Help & Support</span></a></div></div></div>
                        
  <form method='post' action="">
<button class="logoutbtn ripple" value="Logout" name="but_logout" onclick="logout()">
<img class="log" width="49px" src="https://img.icons8.com/fluency/48/000000/shutdown.png"><div class="d-log">Sign Out</div></button>
</form>

<script>
function logout(){
Swal.fire({
  icon: 'success',
  title: 'Sign Out Successfully!',
text: "You have been Sign Out",
  showConfirmButton: false,
backdrop: `
    rgba(0,0,123,0.4)`,
  timer: 3000
})

}
</script>
     
                        </div>
                      </div>
              
                </div>
                </header>
        </header>

       
                  
                               <!-- header 2-->

<br><header class="header2">
   <ul class="div2">
                        <li class="sub-cate"><a href="#">                    
                                <div class="category-dropdown">
                                <a class="category">CATEGORIES </a><img src="images/down-arrow.png" class="dropicon"><br><br>
                                <div class="category-content">
                                <div class="category1">
                                <a href="#"><img src="images/icons/electronics.png" class="category-icon"><span class="category-text">Electronic Items</span></a>
                                <a href="#"><img src="images/icons/furnitures.png" class="category-icon"><span class="category-text">Furniture</span></a>
                                <a href="#"><img src="images/icons/clothing.png" class="category-icon"><span class="category-text">Clothing</span></a>
                                <a href="#"><img src="images/icons/sports.png" class="category-icon"><span class="category-text">Sports & Fitness</span></a>
                                <a href="#"><img src="images/icons/books.png" class="category-icon"><span class="category-text">Books</span></a>
                                </div>
                                <div class="category2">
                                <a href="#"><img src="images/icons/car.png" class="category-icon"><span class="category-text">Car & Motorbike</span></a>
                                <a href="#"><img src="images/icons/camping.png" class="category-icon"><span class="category-text">Outdoor & Camping</span></a>
                                <a href="#"><img src="images/icons/health.png" class="category-icon"><span class="category-text">Health & Personal care</span></a>
                                <a href="#"><img src="images/icons/watercraft.png" class="category-icon"><span class="category-text">Watercraft</span></a>
                                <a href="#"><img src="images/icons/tools.png" class="category-icon"><span class="category-text">Equipments</span></a> 
                                </div>
                                </div>
                                </div> 
                        </a></li>
                        <li class="sub-cate"><a href="#"> BLOGS </a></li>
                        <li class="sub-cate"><a href="#"> GALLERY </a></li>
                        <li class="sub-cate"><a href="#"> OFFERS </a></li>
               </ul>
        
         </header>

                                <!-- Banner offer -->
        <div class="banner" id="banner">
                <form action="" class="form-banner">
                        <img src="images/">
                        </form>
                      </div>

                                       <!-- Page 1-->
  <!--image slider start-->
  <div class="slider">
        <div class="slides">
          <!--radio buttons start-->
          <input type="radio" name="radio-btn" id="radio1">
          <input type="radio" name="radio-btn" id="radio2">
          <input type="radio" name="radio-btn" id="radio3">
          <input type="radio" name="radio-btn" id="radio4">
          <!--radio buttons end-->
          <!--slide images start-->
          <div class="slide first">
            <img src="images/banner 1.png" alt="">
          </div>
          <div class="slide">
            <img src="images/banner 2.png" alt="">
          </div>
          <div class="slide">
            <img src="images/banner 4.png" alt="">
          </div>
          <div class="slide">
            <img src="images/banner 3.jpg" alt="">
          </div>
          <!--slide images end-->
          <!--automatic navigation start-->
          <div class="navigation-auto">
            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn3"></div>
            <div class="auto-btn4"></div>
          </div>
          <!--automatic navigation end-->
        </div>
        <!--manual navigation start-->
        <div class="navigation-manual">
          <label for="radio1" class="manual-btn"></label>
          <label for="radio2" class="manual-btn"></label>
          <label for="radio3" class="manual-btn"></label>
          <label for="radio4" class="manual-btn"></label>
        </div>
        <!--manual navigation end-->
      </div>
      <!--image slider end-->

 
<div class="message_box">
<?php echo $status; ?>
</div>


        <div class="page1">


             			 <!-- Explare Rentbazar -->

    <div class="name_button">
    <div><h3 class="p1-heading">Explore Rentbazar</h3></div>
      <div><a href="shop.php">
      <button type='button' class='btn btn-primary viewall'>View all</button></a></div>
    </div>

        <div class="exploreimg">
        <div class="card ripple"><img src="product-images/mobiles-tablets-on-rent_1576578337.png"><button>Android Mobiles & Tablets</button></div>
        <div class="card ripple"><img src="product-images/tv.png"><br><button>T.V</button></div>
        <div class="card ripple"><img src="product-images/laptops-on-rent_1576578022.png"><button>Laptops</button></div>
        <div class="card ripple"><img src="product-images/Macbook.png"><button>Apple Products & Macbook</button></div>
        </div><br><br>

                                        <!-- trending Products -->

  <div class="name_button">
    <div><h3 class="p1-heading">Treding Products</h3></div>
<div><a href="shop.php">
<button type='button' class='btn btn-primary viewall'>View all</button></a></div>
    </div>

  <?php
if(!empty($_SESSION["shopping_cart"])){
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<?php
}
$result = mysqli_query($con,"SELECT * FROM `products` WHERE category= 'trends' ");
while($row = mysqli_fetch_assoc($result)){
echo "
<div class='product_wrapper'>
<form method='post' action=''>
<input type='hidden' name='code' value=".$row['code']." />
<div class='card'><img class='product-img' src=".$row['image'].">
<div class='name'><b>".$row['name']."</b></div>
<div class='price'>Rs ".$row['price']." /Month</div>

<div class='buy-button'>
<a href=product-details.php?product=".$row['code'].">
<button type='button' class='btn btn-primary card-button'>View Details</button>
</a>
<button type='submit' class='btn btn-primary card-button'>Add to Cart</button>
</div></div>
</form>
</div>
";
}
mysqli_close($con);
?>
<div style="clear:both;"></div>


                                        <!-- laptops -->

<div class="name_button">
    <div><h3 class="p1-heading">Loptops</h3></div>
      <div><a href="shop.php">
      <button type='button' class='btn btn-primary viewall'>View all</button></a></div>
    </div>

        <?php
include "config.php";
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "
        <script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
		  toast.addEventListener('mouseenter', Swal.stopTimer)
		  toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	    })
	    
	    Toast.fire({
		icon: 'success',
		title: 'Product added to cart!'
	    })
	    </script>
	";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = '
		<script>
	const Toast = Swal.mixin({
		toast: true,
		position: "top",
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
		  toast.addEventListener("mouseenter", Swal.stopTimer)
		  toast.addEventListener("mouseleave", Swal.resumeTimer)
		}
	    })
	    
	    Toast.fire({
		icon: "error",
		title: "Product already added to cart!"
	    })
	    </script>
		';	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "
	<script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
		  toast.addEventListener('mouseenter', Swal.stopTimer)
		  toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	    })
	    
	    Toast.fire({
		icon: 'success',
		title: 'Product added to cart!'
	    })
	    </script>
	";
	}
	}
}
?>
<div class="message_box">
<?php echo $status; ?>
</div>
  <?php
if(!empty($_SESSION["shopping_cart"])){
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<?php
}

$result = mysqli_query($con,"SELECT * FROM `products` WHERE category= 'laptops'");
while($row = mysqli_fetch_assoc($result)){
echo "<div class='product_wrapper'>
<form method='post' action=''>
<input type='hidden' name='code' value=".$row['code']." />
<div class='card'><img class='product-img' src=".$row['image'].">
<div class='name'><b>".$row['name']."</b></div>
<div class='price'>Rs ".$row['price']." /Month</div>

<div class='buy-button'>
<a href=product-details.php?product=".$row['code'].">
<button type='button' class='btn btn-primary card-button'>View Details</button>
</a>
<button type='submit' class='btn btn-primary card-button'>Add to Cart</button></div></div>
</form>
</div>";
}
mysqli_close($con);
?>
<div style="clear:both;"></div>

                                        <!-- Mobiles  -->
     <div class="name_button">
    <div><h3 class="p1-heading" >Mobiles</h3></div>
      <div><a href="shop.php">
      <button type='button' class='btn btn-primary viewall'>View all</button></a></div>
    </div>

        <?php
include "config.php";
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "
        <script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
		  toast.addEventListener('mouseenter', Swal.stopTimer)
		  toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	    })
	    
	    Toast.fire({
		icon: 'success',
		title: 'Product added to cart!'
	    })
	    </script>
	";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = '
		<script>
	const Toast = Swal.mixin({
		toast: true,
		position: "top",
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
		  toast.addEventListener("mouseenter", Swal.stopTimer)
		  toast.addEventListener("mouseleave", Swal.resumeTimer)
		}
	    })
	    
	    Toast.fire({
		icon: "error",
		title: "Product already added to cart!"
	    })
	    </script>
		';	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "
	<script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
		  toast.addEventListener('mouseenter', Swal.stopTimer)
		  toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	    })
	    
	    Toast.fire({
		icon: 'success',
		title: 'Product added to cart!'
	    })
	    </script>
	";
	}
	}
}
?>
<div class="message_box">
<?php echo $status; ?>
</div>
  <?php
if(!empty($_SESSION["shopping_cart"])){
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<?php
}

$result = mysqli_query($con,"SELECT * FROM `products` WHERE category= 'mobiles'");
while($row = mysqli_fetch_assoc($result)){
echo "<div class='product_wrapper'>
<form method='post' action=''>
<input type='hidden' name='code' value=".$row['code']." />
<div class='card'><img class='mobile-img' src=".$row['image'].">
<div class='name'><b>".$row['name']."</b></div>
<div class='price'>Rs ".$row['price']." /Month</div>

<div class='buy-button'>
<a href=product-details.php?product=".$row['code'].">
<button type='button' class='btn btn-primary card-button'>View Details</button>
</a>
<button type='submit' class='btn btn-primary card-button'>Add to Cart</button></div></div>
</form>
</div>";
}
mysqli_close($con);
?>
<div style="clear:both;"></div>


        </div>

                                                <!-- OUR Services -->
        <div class="services">
                <h1>OUR SERVICES</h1>
        <div class="ourservices">
                <div class="serve ripple">
                        <video class="videos1" src="images/support.mp4"autoplay loop></video>
                        <h2>24/7 Support</h2>
                        <p>on order related queries</p>
                </div>
                <div class="serve ripple">
                        <video class="videos2" src="images/return.mp4" autoplay loop></video>
                        <h2>Return within 30 days</h2>
                        <p>of receiving your order</p>
                </div>
                <div class="serve ripple">
                        <video class="videos3" src="images/delivery.mp4" autoplay loop></video>
                        <h2>Get free delivery</h2>
                        <p>on order above 500</p>
                </div>
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
                        <input type="text" name="name" id="name" class="form-control contus"  pattern="[A-Za-z ]{4,}" title="Use Letters Only" required>
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
                <form action="" method="post" class="newsletter">
                <div>
                <input type ="email" class="newsbox" placeholder="E-mail address" required></div>
                <div>
                <button type="submit" class="newsbutton"><b>Go</b></button></div>
                </form>
                
        </div></div>
        <hr><div class="copy">
        <img class="copyright" src="https://img.icons8.com/ios-glyphs/30/ffffff/copyright.png"/>RentBazar. 2021. All Rights Reserved
        <img class="copyimg" src="images/payment.png"></div>
        </footer>
        <div class="bottom"></div>

                         <!-- div for preloader don't delete "stupid" -->
                                        </div>
                                        </div>
	<!-- End your project here-->
 <!-- MDB -->
 <script type="text/javascript" src="custom css/mdb.min.js"></script>
 

 <!-- End your project here-->

  
<script type="text/javascript"src="custom css/jqueryaa.js"></script>
 
<script 

type="text/javascript"src="custom css/popperaa.js"></script>
  
<script type="text/javascript" 

src="custom css/bootstrapaa.js"></script>
  
<script type="text/javascript" 

src="custom css/mdbaa.js"></script>
  
</body>
</html>
