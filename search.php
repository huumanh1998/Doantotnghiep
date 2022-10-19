<?php
   include 'inc/header.php';
?>

<!-- category section starts  -->



<!-- products section starts  -->

<section class="products">
    <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $tukhoa = $_POST['tukhoa'];
                    $search_product = $product->search_product($tukhoa);
                    
                }
    ?>
    <h1 class="heading">Từ khóa tìm kiếm:<span> <?php echo $tukhoa ?></span> </h1>

    <div class="box-container"style="font-size: 20px;color:red;">
        <?php
            
             if($search_product){
                while($result = $search_product->fetch_assoc()){

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
            }

            }else{
                echo 'Sản phẩm không có sẵn';
            }
        ?>
    </div>

</section>


<?php
   include 'inc/footer.php';
?>
