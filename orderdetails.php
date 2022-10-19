<?php
   include 'inc/header.php';
   require('mail/sendmail.php');
?>

<?php include_once 'classes/customer.php';
?>
<?php
    $login_check = Session::get('customer_login'); 
    if($login_check==false){
        header('Location:login.php');
    }
       
?> 
<?php
    if(isset($_GET['confirmid'])){
        $id = $_GET['confirmid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $shifted_confirm = $ct->shifted_confirm($id,$time,$price);
    }
?>

<?php
    $cs = new customer();
     if(isset($_GET['delid'])){
         $id = $_GET['delid']; 
         $delorder = $cs->del_order($id);
    }

?>

<!-- shopping cart section starts  -->

<section class="shopping-cart">
    
    <h1 class="heading"><span style="text-transform: none;">Thông tin chi tiết đơn đặt hàng</span></h1>
    
    <?= isset($delorder) ? $delorder : "" ?>
    <div class="box-container">
        <?php
            $customer_id = Session::get('customer_id');
            $get_cart_ordered = $ct->get_cart_ordered($customer_id);
            if($get_cart_ordered){
                $i = 0;
                $qty = 0;
                $total = 0;
                while($result = $get_cart_ordered->fetch_assoc()){
                        $i++;
                        $total = $result['price']*$result['quantity'];
        ?>
              
        <div class="box">
             <h1><?php echo $i; ?></h1> 
            <img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/>
            <div class="content">
               
                <div class="od"><span >Tên sản phẩm:</span> <?php echo $result['productName'] ?></div>
                <div class="od"><span>Đơn giá:</span> <?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></div>
                <div class="od"><p><span>Số lượng:</span> <?php echo $result['quantity'] ?></p> 
                <div class="od"><span>Tổng giá:</span>
                        <?php
                            $total = $result['price'] * $result['quantity'];
                                echo $fm->format_currency($total)." "."VNĐ";
                        ?>
                </div>
                <div class="od"><span>Tổng tiền:</span>
                        <?php
                            $total =  $result['price'] * $result['quantity'] + $result['price'] * $result['quantity']*0.05;
                                echo $fm->format_currency($total)." "."VNĐ";
                        ?>
                </div>
                
                </div>
                <div class="od"><p><span>Ngày đặt:</span> <?php echo $fm->formatDate($result['date_order']) ?></p>
                        
                </div>
            <!-- <div class="od"><p><span>Hoạt động:</span>
                                <td>
                                    <?php
                                    if($result['status']=='0'){
                                        echo 'Chưa nhận hàng';
                                    }elseif($result['status']==1){ 
                                    ?>
                                    <span>Chưa nhận hàng</span>
                                    
                                    <?php
                                    }elseif($result['status']==2){
                                        echo 'Đã nhận hàng';
                                    }

                                ?></td></p>

            </div> -->
            <div class="od"><p><span>Trạng thái:</span> 
                                <?php
                                if($result['status']=='0'){
                                ?>
                                <td><?php echo '<span style="color:red">Đơn hàng chưa duyệt</span>';?></td>
                                <?php
                                
                                }elseif($result['status']=='1'){
                                
                                ?>
                                <td><a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>"><span>Xác nhận đặt hàng</span></a></td>
                                <?php
                            }else{
                                ?>
                                <td><?php echo '<span style="color:green">Đơn hàng đã duyệt</span>'; ?></td>
                                <?php
                                }   
                                ?></p> 
                </div>
                <div class="od"><p><span>Thanh toán:</span> <?php 
                            if($result['payment']==0){
                            ?>

                                Chưa thanh toán

                                <?php
                            }elseif($result['payment']==1){
                                ?>
                                <?php
                                echo 'Thanh toán trực tiếp';
                                ?>
                            <?php
                            }elseif($result['payment']==2){
                            ?>

                                Đã thanh toán

                            <?php
                                }
                            
                            ?></p>
                    
                    <?php if ($result['status'] == 0 && $result['payment'] == 1): ?>
                        <div class="od"><p><a onclick = "return confirm('Bạn có muốn hủy?')" href="?delid=<?php echo $result['id'] ?>"><b style="color: blue;">Hủy</b></a></p></div>
                    <?php endif; ?>
                </div>
            </div>
           
        </div>

         <?php
                            
                            }
                        }
                        ?>
                            
        <style type="text/css">
                        .od {
                            font-size: 16px;                 
                            padding: 2px 0px;

                        }
                        .od span{
                            font-weight: bold;
                        }
                        span.error
                        {
                            margin: 8px 0 0 0;
                            padding: 0;
                            height: 1%;
                            
                            color: #FF0000;
                        }

                        span.success
                        {
                            margin: 8px 0 0 0;
                            padding: 0;
                            height: 1%;
                            
                            color: #7b912b;
                        }

        </style>

        </div>
       

    </div>

    

</section>

<!-- shopping cart section ends -->


<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>
