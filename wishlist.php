<?php
   include 'inc/header.php';
?>

<?php
     if(isset($_GET['proid'])){
        $customer_id = Session::get('customer_id');
         $proid = $_GET['proid']; 
         $delwlist = $product->del_wlist($proid,$customer_id);
     }
?>


<!-- shopping cart section starts  -->

<section class="shopping-cart">

    <h1 class="heading"><span style="text-transform: none;">Sản phẩm yêu thích</span></h1>
    
    <?= isset($delwlist) ? $delwlist : "" ?> 
    <div class="box-container">
       <?php
                            $customer_id = Session::get('customer_id');
                            $get_wishlist = $product->get_wishlist($customer_id);
                            if($get_wishlist){
                                $i = 0;
                                while($result = $get_wishlist->fetch_assoc()){
                                    $i++;
                            ?>
              
        <div class="box">
              
            <img src="admin/uploads/<?php echo $result['image'] ?>" alt="" />
            <div class="content">
                <!-- <h3><?php echo $i; ?><h3> -->
                <h3>Tên sản phẩm: <?php echo $result['productName'] ?></h3>
                
                <div class="price" style="font-size:19px;color:#b2008d;padding-bottom: 8px;">Giá: <?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></div>
               
                <div class="btn"><a style="color:white;" href="?proid=<?php echo $result['productId'] ?>">Xóa</a></div>
                <div class="btn"><a style="color:white;"  href="details.php?proid=<?php echo $result['productId'] ?>">Đặt hàng</a></div>
            </div>
           
        </div>
    <?php
                            
            }
        }
    ?>
           
        
       

    </div>

    

</section>

<!-- shopping cart section ends -->


<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>
