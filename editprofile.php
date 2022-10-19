<?php
   include 'inc/header.php';
?>

<?php
    
    $login_check = Session::get('customer_login'); 
    if($login_check==false){
        header('Location:login.php');
    }
        
?>
<?php

    // if(!isset($_GET['proid']) || $_GET['proid']==NULL){
 //       echo "<script>window.location ='404.php'</script>";
 //    }else{
 //        $id = $_GET['proid']; 
 //    }
    $id = Session::get('customer_id');
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
       
        $UpdateCustomers = $cs->update_customers1($_POST,$_FILES, $id);
        
    }

?>
<!-- about section starts  -->

<section class="about">

    <div class="image">
        <img src="images/profile.png" alt="">
    </div>

    <div class="content">
        <h3>Cập nhật thông tin người dùng</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tblone">
                <tr>
                    
                        <?php
                        if(isset($UpdateCustomers)){
                            echo '<td colspan="3">'.$UpdateCustomers.'</td>';
                        }
                        ?>
                    
                </tr>
                <?php
                $id = Session::get('customer_id');
                $get_customers = $cs->show_customers($id);
                if($get_customers){
                    while($result = $get_customers->fetch_assoc()){

                ?>
                <tr style ="padding: 0px 10px;">
                    <td>Tên</td>
                    <td>:</td>
                    <td><input style="border: 1px solid;"type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                </tr>
                <tr>
                    <td>Thành phố</td>
                    <td>:</td>
                    <td><input style="border: 1px solid;" type="text" name="city" value="<?php echo $result['city'] ?>"></td>
                    
                </tr>
                <tr>
                    <td>SĐT</td>
                    <td>:</td>
                    <td><input style="border: 1px solid;" type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                
                </tr>
                <!-- <tr>
                    <td>Quốc gia</td>
                    <td>:</td>
                    <td><?php echo $result['country'] ?></td>
                </tr> -->
                <!-- <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
                    
                </tr> -->
                <!-- <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                    
                </tr> -->
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><input style="border: 1px solid;" type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                </tr>
                 <tr>
                    <td>Chọn ảnh</td>
                    <td>:</td>
                    <td><input type="file" name="image" /></td>
                </tr>
                <tr>
                    <td>Hình ảnh</td>
                    <td>:</td>
                    <td>
                        <img src="admin/uploads/<?php echo $result['avatar'] ?>" width="90">
                    </td>   
                </tr>
                <tr>
                    <td colspan="3"><input class="btn" type="submit" name="save" value="Cập nhật" style="text-transform: none;"></td>
                    
                </tr>
               <!--  <tr>
                     <td><a href="updatepass.php" class="btn" style="text-transform: none;" >Cập nhật mật khẩu</a></td>
                    
                </tr> -->
               
                <style type="text/css">
                    h3{
                        padding-bottom: 20px;
                    }
                    td{
                        font-size: 16px;
                        padding-bottom: 10px;
                    }
                    input{
                        font-size: 16px;

                    }
                </style>
                <?php
                    }
                }
                ?>
            </table>
            </form>
    </div>

</section>

<!-- about section ends -->




<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>