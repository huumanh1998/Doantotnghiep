<?php
   include 'inc/header.php';
?>

<?php
    if(!isset($_GET['proid']) || $_GET['proid']==NULL){
       echo "<script>window.location ='404.php'</script>";
    }else{
         $id = $_GET['proid']; 
    }

    $customer_id = Session::get('customer_id');
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
       
        $productid = $_POST['productid'];
        $insertCompare = $product->insertCompare($productid,$customer_id);
        
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
       
        $productid = $_POST['productid'];
        $insertWishlist = $product->insertWishlist($productid,$customer_id);
        
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

        $quantity = $_POST['quantity'];
        $insertCart = $ct->add_to_cart($quantity, $id);
        
    }
    if (isset($_POST['binhluan_submit'])){
        $binhLuan = $_POST['binhluan'];
        $productId = $_POST['product_id_binhluan'];
        $binhluan_insert =$cs->insert_binhluan($binhLuan, $productId);
    }
    if(isset($_GET['xoa'])) {
        $cs->deletebinhluan($_GET['xoa']);
        Header("Location: details.php?proid=" . $_GET['proid']);
    }

 ?>

<!-- home section ends -->

<!-- arrivals section starts  -->

<section class="arrivals">
    
    <div class = "card-wrapper">
        <?php 
            $get_product_details = $product->get_details($id);
            if($get_product_details){
                while($result_details = $get_product_details->fetch_assoc()){

        ?>
      <div class = "card">
        <!-- card left -->
        <div class = "product-imgs">
          <div class = "img-display">
            <div class = "img-showcase" style="border: 2px solid #333333; background: white;border-radius: 5px;">
              <img style="width: 480px;height: 480px;"src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
            </div>
          </div>
          <div class = "img-select" style="display: flex;width: 100%;">
            <div class = "img-item" style="border: 2px solid #333333; background: white;width: 50%;border-radius: 5px">
              <a href = "#" data-id = "1">
                <img style="min-width:240px;max-width: 240px;height: 220px;"src="admin/uploads/<?php echo $result_details['image1'] ?>" alt="" />
              </a>
            </div>
           
             <div class = "img-item" style="border: 2px solid #333333; background: white;width: 50%;border-radius: 5px">
              <a href = "#" data-id = "4">
                <img style="min-width:240px;height: 220px;"src="admin/uploads/<?php echo $result_details['image2'] ?>" alt="" />
              </a>
            </div>
          </div>
        </div>
        <!-- card right -->
        <div class = "product-content">
          <h2 class = "product-title"><?php echo $result_details['productName'] ?></h2>
            <div class = "product-price">
              <p class = "new-price">Danh mục: <span><?php echo $result_details['catName'] ?></span></p>
              <p class = "new-price">Thương hiệu: <span><?php echo $result_details['brandName'] ?></span></p>
            </div>
          <div class = "product-rating">
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star"></i>
            <i class = "fas fa-star-half-alt"></i>
            <span>4.7(21)</span>
          </div>

          <div class = "product-price">
            <!-- <p class = "last-price">Old Price: <span>$257.00</span></p> -->
            <p class = "new-price">Giá: <span><?php echo $fm->format_currency($result_details['price'])." "."VNĐ" ?></span></p>
          </div>
          <div class = "product-price">
            <p class = "new-price">Số lượng: <span><?php echo $result_details['quanti'] ?></span></p>
          </div>
          <div class = "product-detail">
            <h2>Thông tin sản phẩm: </h2>
            <p><?php echo $fm->textShorten($result_details['product_desc'],2000) ?></p>
            
            <ul>
              <li>Liên hệ: <span>+84336586565</span></li>
              <li>Vận chuyển: <span>Toàn quốc</span></li>
              <li>Phí vận chuyển: <span>Miễn phí</span></li>
            </ul>
          </div>

          <div class = "purchase-info">
            <form action="" method="post">
            <input type="number" class="buyfield" name="quantity" value="1" min="1" max="<?php echo $result_details['quanti'] ?>"/>

            <input style="width: 120px;background-color: #0984e3;" type="submit" class="btn" name="submit" value="Đặt ngay"/>
                        <?php 
                            if(isset($insertCart)){
                            echo $insertCart;
                        }
                        ?>
           
                    <input type="hidden" name="productid" class = "btn"value="<?php echo $result_details['productId'] ?>"/>
                    <?php
                    $login_check = Session::get('customer_login'); 
                        if($login_check){
                            
                            echo '<input type="submit" class="btn" style="width:110px;" name="wishlist" value="Yêu thích">';
                        }else{
                            echo '';
                        }   
                    ?>
                    </form>
                    <?php
                    if(isset($insertWishlist)){
                        echo $insertWishlist;
                    }
                    ?>
          </div>

         
        </div>
      </div>
      <?php 
            }
        }
            ?>

   
</div>
    
    <script src="script.js"></script>

</section>


<section class="contact">
 
    <form action="" method="POST">
        <h3>Bình luận</h3>
         <?php
            if(isset($binhluan_insert)){
                echo $binhluan_insert;
            } 
            ?>
        <?php
                $id = Session::get('product_id');
                $get_comment = $cs->show_comment($_GET['proid']);
                if($get_comment){
                    while($result = $get_comment->fetch_assoc()){
                ?>
               
                 <p style="padding: 0rem 0;color:black; font-size: 15px;font-weight:400;"><?php echo $result['name'] . ':'.' '.' '.$result['binhluan'] ?>
                <?php
                    if (Session::get('customer_id') == $result['id']) {
                ?>
                <a class="btn" style="color:white;font-size:14px;padding: 1rem;"
                    onclick = "return confirm('Bạn có muốn xóa?')"href="details.php?proid=<?=$_GET['proid']?>&xoa=<?=$result['binhluan_Id']?>">Xóa</a></p>
                <?php }?>
                
            <?php
                    }
                }
            ?>
       
   
        <?php 
            $path = "comment.php";
            $login_check = Session::get('customer_login');
            if($login_check==false){
                echo '';
            }else{
               require $path;
            }
        ?>
    </form>

   

</section>

<!-- footer section starts  -->

<?php
   include 'inc/footer.php';
?>
