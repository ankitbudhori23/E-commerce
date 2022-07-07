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
                
<?php
ob_start();
include "header.php"; 
include "config.php";
error_reporting(0);

?>    



                                <!-- header 2-->
                        
        <header class="header2">
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
         

         <div class="shop-page">
                <?php
                        $searchitems = $_GET['searchproducts'];
                ?>


                <?php echo $status; ?>


                <?php
                if(!empty($_SESSION["shopping_cart"])){
                $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                ?>
                <?php
                }
                $result = mysqli_query($con,"SELECT * FROM products WHERE name LIKE '%$searchitems%'");

                if ($result->num_rows > 0) 
                {

                while($row = mysqli_fetch_assoc($result)){
                echo "<div class='product_wrapper'>
                <form method='post' action=''>
                <input type='hidden' name='code' value=".$row['code']." />
                <div class='card'><img class='product-img' src=".$row['image'].">
                <div class='name'>".$row['name']."</div>
                <div class='price'>Rs ".$row['price']." /Month</div>

                <div class='buy-button'>
                <a href=product-details.php?product=".$row['code'].">
                <button type='button' class='btn btn-primary card-button'>View Details</button>
                </a>
                <button type='submit' class='btn btn-primary card-button'>Add to Cart</button>
                </div></div>
                </form>
                </div>";
                }
                } else {
                        echo "<div class='cartcont'><center>
                <img class='no-product' src='images/no_product.png'>
                <h1 class='h1no'>SORRY! WE COULDN'T FIND YOUR PRODUCT</h1></center></div>";
                }
                mysqli_close($con);
                ?>

                <div style="clear:both;"></div>
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