<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/customer.php';?>
<?php include_once '../helpers/format.php';?>
<?php
	$cs = new customer();
	$fm = new Format();
	if(isset($_GET['contactId'])){
        $id = $_GET['contactId']; 
        $delcontact = $cs->del_contact($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Ý kiến</h2>
        <div class="block"> 
        <?php
        if(isset($delcontact)){
        	echo $delcontact;
        }
        ?> 
        	
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên</th>
					<th>Email</th>
					<th>SĐT</th>
					<th>Tiêu đề</th>
					<th>Ý kiến</th>
					<th>Hoạt động</th>
				</tr>
			</thead>
			<tbody>
				<?php
			
				$cmlist = $cs->show_contact();
				if($cmlist){
					$i = 0;
					while($result = $cmlist->fetch_assoc()){
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['contactName'] ?></td>
					<td><?php echo $result['contactEmail'] ?></td>
					<td><?php echo $result['contactPhone'] ?></td>
					<td><?php echo $result['contactTitle'] ?></td>
					<td><?php echo $result['contactDesc'] ?></td>
									
					<td><a onclick = "return confirm('Bạn có muốn xóa?')"href="?contactId=<?php echo $result['contactId'] ?>">Xóa</a></td>
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
