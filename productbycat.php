<?php
   include 'inc/header.php';
?>
<?php
    
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
       echo "<script>window.location ='404.php'</script>";
    }else{
         $id = $_GET['catid']; 
    }
     
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //     $catName = $_POST['catName'];
    //     $updateCat = $cat->update_category($catName,$id);
        
    // }
   
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


    <div class="box-container">
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
    <?php 
            $name_cat = $cat->get_name_by_cat($id);
            if($name_cat){
                while($result_name = $name_cat->fetch_assoc()){
            
    ?>
    <h1 class="heading"><span> <?php echo $result_name['catName']?></span> </h1>
    <?php 
            }}
    ?>
    <div class="box-container">
        <?php 
            $productbycat = $cat->get_product_by_cat($id);
            if($productbycat){
                while($result = $productbycat->fetch_assoc()){
            
        ?>
        <div class="box">
            <div class="image">
                <a href="#"><img src="admin/uploads/<?php echo $result["image"] ?>" class="main-img" alt=""  /></a>
                <img src="admin/uploads/<?php echo $result["image1"] ?>" class="hover-img" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-shopping-cart"></a>
                    <a href="#" class="fas fa-search-plus"></a>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
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
            }}else{
                echo 'Danh mục không có.';
            }
        ?>
        <style type="text/css">
            .box-container{
                font-size: 30px;
                color: red;
            }
        </style>
    </div>

</section>

<!-- products section ends -->



<?php
   include 'inc/footer.php';
?>
