<?php
   include 'inc/header.php';
?>

<?php

    if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
       $customer_id = Session::get('customer_id');
       $insertOrder = $ct->insertOrder($customer_id);
       $delCart = $ct->del_all_data_cart();
       header('Location:success.php');
    }
    

 
?>
<!-- about section starts  -->

<section class="about" style="height: 80vh;">

    <div class="content" style="border: 1px solid #000;margin-right: 10px;">
        <h3 style="padding-bottom: 10px;">Thanh toán trực tiếp</h3>
        <?php
                     if(isset($update_quantity_cart)){
                        echo $update_quantity_cart;
                     }
                    ?>
                    <?php
                     if(isset($delcart)){
                        echo $delcart;
                     }
                    ?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Tên sản phẩm</th>
                                
                                <th width="15%">Tạm tính</th>
                                <th width="25%">Số lượng</th>
                                <th width="20%">Tổng tiền</th>
                                
                            </tr>
                            <?php
                            $get_product_cart = $ct->get_product_cart();
                            if($get_product_cart){
                                $subtotal = 0;
                                $qty = 0;
                                $i = 0;
                                while($result = $get_product_cart->fetch_assoc()){
                                    $i++;
                            ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $i; ?></td>
                                <td style="text-align:center;"><?php echo $result['productName'] ?></td>
                                
                                <td style="text-align:center;"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></td>
                                <td style="text-align:center;">

                                    <?php echo $result['quantity'] ?>

                                </td>
                                <td style="text-align:center;"><?php
                                $total = $result['price'] * $result['quantity'];
                                echo $fm->format_currency($total).' '.'VNĐ' ;
                                 ?></td>
                                
                            </tr>
                        <?php
                            $subtotal += $total;
                            $qty = $qty + $result['quantity'];
                            }
                        }
                        ?>
                            
                        </table>
                        <?php
                            $check_cart = $ct->check_cart();
                                if($check_cart){
                                ?>
                        <table style="float:right;text-align:left;margin:5px" width="40%">
                            <tr>
                                <th>Tạm tính: </th>
                                <td><?php 

                                    echo $fm->format_currency($subtotal).' '.'VNĐ' ;
                                    Session::set('sum',$subtotal);
                                    Session::set('qty',$qty);
                                ?></td>
                            </tr>
                            <tr>
                                <th>VAT: </th>
                                <td>5% (<?php echo $fm->format_currency($vat = $subtotal * 0.05).' '.'VNĐ'; ?>)</td>
                            </tr>
                            <tr>
                                <th>Tổng tiền:</th>
                                <td><?php 

                                $vat = $subtotal * 0.05;
                                $gtotal = $subtotal + $vat;
                                echo $fm->format_currency($gtotal).' '.'VNĐ' ;
                                ?></td>
                            </tr>

                       </table>
                      <?php
  
                    }else{
                        echo 'Giỏ của bạn trống! Hãy mua sắm ngay bây giờ';
                    }
                      ?>
                    <style type="text/css">
                        table, th, td{
                            border:1px solid #868585;
                            font-size: 16px;
                            text-transform: none;
                            padding: 5px;
                        }
                        table{
                            border-collapse:collapse;
                            margin: 5px;
                        }
                        table tr:nth-child(odd){
                            background-color:#eee;
                        }
                        table tr:nth-child(even){
                            background-color:white;
                        }
                        table tr:nth-child(1){
                            background-color:skyblue;
                        }
                    </style>
    </div>
    <div class="content" style="border: 1px solid #000; margin-left: 10px;">
        <h3>Thông tin người dùng</h3>
        <table class="tblone">
                <?php
                $id = Session::get('customer_id');
                $get_customers = $cs->show_customers($id);
                if($get_customers){
                    while($result = $get_customers->fetch_assoc()){

                ?>
                <tr>
                    <td>Tên</td>
                    <td>:</td>
                    <td><?php echo $result['name'] ?></td>
                </tr>
                <tr>
                    <td>Thành phố</td>
                    <td>:</td>
                    <td><?php echo $result['city'] ?></td>
                </tr>
                <tr>
                    <td>SĐT</td>
                    <td>:</td>
                    <td><?php echo $result['phone'] ?></td>
                </tr>
                <!-- <tr>
                    <td>Quốc gia</td>
                    <td>:</td>
                    <td><?php echo $result['country'] ?></td>
                </tr> -->
                <!-- <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode'] ?></td>
                </tr> -->
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email'] ?></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><?php echo $result['address'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php" class="btn">Cập nhật thông tin</a></td>
                    
                </tr>
                
                <?php
                    }
                }
                ?>
            </table>
    </div>

</section>

<!-- about section ends -->
<center><a href="?orderid=order" class="btn" style="margin-bottom: 20px;" >Đặt hàng ngay</a></center>



<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>