<?php
   include 'inc/header.php';
?>
<?php
   include 'inc/slider.php';
?>
<!-- arrivals section starts  -->

<section class="arrivals">

    <h1 class="heading"> Sản phẩm <span style="text-transform: none">Mới</span> </h1>

    <div class="box-container">
            <?php 
                $product_new = $product->getproduct_new();
                if($product_new){
                    while($result_new = $product_new->fetch_assoc()){

            ?>
        <div class="box" >
            
            <div class="image" >
                <a href="details.php?proid=<?php echo $result_new['productId']?>"><img src="admin/uploads/<?php echo $result_new["image"] ?>" class="main-img" alt=""  />
                <img src="admin/uploads/<?php echo $result_new["image1"] ?>" class="hover-img" alt=""  />
                </a>   
            </div>
            <div class="content">
                <h3><?php echo $result_new["productName"] ?></h3>
                <div class="price"> <?php echo $fm->format_currency($result_new["price"])." "."VND" ?> </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="btn"><span ><a href="details.php?proid=<?php echo $result_new['productId']?>" class="details" style="text-transform: none; color:white;">Chi tiết</a></span></div>  
            </div>
            
        </div>
        <?php 
                } 
            }
        ?>
    </div>
    <style type="text/css">
                a.phantrang {
                    border: 1px solid #ddd;
                    padding: 10px;
                    background: #414045;
                    color: #fff;
                    cursor: pointer;
                    font-size: 14px;
                    margin-top: 10px;
                   
                }
                a.phantrang:hover {
                    background: #0984e3;
                }
            </style>
            <div class="" style="margin-top: 20px;">
                <?php
                if(isset($_GET['trang'])){
                    $trang = $_GET['trang'];
                }else{
                    $trang = 1;
                }
                $product_all = $product->get_all_product(); 
                $product_count = mysqli_num_rows($product_all);
                $product_button = ceil($product_count/9);
                $i = 1;
                echo '';
                for($i=1;$i<=$product_button;$i++){
                    ?>
                    <a class="phantrang" <?php if($i==$trang){ echo 'style="background:#0984e3"';} ?>  href="index.php?trang=<?php echo $i ?>"><?php echo $i ?></a>  
                    <?php
                    
                }
                ?>
            </div>
</section>

<!-- arrivals section ends -->

<!-- banner section starts  -->

<section class="banner">
  
    <div class="box-container">
         <a href="products.php" class="box">
            <img src="images/banner1.png" alt="">
            <div class="content">
                <span>Mô hình</span>
                <h3>Vũ trụ Marvel</h3>
            </div>
        </a>

        <a href="products.php" class="box">
            <img src="images/banner2.png" alt="">
            <div class="content">
                <span>Mô hình</span>
                <h3>Đảo Hải Tặc </h3>
            </div>
        </a>

        <a href="products.php" class="box">
            <img src="images/banner3.png" alt="">
            <div class="content">
                <span>Mô hình</span>
                <h3>Naruto Shippuden</h3>
            </div>
        </a>
        
    </div>

</section>

<!-- banner section ends -->



<section class="arrivals">

    <h1 class="heading"> Sản phẩm <span style="text-transform: none">Nổi bật</span> </h1>

    <div class="box-container">
            <?php 
                $product_feathered = $product->getproduct_feathered();
                if($product_feathered){
                    while($result = $product_feathered->fetch_assoc()){

            ?>
        <div class="box" >
            
            <div class="image" >
                <a href="details.php?proid=<?php echo $result['productId']?>"><img src="admin/uploads/<?php echo $result["image"] ?>" class="main-img" alt=""  />
                    <img src="admin/uploads/<?php echo $result["image1"] ?>" class="hover-img" alt=""  />
                </a>
            </div>
            <div class="content">
                <h3><?php echo $result["productName"] ?></h3>
                <div class="price"> <?php echo $fm->format_currency($result["price"])." "."VND" ?> </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="btn"><span ><a href="details.php?proid=<?php echo $result['productId']?>" class="details" style="text-transform: none; color:white;">Chi tiết</a></span></div>  
            </div>
            
        </div>
        <?php 
                } 
            }
        ?>
    </div>

</section>


<!-- footer section starts  -->
<?php
   include 'inc/footer.php';
?>