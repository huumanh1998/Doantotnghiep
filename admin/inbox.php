<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/cart.php');
include_once ($filepath.'/../helpers/format.php');

?>
<?php
	$ct = new cart();
	if(isset($_GET['shiftid'])){
     	$id = $_GET['shiftid'];
     	$time = $_GET['time'];
     	$price = $_GET['price'];
     	$shifted = $ct->shifted($id,$time,$price);
    }

    if(isset($_GET['delid'])){
     	$id = $_GET['delid'];
     	$time = $_GET['time'];
     	$price = $_GET['price'];
     	$del_shifted = $ct->del_shifted($id,$time,$price);
    }

    if(isset($_POST['update-quantity'])){
     	$id = $_POST['id'];
     	$quantity = $_POST['quantity'];
     	$ct->update_quantity($id, $quantity);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Hộp thư đến</h2>
                <div class="block">
                <?php 
                if(isset($shifted)){
                	echo $shifted;
                }

                ?>  
                <?php 
                if(isset($del_shifted)){
                	echo $del_shifted;
                }
                ?>

                <?php if (isset($_GET['update']) && $_GET['update'] == 1) : ?>
                	<span class="success">Cập nhật số lượng thành công</span>
            	<?php endif; ?>   
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Thời gian đặt</th>
							<th>Sản phẩm</th>
							<!-- <th>Đơn giá</th> -->
							<th>Số lượng</th>
							<th>Tổng tiền</th>
							<th>Người đặt</th>
							<th>Địa chỉ</th>
							<th>Thanh toán</th>
							<th>Hoạt động</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$ct = new cart();
						$fm = new Format();
						$get_inbox_cart = $ct->get_inbox_cart();
						if($get_inbox_cart){
							$i = 0;
							while($result = $get_inbox_cart->fetch_assoc()){
								$i++;
						 ?>
						
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_order']) ?></td>
							<td><?php echo $result['productName'] ?></td>
						<!-- 	<td><?php echo $result['price'].' '.'VNĐ' ?></td> -->
							<td><form action="?update=1" method="post">
								<input style="width:30px" type="hidden" name="id" min="0" value="<?php echo $result['id'] ?>"/>
								<input style="width:30px" type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/>
								<input style="width:70px" type="submit" name="update-quantity" value="Cập nhật"/>
								</form>
							</td>
							<td><?php
	                            $total =  $result['price'] * $result['quantity'] + $result['price'] * $result['quantity']*0.05;
	                                echo $fm->format_currency($total)." "."VNĐ";
                        		?>	
                        	</td>
							<td><?php echo $result['name'] ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">Xem khách hàng</a></td>
							<td>
							<?php 
							if($result['payment']==0){
							?>

								<p>Chưa thanh toán</p>

								<?php
							}elseif($result['payment']==1){
								?>
								<?php
								echo 'Thanh toán trực tiếp';
								?>
							<?php
							}elseif($result['payment']==2){
							?>

								<p>Đã thanh toán</p>

							<?php
								}
							
							?>
							</td>
							<td>
							<?php 
							if($result['status']==0){
							?>

								<a href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xác nhận đơn hàng</a>

								<?php
							}elseif($result['status']==1){
								?>
								<?php
								echo 'Đang xử lý';
								?>
							<?php
							}elseif($result['status']==2){
							?>

							<a onclick = "return confirm('Bạn có muốn xóa?')"href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xóa</a>

							<?php
								}
							
							?>
							</td>
						</tr>
						<?php
					}}
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
