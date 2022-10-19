<?php
   include 'inc/header.php';
?>

<?php
    if(isset($_GET['cartid'])){
        $cartid = $_GET['cartid']; 
        $delcart = $ct->del_product_cart($cartid);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
        if($quantity<=0){
            $delcart = $ct->del_product_cart($cartId);
        }
    }
?>
<?php
    // if(!isset($_GET['id'])){
    //     echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
    // }
?>


<!-- shopping cart section starts  -->

<section class="shopping-cart">

    <h1 class="heading"><span style="text-transform: none;">Thanh toán qua VNPay</span></h1>
    

    <div class="box-container">
        <?php 
        if(isset($_GET['congthanhtoan'])=='vnpay'){
        ?>
        <?php 
        }

        ?>
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
                 
        <?php 
            $get_product_cart = $ct->get_product_cart();
                if($get_product_cart){
                    $subtotal = 0;
                    $qty = 0;
                    while($result = $get_product_cart->fetch_assoc()){
                ?>
              
        <div class="box">
              
            <img src="admin/uploads/<?php echo $result['image'] ?>" alt="" />
            <div class="content">
                <h3>Tên sản phẩm: <?php echo $result['productName'] ?></h3>
                <form action="" method="post">
                    <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
                    <input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/>
                    <input style="width:100px" type="submit" name="submit" value="Cập nhật"/>
                </form>
                <div class="price" style="font-size:19px;color:#b2008d;padding-bottom: 8px;">Giá: <?php echo $fm->format_currency($result['price'])." "."VNĐ"?></div>
                <div class="price">Tổng giá:
                        <?php
                            $total = $result['price'] * $result['quantity'];
                                echo $fm->format_currency($total)." "."VNĐ";
                        ?>
                </div>
                <div class="btn"><a style="color:white;" href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></div>
            </div>
           
        </div>
         <?php 
                            $subtotal += $total;
                            $qty = $qty + $result['quantity'];
                                }
                            }
                            ?>
        <?php
                                    $check_cart = $ct->check_cart();
                                    if($check_cart){
                                    
                        ?>
        <div class="cart-total">
            <h3> Tạm tính : <span><?php 

                                    echo $fm->format_currency($subtotal)." "."VNĐ";
                                    Session::set('sum',$subtotal);
                                    Session::set('qty',$qty);
                                ?></span> </h3>
            <h3> Thuế VAT : <span>5%</span> </h3>
            <h3> Tổng tiền : <span><?php 
                                $vat = $subtotal * 0.05;
                                $gtotal = $subtotal + $vat;
                                echo $fm->format_currency($gtotal)." "."VNĐ";
                                ?> </span> </h3>
           <?php
                       }else{
                        echo '';
                       } 

            ?>              
           
             <?php
                    $check_cart = $ct->check_cart();

                    if(Session::get('customer_id')==true && $check_cart){ 
                    ?>
                    <?php 
                    if(isset($_GET['congthanhtoan'])=='vnpay'){
                    ?>
                        <form action="congthanhtoan.php"  method="post">
                            <input type="hidden" name="total_congthanhtoan" value="<?php echo $gtotal ?>">
                        <button type="submit"class="btn" name="redirect" id="redirect">Thanh toán vnpay</button>
                        </form>

                    <?php 
                        }
                    ?>
                    <?php
                    }else{ 
                    ?>
                    <style type="text/css">
                        a.muahang {
                            font-size: 16px;
                            float: left;
                            padding: 15px 15px;
                            border: 1px solid #ddd;
                            border-radius: .5rem;
                            background: #0984e3;
                            color: #fff;
                            cursor: pointer;
                        }

                    </style>
                        <div class="btn"><a  style="text-align: center;color: white;" href="cart.php"> Quay về giỏ hàng</a></div>
                    <?php
                    } 
                    ?>
        </div>
       

    </div>

    

</section>

<!-- shopping cart section ends -->


<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>
