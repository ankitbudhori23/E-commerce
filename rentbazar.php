﻿<!DOCTYPE html>
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


                                                          <!-- Header 1-->
                <!-- For cart counter -->
<?php
// error_reporting (0);
include "config.php";
ob_start();
$user_ip = getip();
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$p_id = $row['id'];
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


    <!-- For removing cart items -->
    <?php

if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
$qa = "
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
		title: 'Product removed from cart!'
	    })
	    </script>
		";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}

?>

     <header class="header1">
        <header class ="mini-head">
        <a href="rentbazar.php"  class="ripple"><img class="logo" src="images/logo.png "> </a>
     
        <div class="search">
  <form name="searchform" method="GET" action="search.php" onsubmit="return(searcherror());">
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




                <div class="cart-button">
                <a href="cart.php">
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
                </lord-icon></button>
                <div class="dropdown-content">
                          <a href="#" onclick="signinpopup()" class="ripple"><img class="signinpng" src="images/icons/signin.png" width="48px">Sign In</a>
                          <a href="#" onclick="signuppopup()" class="ripple"><img class="signinpng" src="https://img.icons8.com/color/48/000000/add-user-male.png"/>Register</a>
                        </div>
              </div>
      
        </div>
        </header>
</header>

		                               <!-- Sign IN Form PHP -->
<?php
$error_message = "";$success_message = "";

if(isset($_POST['but_submit'])){
    $uname = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

if ($uname != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from users where email='".$uname."' and password='".$password."'";

        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            $_SESSION['status']="<script>
const Toast =Swal.mixin({
  toast: true,
  position: 'top-end',
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
titleColor: 'red',
  title: 'Welcome:-',
  text:'$uname'
})</script>";
            header('Location: index.php');
        }else{
	echo '<script type="text/javascript">signinerror();</script>';
        
}
 }  

}
?>

                                 	<!-- Sign IN Form -->

                                   <div class="signinpopup" id="signinform">
    <form method="post" name="signinform" class="form-container needs-validation" novalidate onsubmit = "return(validatesignin());">
            <div class="signinimg">      
                <img class="loginimg" src="images/login.png">
            </div>  
            <div class="signinbox">

               <div class="card signincard">        
                  <h5 class="card-header info-color white-text text-center py-4">
                    <strong><h3>Sign in</h3></strong>
                  </h5>

                  <div class="signin-cont">
                    <div class="md-form md-outline input-with-pre-icon">
                          <i class="fas fa-envelope  input-prefix"></i>
                          <input type="email" name="email"  class="form-control sign-input"  id="signemail" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" required>
                          <label for="signemail">Email Address</label>
                    </div>
                    <div class="md-form md-outline input-with-pre-icon">
                        <i class="fas fa-lock input-prefix"></i>
                        <input type="password" class="form-control sign-input" id="sigpass" name="password" minlength="6" required>
                        <label for="sigpass">Password</label>
                    </div>

                    <div class="d-flex justify-content-around ">
                          <div>
                                <!-- Remember me -->
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="materialIndeterminate2">
                            <label class="form-check-label" for="materialIndeterminate2">Remember Me</label>
                            </div>
                          </div>
                          <div>
                                <!-- Forgot password -->
                              <a href="#" onclick="forgetpass()">Forgot password?</a>
                          </div>
                    </div>

                      <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0 login-btn" data-mdb-ripple-color="success" type="submit" name="but_submit">Sign in</button>
                      <hr>
                                  <!-- Register -->
                                  <p >Not a member?
                                    <a href="#" onclick="signuppopup()">Register</a>
                                    </p>
                    </div>
                 
                </div> 
               </div>
               <div>
                <button type="button" class="cancel-signin" onclick="closesignin()">x</button></div>
                </form>
                

              
              </div>


                                <!-- Sign Up PHP -->
<?php 
$error_message = "";$success_message = "";

	
// Register user
	
if(isset($_POST['btnsignup'])){
		
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
		
$email = trim($_POST['email']);
	
$phone = trim($_POST['phone']);
		
$password = trim($_POST['password']);
		
$confirmpassword = trim($_POST['confirmpassword']);
date_default_timezone_set("Asia/Calcutta");
$insertdate = date("d-m-Y g:i:s A");
		
$isValid = true;

		
// Check fields are empty or not
		
if($fname == ''  || $email == '' || $phone == '' || $password == '' || $confirmpassword == ''){
			
$isValid = false;
			
$error_message = "Please fill all fields.";
		
}

		
// Check if confirm password matching or not
		
if($isValid && ($password != $confirmpassword) ){
			
$isValid = false;
			
echo '<script type="text/javascript">signinerror();</script>';		
}

		
// Check if Email-ID is valid or not
		
if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  	$isValid = false;
		  	
$error_message = "Invalid Email-ID.";
		
}

		
if($isValid){

			
// Check if Email-ID already exists
			
$stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
			$stmt->bind_param("s", $email);
			
$stmt->execute();
			
$result = $stmt->get_result();
			
$stmt->close();
			
if($result->num_rows > 0){
				
$isValid = false;
		
echo '<script type="text/javascript">emailexist();</script>';
}
}


///////phone////
// Check if phone number is already exists
			
$stmt = $con->prepare("SELECT * FROM users WHERE phone = ?");
			$stmt->bind_param("s", $phone);
			
$stmt->execute();
			
$result = $stmt->get_result();
			
$stmt->close();
			
if($result->num_rows > 0){
				
$isValid = false;
		
echo '<script type="text/javascript">phoneexist();</script>';
}

/////		
// Insert records
		
if($isValid){
			
$insertSQL = "INSERT INTO users(fname,lname,email,phone,password,user_ip,reg_date ) values(?,?,?,?,?,?,?)";
		$stmt = $con->prepare($insertSQL);
			
$stmt->bind_param("sssssss",$fname,$lname,$email,$phone,$password,$user_ip,$insertdate);
			$stmt->execute();
			
$stmt->close();	
if($stmt){

$_SESSION['uname'] = $email;
header('Location: index.php');
$_SESSION['status']="<script>
          Swal.fire({
            title: 'Your account has been successfully created!',
            text:'$email',
            width: 600,
            padding: '3em',
            background: '#fff url(/images/trees.png)',
            backdrop:`
              rgba(0,0,123,0.4)
              url('https://sweetalert2.github.io/images/nyan-cat.gif')
              left top
              no-repeat`
          })
</script>";
}
}
	
}
	
?>


                   		<!-- Sign UP form -->

        <div class="signuppopup" id="signupform">
        <form method="POST" action="" name="signupform" class="signup-container needs-validation" novalidate onsubmit = "return(validatesignup());" autocomplete="off">
        <div class="signupimg">      
         <img class="loginimg" src="images/login.png">
        </div>  
      
        <div class="card signup-card">
          <h5 class="card-header info-color white-text text-center py-4">
              <strong><h3>Sign up</h3></strong>
          </h5>
          <div class="card-body px-lg-5 pt-0">
                  <div class="form-row">
                  <div class="signupfname">
                      <div class="col">
                          <!-- First name -->
                          <div class="md-form md-outline input-with-pre-icon" >
                          <i class="fas fa-user input-prefix"></i>
                              <input type="text"  name="fname" id="materialRegisterFormFirstName" class="form-control signupf" pattern="[A-Za-z ]+" title="Use Letters Only" required>
                              <label for="materialRegisterFormFirstName">First name</label>
                          </div>
                      </div>
                      <div class="col">
                          <!-- Last name -->
                          <div class="md-form  md-outline input-with-pre-icon">
                          <i class="fas fa-user input-prefix"></i>
                              <input type="text"  name="lname" id="materialRegisterFormLastName" class="form-control signupl" pattern="[A-Za-z ]+" title="Use Letters Only" required>
                              <label for="materialRegisterFormLastName">Last name</label>
                          </div>
                      </div>

                  </div>
                  </div>
      
                  <!-- E-mail -->
                  <div class="md-form mt-0  md-outline input-with-pre-icon">
                      <i class="fas fa-envelope input-prefix"></i>
                      <input type="email" name="email" id="materialRegisterFormEmail" class="form-control" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" required>
                      <label for="materialRegisterFormEmail">E-mail</label>
                  </div>
      
                  <!-- Phone number -->
                  <div class="md-form  md-outline input-with-pre-icon">
                  <i class="fas fa-phone-alt input-prefix"></i>
                    <input type="text" name="phone" id="materialRegisterFormPhone" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" aria-describedby="materialRegisterFormPhoneHelpBlock" required>
                    <label for="materialRegisterFormPhone">Phone number</label>
                  </div>

                  <!-- Password -->
                  <div class="md-form  md-outline input-with-pre-icon">
                  <i class="fas fa-lock input-prefix"></i>
                      <input type="password" name="password" id="materialRegisterFormPassword" minlength="6" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" id="password" required>
                      <label for="materialRegisterFormPassword">Password</label>
                  </div>

                  <div class="md-form  md-outline input-with-pre-icon">
                  <i class="fas fa-lock input-prefix"></i>
                    <input type="password" name="confirmpassword" id="materialRegisterFormcPassword" minlength="6" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" id="cpassword" required>
                    <label for="materialRegisterFormcPassword">Confirm Password</label>
                  </div>
                  <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0 signup-btn" data-mdb-ripple-color="success" type="submit" name="btnsignup">Register</button>
      
                  <hr>
                  <p>By clicking
                      <em>Register</em> you agree to our
                      <a href="terms&condi.php">t&c</a></p>
          </div>
          </div>
          
        <div class="">
                <button type="button" class="cancel-signup" onclick="closesignup()">x</button>
        </div>
        </form>
        </div>
                        




<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">                      
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>                              
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



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

                  <form method="POST" class="needs-validation" id="sendfeed" novalidate>
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
                        <label for="mobile">Mobile</label>
                        <input type="text" class="form-control contus" name="mobile" id="mobile" pattern="[0-9]{10}" title="10 numeric characters only" required>
                        <div class="invalid-feedback valid-error">
                          Enter Mobile Number
                        </div>
                      </div>

                    
                      <div class="md-form">
                        <label for="message">Leave Your Message here </label>
                        <textarea  class="form-control md-textarea contus" name="message" id="message" length="120" rows="2" minlength="10" required></textarea>
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
                  <button class="btn btn-primary btn-sm btn-rounded feed-sumbit" id="sendfeedbtn" name="contact_us" type="submit">Submit</button>
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


                      <!-- Ajax for php form submit -->
<!-- <div id="container">
  <form method="post" action="" id="acontactform" required>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text"  id="conname" required>
    </div>
    <div class="form-group">
      <label for="email">Email Address:</label>
      <input type="email"  id="conemail" required>
    </div>
    <div class="form-group">
      <label for="message">Message:</label>
      <textarea name="message"  id="conmessage" required></textarea>
    </div>
    <button type="submit" class="const">Submit</button>
  </form>

  <div class="aresult">
  </div>
</div>           
<script>
$(document).ready(function () {
  $('.const').click(function (e) {
    e.preventDefault();
    var name = $('#conname').val();
    var email = $('#conemail').val();
    var message = $('#conmessage').val();
    if(name !='' && email !='' && message !=''){
    $.ajax
      ({
        type: "POST",
        url: "php.php",
        data: { "conname": name, "conemail": email, "conmessage": message },
        success: function (data) {
          $('.aresult').html(data);
          $('#acontactform')[0].reset();
        }
      }); 
    }
    else{alert("Enter ");}
  });
});
</script>       -->

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
