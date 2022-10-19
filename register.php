<?php
   include 'inc/header.php';
?>
<?php 

include 'config/config1.php';

error_reporting(0);

session_start();

if (isset($_SESSION['name'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $password = md5($_POST['password']);
   $cpassword = md5($_POST['cpassword']);

   if ($password == $cpassword) {
      $sql = "SELECT * FROM tbl_customer WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      if (!$result->num_rows > 0) {
         $sql = "INSERT INTO tbl_customer (name, phone, email, password)
               VALUES ('$name', '$phone', '$email', '$password')";
         $result = mysqli_query($conn, $sql);
         if ($result) {
            echo "<section class='register2'><form><p>Đăng ký tài khoản thành công.</p></form></section>";
            $name = "";
            $phone = "";
            $email = "";
            $_POST['password'] = "";
            $_POST['cpassword'] = "";
         } else {
            echo "<section class='register1'><form><p>Rất tiếc! Đã xảy ra lỗi.</p></form></section>";
         }
      } else {
         echo "<section class='register1'><form><p>Rất tiếc! Email đã tồn tại.</p></form></section>";
      }
      
   } else {
      echo "<section class='register1'><form><p>Mật khẩu không khớp.</p></form></section>";
   }
}

?>
<!-- register form section starts  -->
<style type="text/css">
        .register2 form,
         .login form {
           max-width: 40rem;
           border-radius: .5rem;
           padding: 0.5rem;
           background: #fff;
           -webkit-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
                   box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
           border: 0.2rem solid #333;
           margin: 1rem auto;
         }

         .register2 form h3,
         .login form h3 {
           font-size: 0.5rem;
           padding-bottom: 1rem;
           color: #333;
           text-transform: uppercase;
         }

         .register2 form .box,
         .login form .box {
           width: 100%;
           padding: 1.2rem 1.4rem;
           border-radius: .5rem;
           border: 0.2rem solid #333;
           font-size: 1.6rem;
           color: #666;
           text-transform: none;
           margin: .7rem 0;
         }

         .register2 form .remember,
         .login form .remember {
           display: -webkit-box;
           display: -ms-flexbox;
           display: flex;
           -webkit-box-align: center;
               -ms-flex-align: center;
                   align-items: center;
           gap: .5rem;
           padding-top: 1.5rem;
           padding-bottom: 1rem;
         }

         .register2 form .remember label,
         .login form .remember label {
           font-size: 1.5rem;
           color: #666;
           cursor: pointer;
         }

         .register2 form .btn,
         .login form .btn {
           width: 100%;
           text-align: center;
         }

         .register2 form .btn.link,
         .login form .btn.link {
           background: #333;
         }

         .register2 form .btn.link:hover,
         .login form .btn.link:hover {
           background: #0984e3;
         }

         .register2 form p,
         .login form p {
           padding-top: 0.5rem;
           font-size: 1.5rem;
           color: green;
           text-transform: none;
           text-align: center;
           padding-bottom: 1rem;
         }
         /*register*/
         .register1 form,
         .login form {
           max-width: 40rem;
           border-radius: .5rem;
           padding: 0.5rem;
           background: #fff;
           -webkit-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
                   box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
           border: 0.2rem solid #333;
           margin: 1rem auto;
         }

         .register1 form h3,
         .login form h3 {
           font-size: 2.5rem;
           padding-bottom: 1rem;
           color: #333;
           text-transform: uppercase;
         }

         .register1 form .box,
         .login form .box {
           width: 100%;
           padding: 1.2rem 1.4rem;
           border-radius: .5rem;
           border: 0.2rem solid #333;
           font-size: 1.6rem;
           color: #666;
           text-transform: none;
           margin: .7rem 0;
         }

         .register1 form .remember,
         .login form .remember {
           display: -webkit-box;
           display: -ms-flexbox;
           display: flex;
           -webkit-box-align: center;
               -ms-flex-align: center;
                   align-items: center;
           gap: .5rem;
           padding-top: 1.5rem;
           padding-bottom: 1rem;
         }

         .register1 form .remember label,
         .login form .remember label {
           font-size: 1.5rem;
           color: #666;
           cursor: pointer;
         }

         .register1 form .btn,
         .login form .btn {
           width: 100%;
           text-align: center;
         }

         .register1 form .btn.link,
         .login form .btn.link {
           background: #333;
         }

         .register1 form .btn.link:hover,
         .login form .btn.link:hover {
           background: #0984e3;
         }

         .register1 form p,
         .login form p {
           padding-top: 1.5rem;
           font-size: 1.5rem;
           color: red;
           text-align: center;
           text-transform: none;
           padding-bottom: 1rem;
         }
</style>
<section class="register">

    <form action="" method="POST">
        <h3 >Đăng ký ngay</h3>
        <input type="text" placeholder="Nhập tên" id="" class="box" name="name" value="<?php echo $name; ?>"required>
        <input type="text" placeholder="Nhập số điện thoại" id="" class="box" name="phone" value="<?php echo $phone; ?>"required>
        <input type="email"  placeholder="Địa chỉ email" id="" class="box" name="email" value="<?php echo $email; ?>" required>
        <input type="password" placeholder="Nhập mật khẩu" id="" class="box" name="password" value="<?php echo $_POST['password']; ?>" required>
        <input type="password" placeholder="Nhập lại mật khẩu" id="" class="box" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
        <button name="submit" class="btn">Đăng ký</button>
        <p style="text-transform: none;">Bạn đã có tài khoản chưa?</p>
        <a style="text-transform: none;" href="login.php" class="btn link">Đăng nhập ngay</a>
    </form>

</section>


<!-- register form section ends  -->


<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>
