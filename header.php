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
                                                          <!-- Header 1-->
                <!-- For cart counter -->
<?php
                error_reporting (0);
include "config.php";
$user_ip = getip();
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

<?php
include "config.php";

if(isset($_POST['but_logout'])){
        session_destroy();
        header('Location:rentbazar.php');
    }

if(isset($_SESSION['status'])){
 echo $_SESSION['status'];
unset($_SESSION['status']);
}



        if(isset($_SESSION['uname']))

        {

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


<header class="header1">
                <header class ="mini-head">
                <a href="index.php" class="ripple"><img class="logo" src="images/logo.png "> </a>

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
icon: "success",
title: "Sign Out Successfully!",
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
       <?php } else { ?>

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

<?php } ?>


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
  title: 'Welcome '
})</script>";
            header('Location: index.php');
        }else{
	echo '<script type="text/javascript">signinerror();</script>';
        
}
 }  

}
?>
<?php
if(isset($_POST['ankit'])) 
{
if(!isset($_SESSION['uname'])){
        echo '<script type="text/javascript">alert("pls login")</script>';
}
else{
        header('Location:placeorder.php');
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
		
$name = trim($_POST['name']);
		
$email = trim($_POST['email']);
	
$phone = trim($_POST['phone']);
		
$password = trim($_POST['password']);
		
$confirmpassword = trim($_POST['confirmpassword']);

		
$isValid = true;

		
// Check fields are empty or not
		
if($name == ''  || $email == '' || $phone == '' || $password == '' || $confirmpassword == ''){
			
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
			
$insertSQL = "INSERT INTO users(name,email,phone,password ) values(?,?,?,?)";
		$stmt = $con->prepare($insertSQL);
			
$stmt->bind_param("ssss",$name,$email,$phone,$password);
			$stmt->execute();
			
$stmt->close();	
echo '<script type="text/javascript">accountcreate();</script>';
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
  <br>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">                      

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