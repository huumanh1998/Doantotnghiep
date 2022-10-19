<?php
   include 'inc/header.php';
?>

<?php
            $login_check = Session::get('customer_login');
            if($login_check){
                header('Location:profile.php');
            }       
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
       
       
        $insertCustomers = $cs->insert_customers($_POST);
        
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
       
       
        $login_Customers = $cs->login_customers($_POST);
        
    }
?>

<!-- login form section starts  -->

<section class="login" style="height: 80vh;">

    <form action="" method="POST">
        <h3 >Đăng nhập ngay</h3>
        <?php
            if(isset($login_Customers)){
                echo $login_Customers;
            }
        ?>
        <input type="email" name="email" placeholder="Nhập địa chỉ email" id="" class="box">
        <input type="password" name="password" placeholder="Nhập mật khẩu" id="" class="box">
        <div class="remember">
            <input type="checkbox" name="" id="remember-me">
            <label for="remember-me" style="text-transform: none;"> Lưu mật khẩu</label>
        </div>
        <input style="text-transform: none;" type="submit" name="login" value="Đăng nhập ngay" class="btn">
        <p style="text-transform: none;">Chưa có tài khoản?</p>
        <a style="text-transform: none;" href="register.php" class="btn link">Đăng ký ngay</a>
    </form>


</section>

<!-- login form section ends  -->

<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>
