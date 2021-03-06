<?php


if(session_id() == '' || !isset($_SESSION)){session_start();}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>G-Shock</title>
    <link rel="stylesheet" href="css/foundation.css" />
    
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans);

body{
  background: #f2f2f2;
  font-family: 'Open Sans', sans-serif;
}

.search {
  width: 100%;
  position: relative;
  display: flex;
}

.searchTerm {
  width: 100%;
  border: 3px solid #00B4CC;
  border-right: none;
  padding: 5px;
  height: 20px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #000000;
}

.searchButton {
  width: 40px;
  height: 36px;
  border: 1px solid #00B4CC;
  background: #00B4CC;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}

/*Resize the wrap to see the search bar change!*/
.wrap{
  width: 30%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

  </style>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">G-Shock</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>
 <form method="GET" action="search.php">
<div class="wrap">
   <div class="search">
      <input type="text" class="searchTerm" name="search" placeholder="What series are you looking for?">
      <button type="submit" class="searchButton">
        <i class="fa fa-search"></i>
     </button>
   </div>
</div>
     </form>
      <section class="top-bar-section">
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php

          if(isset($_SESSION['username'])){
            echo '<li><a href="account.php">My Account</a></li>';
            echo '<li><a href="logout.php">Log Out</a></li>';
          }
          else{
            echo '<li><a href="login.php">Log In</a></li>';
            echo '<li><a href="register.php">Register</a></li>';
          }
          ?>
        </ul>
      </section>
    </nav>




    <img data-interchange="[images/g-retina.jpg, (retina)], [images/g-landscape.jpg, (large)], [images/g-mobile.jpg, (mobile)], [images/g-landscape.jpg, (medium)]">
    <noscript><img src="images/g-landscape.jpg"></noscript>









<center><h1>Our  Products</h1>
<h4>Click on the Product For More Info</h4>

    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        
        <?php
        include 'config.php';
        $i=0;
        $product_id = array();
        $product_quantity = array();
        
        $result = $mysqli->query('SELECT * FROM products');
        if($result === FALSE){
          die(mysql_error());
        }
        
        if($result){
          
          while($obj = $result->fetch_object()) {
            
            echo '<div class="large-4 columns">';
            echo '<p><h3>'.$obj->product_name.'</h3></p>';
            $a="'info.php?info=".$obj->product_name."'";
            echo '<img width="250" height="300" onclick="location.href ='.$a.'" src="images/products/'.$obj->product_img_name.'"/>';
            echo '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
            echo '<p><strong>Description</strong>: '.$obj->product_desc.'</p>';
            echo '<p><strong>Units Available</strong>: '.$obj->qty.'</p>';
            echo '<p><strong>Price (Per Unit)</strong>: '.$currency.$obj->price.'</p>';
            
            
            
            if($obj->qty > 0){
                echo '<p><a href="update-cart.php?action=add&id='.$obj->id.'"><input type="submit" value="Add To Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a></p>';
              }
              else {
                echo 'Out Of Stock!';
              }
              echo '</div>';
              
              $i++;
            }
            
          }
          
          $_SESSION['product_id'] = $product_id;
          
          
          echo '</div>';
          echo '</div>';
          ?>


    
          <div class="row" style="margin-top:10px;">
            <div class="small-12">
      
              <footer style="margin-top:10px;">
                 <p style="text-align:center; font-size:0.8em;">&copy; G-Shock. All Rights Reserved.</p>
              </footer>
      
            </div>
          </div>
      


    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
<?php
include 'footer.php';
?>
