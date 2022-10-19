<?php
   include 'inc/header.php';
?>

<?php
    
    $login_check = Session::get('customer_login'); 
    if($login_check==false){
        header('Location:login.php');
    }
        
?>
<!-- about section starts  -->

<section class="about">
    <div class="image">
        <img src="images/profile.png" alt="">
    </div>
    <div class="content">
        <h3>Thông tin người dùng</h3>
        <?php
                $id = Session::get('customer_id');
                $get_customers = $cs->show_customers($id);
                if($get_customers){
                    while($result = $get_customers->fetch_assoc()){

        ?>
        <p style="text-transform: none;"><span style="font-weight: bold;">Tên:</span> <?php echo $result['name'] ?></p>
        <p style="text-transform: none;"><span style="font-weight: bold;">Thành phố:</span> <?php echo $result['city'] ?></p>
        <p style="text-transform: none;"><span style="font-weight: bold;">Số điện thoại:</span> <?php echo $result['phone'] ?></p>
        <!-- <p style="text-transform: none;"><span>TP:</span> <?php echo $result['country'] ?></p> -->
        <!-- <p style="text-transform: none;"><span>Zip code:</span> <?php echo $result['zipcode'] ?></p> -->
        <p style="text-transform: none;"><span style="font-weight: bold;">Email:</span> <?php echo $result['email'] ?></p>
        <p style="text-transform: none;"><span style="font-weight: bold;">Địa chỉ:</span> <?php echo $result['address'] ?></p>
        <p style="text-transform: none;"><span style="font-weight: bold;">Hình ảnh:</span> <img src="admin/uploads/<?php echo $result['avatar'] ?>" style="width: 150;height: 150px;"></p>
        <a href="editprofile.php" class="btn" style="text-transform: none;" >Cập nhật thông tin</a>
        <?php
                    }
                }
        ?>
    </div>

</section>

<!-- about section ends -->




<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>