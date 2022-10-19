<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>

<?php
    $cat = new category();

    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
       echo "<script>window.location ='catlist.php'</script>";
    }else{
         $id = $_GET['catid']; 
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $updateCat = $cat->update_category($_POST,$_FILES, $id);
        
    }
?>
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>

               <div class="block copyblock"> 
                 <?php
                if(isset($updateCat)){
                    echo $updateCat;
                }
                ?>
                <?php 
                    $get_cate_name = $cat->getcatbyId($id);
                    if($get_cate_name){
                        while ($result = $get_cate_name->fetch_assoc()) {

                ?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" value ="<?php echo $result['catName'] ?>" name="catName" placeholder="Sửa danh mục sản phẩm ..." class="medium" />
                            </td>
                        </tr>
                            <td>
                                <img src="uploads/<?php echo $result['cat_Image'] ?>" width="90"><br>
                                <input type="file" name="image" />
                            </td>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Cập nhật" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php 
                        }    
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>