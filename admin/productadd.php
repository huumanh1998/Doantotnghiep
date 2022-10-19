<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php
    $pd = new product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
       
       
        $insertProduct = $pd->insert_product($_POST,$_FILES);
        
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Sản phẩm</h2>
          <?php

                if(isset($insertProduct)){
                    echo $insertProduct;
                }

         ?>
        <div class="block">               
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Nhập tên sản phẩm..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>---Lựa chọn Danh mục---</option>
                            <?php 
                            $cat = new category();
                            $catlist = $cat->show_category();
                           
                            if($catlist){
                                while($result = $catlist->fetch_assoc()){
                           
                            ?>
                            <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                               
                                <?php 
                                    }
                                }
                                ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Hãng</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>---Lựa chọn Hãng---</option>
                            <?php 
                            $brand = new brand();
                            $brandlist = $brand->show_brand();
                           
                            if($brandlist){
                                while($result = $brandlist->fetch_assoc()){
                           
                            ?>
                            <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                               
                                <?php 
                                    }
                                }
                                ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Miêu tả sản phẩm</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Nhập giá..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Cập nhật hình ảnh</label>
                    </td>
                    <td>
                        <input type="file" name="image"  />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Ảnh phụ</label>
                    </td>
                    <td>
                        <input type="file" name="image1"  />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ảnh phụ 2</label>
                    </td>
                    <td>
                        <input type="file" name="image2"  />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Số lượng</label>
                    </td>
                    <td>
                       <input type="number" name="quanti" min="0" value=""/>
                    </td>
                </tr>
				<!-- <tr>
                    <td>
                        <label>Loại Sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Lựu chọn loại sản phẩm</option>
                            <option value="0">Nổi bật</option>
                            <option value="1">Không nổi bật</option>
                        </select>
                    </td>
                </tr>
                -->
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Thêm" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


