<?php
   include 'inc/header.php';
?>
<?php
    if (isset($_POST['contact_submit'])){
        $contact_insert =$cs->insert_contact();
    }

?>
<!-- contact info section starts  -->

<section class="info-container">

    <div class="box-container">

        <div class="box">
            <i class="fas fa-map"></i>
            <h3>Địa chỉ</h3>
            <p>233 Phạm Văn Đồng, Tổ 3 Phường Lê Lợi, Thành phố Kon Tum</p>
        </div>

        <div class="box">
            <i class="fas fa-envelope"></i>
            <h3>email</h3>
            <p style="text-transform: none;">huumanh.edu@gmail.com</p>
            <p style="text-transform: none;">chmanh98@gmail.com</p>
        </div>

        <div class="box">
            <i class="fas fa-phone"></i>
            <h3>Số điện thoại</h3>
            <p>+8433 658 6565</p>
            <p>+8439 705 2760</p>
        </div>

    </div>

</section>

<!-- contact info section ends -->

<!-- contact section starts  -->

<section class="contact">
 
    
    <form action="" method="POST">
        
        <h3>Liên hệ</h3>
        <p style="text-transform: none;">Mọi thắc mắc của khách hàng sẽ được giải đáp sớm nhất.</p>
        <?php
            if(isset($contact_insert)){
                echo $contact_insert;
            } 
        ?>
        
        <div class="inputBox">
            <input type="hidden" value="" name="contact_id">
            <input type="text" placeholder="Nhập tên" class="form-control" name="contact_name">
            <input type="email" placeholder="Nhập email" class="form-control" name="contact_email">
            <input type="text" placeholder="Nhập số điện thoại"class="form-control" name="contact_phone">
            <input type="text" placeholder="Tiêu đề" class="form-control" name="contact_title">
        </div>
      
        <textarea name="contact_desc" placeholder="Lời nhắn" id="" cols="30" rows="10"></textarea>
        <input type="submit" name="contact_submit"value="Gửi" class="btn">
    </form>

    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.668417698156!2d107.991246014786!3d14.330683089974855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x316bff7dca5dce35%3A0x1ecd59f727b26f3a!2zMjMzIFBo4bqhbSBWxINuIMSQ4buTbmcsIE5ndXnhu4VuIFRyw6NpLCBLb24gVHVtLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1646060585477!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

</section>

<!-- contact section ends -->



<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>