<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    $cat = new category();
     if(isset($_GET['delid'])){
         $id = $_GET['delid']; 
         $delcat = $cat->del_category($id);
    }

?>

        <div class="grid_10">
            <div class="box round first grid">

                <h2>Danh sách chuyên mục</h2>
                <div class="block">
                	<?= isset($delcat) ? $delcat : "" ?> 
                	     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Thứ tự.</th>
							<th>Tên danh mục</th>
							<th>Hình ảnh</th>
							<th>Hoạt động</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$show_cate = $cat->show_category();
						if($show_cate){
							$i = 0;
							while ($result = $show_cate->fetch_assoc()) {
								$i++;
							
						
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName'] ?></td>
							<td><img src="uploads/<?php echo $result['cat_Image'] ?>" width="100"></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId'] ?>">Sửa</a> || <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['catId'] ?>">Xóa</a></td>
						</tr>
						<?php 
						}
							}
						?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

