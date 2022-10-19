<?php
   include 'inc/header.php';
?>
<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "doantotnghiep";

$mysqli = mysqli_connect($server, $user, $pass, $database);

if (!$mysqli) {
    die("<script>alert('Connection Failed.')</script>");
}

?>
<!-- register form section starts  -->
<?php
   if(isset($_POST['doimatkhau'])){
      $taikhoan = $_POST['email'];
      $matkhau_cu = md5($_POST['password_cu']);
      $matkhau_moi = md5($_POST['password_moi']);
      $nhaplaimatkhau = md5($_POST['nhaplaimatkhau']);
      $sql = "SELECT * FROM tbl_customer WHERE email='".$taikhoan."' AND password='".$matkhau_cu."' LIMIT 1";
      $row = mysqli_query($mysqli,$sql);
      $count = mysqli_num_rows($row);
      if($count>0 and $matkhau_moi == $nhaplaimatkhau){
         $sql_update = mysqli_query($mysqli,"UPDATE tbl_customer SET password='".$matkhau_moi."'");
         echo'<section class="register2"><form><p>Đổi mật khẩu thành công.</p></form></section>';
      }else{
         echo '<section class="register1"><form><p>Tài khoản hoặc mật khẩu không đúng.</p></form></section>';
      }
   }
?>
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
      <h3 >Đổi mật khẩu</h3>
        <input type="text"  placeholder="Nhập tài khoản Email" id="" class="box" name="email" value="" required>
        <input type="password" placeholder="Nhập mật khẩu cũ" id="" class="box" name="password_cu" value="" required>
        <input type="password" placeholder="Nhập mật khẩu mới" id="" class="box" name="password_moi" value="" required>
        <input type="password" placeholder="Nhập lại mật khẩu mới" id="" class="box" name="nhaplaimatkhau" value="" required>
        <input type="submit" name="doimatkhau" value="Đổi mật khẩu" class="btn">

    </form>

</section>

<!-- register form section ends  -->


<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>
