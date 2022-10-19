<!-- footer section starts  -->
<section class="quick-links">

    <a href="index.php" class="logo"> <i class="fas fa-store"></i> Chu Store </a>

    <div class="links">
       <a href="index.php">  Trang chủ </a>
        <a href="about.php"> Thông tin </a>
        <a href="products.php">  Sản phẩm </a>
        <a href="contact.php"> Liên hệ </a>
<!--         <a href="login.php">  Đăng nhập </a>
        <a href="register.php"> Đăng ký </a> -->
<!--         <a href="cart.php"> Giỏ hàng </a> -->
    <?php 
      $check_cart = $ct->check_cart();
      if($check_cart==true){
        echo '<a href="cart.php">Giỏ hàng</a>';
      }else{
        echo '';
      }
    ?>
    <?php 
      $customer_id = Session::get('customer_id');
      $check_order = $ct->check_order($customer_id);
      if($check_order==true){
        echo ' <a href="orderdetails.php">Đơn đặt hàng</a>';
      }else{
        echo '';
      }
    ?>
     
    <?php 
          $login_check = Session::get('customer_login');
          if($login_check==false){
            echo '';
          }else{
            echo '<a href="profile.php">Hồ sơ</a>';
          }
    ?>
    <!--  <?php   
            $login_check = Session::get('customer_login'); 
            if($login_check){
                echo '<a href="compare.php">So sánh</a>';
            }
    ?> -->
    <?php   
            $login_check = Session::get('customer_login'); 
            if($login_check){
                echo '<a href="wishlist.php">Yêu thích</a>';
            }
    ?>
    </div>

    <div class="share">
        <a href="https://www.facebook.com/manh.chu.18041" class="fab fa-facebook-f" target="_blank"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
    </div>

</section>


<!-- footer section ends -->




<!-- swiper js link      -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>