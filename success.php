<?php
   include 'inc/header.php';
?>

<!-- contact info section starts  -->

<section class="info-container">

    <div class="box-container">

        <div class="box">
            <i class="fas fa-check"></i>
            <h3 style="text-transform: none;color:red;text-align: center;margin: auto;padding-top:50px ;height: 25vh;font-size: 25px;">Đặt hàng thành công</h3>
        </div>

        <!-- <div class="box">
        <?php
             $customer_id = Session::get('customer_id');
             $get_amount = $ct->getAmountPrice($customer_id);
             if($get_amount){
                $amount = 0;
                while($result = $get_amount->fetch_assoc()){
                    $price = $result['price'];
                    $amount += $price; 

                }
             }
            ?>
            <i class="fas fa-money-bill"></i>
            <h3 style="text-transform: none;text-align: center;margin: auto;padding-top:50px ;height: 25vh;font-size: 25px;">Tổng tiền đơn hàng bạn đã đặt mua : <?php

            $vat = $amount * 0.05;
            $total = $vat + $amount;
            echo $fm->format_currency($total). ' VNĐ';


            ?></h3>
            
        </div> -->

        <div class="box">
            <i class="fas fa-shopping-cart"></i>
            <h3 style="text-transform: none;text-align: center;margin: auto;padding-top:50px ;height: 25vh;font-size: 25px;">Chúng tôi sẽ liên hệ bạn sớm, xem chi tiết đơn hàng của bạn tại đây <a style="text-transform:none;" href="orderdetails.php">Bấm vào đây</a></h3>
        </div>

    </div>

</section>



<?php
   include 'inc/footer.php';
?>