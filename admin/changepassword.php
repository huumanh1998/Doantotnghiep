<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
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
<!-- update pass  -->
<?php
   if(isset($_POST['doimatkhau'])){
      $taikhoan = $_POST['adminUser'];
      $matkhau_cu = md5($_POST['password_cu']);
      $matkhau_moi = md5($_POST['password_moi']);
      $sql = "SELECT * FROM tbl_admin WHERE adminUser='".$taikhoan."' AND adminPass='".$matkhau_cu."' LIMIT 1";
      $row = mysqli_query($mysqli,$sql);
      $count = mysqli_num_rows($row);
      if($count>0 ){
         $sql_update = mysqli_query($mysqli,"UPDATE tbl_admin SET adminPass='".$matkhau_moi."'");
         echo'<span class="success">Đổi mật khẩu thành công.</span>';
      }else{
         echo '<span class="error">Tài khoản hoặc mật khẩu không đúng.</span>';
      }
   }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Đổi mật khẩu</h2>
        <div class="block">               
         <form action="" method="POST">
            <table class="form">
                <tr>
                    <td>
                        <label>Admin</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Nhập Admin User..."  name="adminUser" class="medium" />
                    </td>
                </tr>					
                <tr>
                    <td>
                        <label>Mật khẩu cũ</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu cũ..."  name="password_cu" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Mật khẩu mới</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu mới..." name="password_moi" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="doimatkhau" Value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>