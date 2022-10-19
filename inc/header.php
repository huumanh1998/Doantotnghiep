<?php
    include 'lib/session.php';
    Session::init();
?>
<?php 
    include_once ('lib/database.php');
    include_once ('helpers/format.php');

    spl_autoload_register(function($class){
        include_once "classes/".$class.".php";
    });

    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $us = new user();
    $cat = new category();
    $cs = new customer();
    $product = new product();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chu Store</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- cusom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<!-- header section starts  -->

<header class="header">

    <a href="index.php" class="logo"> <i class="fas fa-store"></i> Chu Store </a>

    <form action="search.php" class="search-form" method="post">
        <input type="text" id="search-box" placeholder="Tìm kiếm sản phẩm..." name="tukhoa">
      <!--    <input type="submit" name="search_product" value=""> -->
      <button style="background: white;" type="submit" name="search_product"><label for="search-box" class="fas fa-search" type="submit" name="search_product" ></label></button>

                       
    </form>

    <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div id="search-btn" class="fas fa-search"></div>
        <a href="login.php" class="fas fa-user"></a>
        <a href="wishlist.php" class="fas fa-heart"></a>
        <a href="cart.php" class="fas fa-shopping-cart"></a>
    </div>

</header>

<!-- header section ends -->

<!-- side-bar section starts -->

<div class="side-bar">
    <div id="close-side-bar" class="fas fa-times"></div>

    <div class="user">
         <?php
                $id = Session::get('customer_id');
                $get_customers = $cs->show_customers($id);
                if($get_customers){
                    while($result = $get_customers->fetch_assoc()){

        ?>
        <img src="admin/uploads/<?php echo $result['avatar'] ?>">
       
        <h3><?php echo $result['name'] ?></h3>
        <?php
                    }
                }
        ?>
        <?php 
            if(isset($_GET['customer_id'])){
                $customer_id = $GET['customer_id'];
                // $delCart = $ct->del_all_data_cart();
                // $delCompare = $ct->del_compare($customer_id);
                Session::destroy();
            }
        ?>
        <?php 
            $login_check = Session::get('customer_login');
            if($login_check==false){
                echo '<br><a href="login.php">Đăng nhập</a>';
            }else{
                echo '<a href="?customer_id='.Session::get('customer_id').'">Đăng xuất</a>';
            }
        ?>
        
    </div>

    <nav class="navbar">
        <a href="index.php"> <i class="fas fa-angle-right"></i>Trang chủ </a>
       <!--  <a href="profile.php"> <i class="fas fa-angle-right"></i> Thông tin người dùng</a> -->
        <a href="products.php"> <i class="fas fa-angle-right"></i>Sản phẩm </a>
        
     <!--    <a href="login.php"> <i class="fas fa-angle-right"></i> Đăng nhập </a>
        <a href="register.php"> <i class="fas fa-angle-right"></i> Đăng ký </a> -->
       <!--  <a href="cart.php"> <i class="fas fa-angle-right"></i> Giỏ hàng </a> -->
    <?php 
          $login_check = Session::get('customer_login');
          if($login_check==true){
            echo '';
          }else{
            echo '<a href="login.php"><i class="fas fa-angle-right"></i>Đăng nhập</a>';
          }
    ?>
    <?php 
          $login_check = Session::get('customer_login');
          if($login_check==true){
            echo '';
          }else{
            echo '<a href="register.php"><i class="fas fa-angle-right"></i>Đăng ký</a>';
          }
    ?>
     <?php 
          $login_check = Session::get('customer_login');
          if($login_check==true){
            echo '';
          }else{
            echo '<a href="updatepass.php"><i class="fas fa-angle-right"></i>Đổi mật khẩu</a>';
          }
    ?>
     <?php 
          $login_check = Session::get('customer_login');
          if($login_check==false){
            echo '';
          }else{
            echo '<a href="profile.php"><i class="fas fa-angle-right"></i>Hồ sơ</a>';
          }
    ?>
    <?php 
      $check_cart = $ct->check_cart();
      if($check_cart==true){
        echo '<a href="cart.php"><i class="fas fa-angle-right"></i>Giỏ hàng</a>';
      }else{
        echo '';
      }
    ?>
    <?php 
      $customer_id = Session::get('customer_id');
      $check_order = $ct->check_order($customer_id);
      if($check_order==true){
        echo ' <a href="orderdetails.php"><i class="fas fa-angle-right"></i>Đơn đặt hàng</a>';
      }else{
        echo '';
      }
    ?>
     
   
    <!--  <?php   
            $login_check = Session::get('customer_login'); 
            if($login_check){
                echo '<a href="compare.php"><i class="fas fa-angle-right"></i>So sánh</a>';
            }
    ?> -->
    <?php   
            $login_check = Session::get('customer_login'); 
            if($login_check){
                echo '<a href="wishlist.php"><i class="fas fa-angle-right"></i>Yêu thích</a>';
            }
    ?>
    <a href="contact.php"> <i class="fas fa-angle-right"></i>Liên hệ </a>
    </nav>

</div>

<!-- side-bar section ends -->