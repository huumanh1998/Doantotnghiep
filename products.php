<?php
   include 'inc/header.php';
?>
<?php
   

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
   

 ?>
 

<!-- category section starts  -->
<h1 class="heading" style="padding-top: 20px;"> Danh mục <span>Sản phẩm</span> </h1>   
<header class="header" style="background: #eee;">
    <style type="text/css">
        .header .category .box-container{
            display: flex;
        }
        .header .category .box-container h3{
            min-width: 140px;
        }
</style>
<section class="category" style="padding: 0rem 9%;">

    <div class="box-container" >
         <?php 
                $getall_category = $cat->show_category_fontend();
                    if($getall_category){
                        while($result_allcat = $getall_category->fetch_assoc()){
        ?>
        <a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>" class="box">
             <img src="admin/uploads/<?php echo $result_allcat["cat_Image"] ?>" alt=""
            width="100" /> 
            <h3><?php echo $result_allcat['catName'] ?></h3>
        </a>
      
                         
        <?php
                }
            }
        ?>
     

    </div>

</section>
</header>
<!-- category section ends -->

<!-- products section starts  -->

<section class="products">

    <h1 class="heading">Toàn bộ<span> Sản Phẩm</span> </h1>

    <div class="box-container">
        <?php 
                $product_feathered = $product->getproduct_feathered1();
                if($product_feathered){
                    while($result = $product_feathered->fetch_assoc()){

        ?>
        <div class="box">
            <div class="image">
                <a href="details.php?proid=<?php echo $result['productId']?>"><img src="admin/uploads/<?php echo $result["image"] ?>" class="main-img" alt=""  /></a>
                <img src="admin/uploads/<?php echo $result["image1"] ?>" class="hover-img" alt="">
                <div class="icons">
                    <form action="" method="post">
                    <a href="details.php?proid=<?php echo $result['productId']?>" class="fas fa-shopping-cart"></a>
                    <a href="details.php?proid=<?php echo $result['productId']?>" class="fas fa-search-plus"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    </form>
                </div>
            </div>
            
            <div class="content">
                <h3><?php echo $result["productName"] ?></h3>
                <div class="price"><?php echo $fm->format_currency($result["price"])." "."VND" ?></div>
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

<!-- products section ends -->

<!-- product banner section starts  -->

<!-- <section class="product-banner">

    <h1 class="heading"> <span>deal</span> of the day </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/product-banner-1.jpg" alt="">
            <div class="content">
                <span>special offer</span>
                <h3>upto 50% off</h3>
                <a href="#" class="btn">shop now</a>
            </div>
        </div>

        <div class="box">
            <img src="images/product-banner-2.jpg" alt="">
            <div class="content">
                <span>special offer</span>
                <h3>upto 50% off</h3>
                <a href="#" class="btn">shop now</a>
            </div>
        </div>
        

    </div>
    
</section> -->

<!-- product banner section ends -->

<?php
   include 'inc/footer.php';
?>
