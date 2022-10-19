<?php

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class product
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function search_product($tukhoa){
			$tukhoa = $this->fm->validation($tukhoa);
			$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
			$result = $this->db->select($query);
			return $result;

		}
		public function insert_product($data,$files){

			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$quanti = mysqli_real_escape_string($this->db->link, $data['quanti']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			//image1
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name1 = $_FILES['image1']['name'];
			$file_size1 = $_FILES['image1']['size'];
			$file_temp1 = $_FILES['image1']['tmp_name'];

			$div1 = explode('.', $file_name1);
			$file_ext1 = strtolower(end($div1));
			$unique_image1 = substr(md5(time()+1), 0, 10).'.'.$file_ext1;
			$uploaded_image1 = "uploads/".$unique_image1;
			//image2
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name2 = $_FILES['image2']['name'];
			$file_size2 = $_FILES['image2']['size'];
			$file_temp2 = $_FILES['image2']['tmp_name'];

			$div2 = explode('.', $file_name2);
			$file_ext2 = strtolower(end($div2));
			$unique_image2 = substr(md5(time()+2), 0, 10).'.'.$file_ext2;
			$uploaded_image2 = "uploads/".$unique_image2;

			if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" ||  $quanti==""|| $file_name ==""|| $file_name1 ==""|| $file_name2 ==""){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp,$uploaded_image);
				move_uploaded_file($file_temp1,$uploaded_image1);
				move_uploaded_file($file_temp2,$uploaded_image2);
				$query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,quanti,image,image1,image2) VALUES('$productName','$brand','$category','$product_desc','$price','$quanti','$unique_image','$unique_image1','$unique_image2')";
				
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
					return $alert;
				}
			}
		}
		// Insert Product
		// public function insert_product($data,$files){

			
		// 	$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		// 	$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		// 	$category = mysqli_real_escape_string($this->db->link, $data['category']);
		// 	$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		// 	$price = mysqli_real_escape_string($this->db->link, $data['price']);
		// 	$type = mysqli_real_escape_string($this->db->link, $data['type']);
		// 	$quanti = mysqli_real_escape_string($this->db->link, $data['quanti']);
		// 	//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
		// 	$permited  = array('jpg', 'jpeg', 'png', 'gif');
		// 	$file_name = $_FILES['image']['name'];
		// 	$file_size = $_FILES['image']['size'];
		// 	$file_temp = $_FILES['image']['tmp_name'];

		// 	$div = explode('.', $file_name);
		// 	$file_ext = strtolower(end($div));
		// 	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		// 	$uploaded_image = "uploads/".$unique_image;
		// 	//image1
		// 	$permited  = array('jpg', 'jpeg', 'png', 'gif');
		// 	$file_name1 = $_FILES['image1']['name'];
		// 	$file_size1 = $_FILES['image1']['size'];
		// 	$file_temp1 = $_FILES['image1']['tmp_name'];

		// 	$div1 = explode('.', $file_name1);
		// 	$file_ext1 = strtolower(end($div1));
		// 	$unique_image1 = substr(md5(time()+1), 0, 10).'.'.$file_ext1;
		// 	$uploaded_image1 = "uploads/".$unique_image1;
		// 	//image2
		// 	$permited  = array('jpg', 'jpeg', 'png', 'gif');
		// 	$file_name2 = $_FILES['image2']['name'];
		// 	$file_size2 = $_FILES['image2']['size'];
		// 	$file_temp2 = $_FILES['image2']['tmp_name'];

		// 	$div2 = explode('.', $file_name2);
		// 	$file_ext2 = strtolower(end($div2));
		// 	$unique_image2 = substr(md5(time()+2), 0, 10).'.'.$file_ext2;
		// 	$uploaded_image2 = "uploads/".$unique_image2;

		// 	if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type=="" || $quanti==""|| $file_name ==""|| $file_name1 ==""|| $file_name2 ==""){
		// 		$alert = "<span class='error'>Các trường không được để trống</span>";
		// 		return $alert;
		// 	}else{
		// 		move_uploaded_file($file_temp,$uploaded_image);
		// 		move_uploaded_file($file_temp1,$uploaded_image1);
		// 		move_uploaded_file($file_temp2,$uploaded_image2);
		// 		$query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,quanti,image,image1,image2) VALUES('$productName','$brand','$category','$product_desc','$price','$type','$quanti','$unique_image','$unique_image1','$unique_image2')";
				
		// 		$result = $this->db->insert($query);
		// 		if($result){
		// 			$alert = "<span class='success'>Thêm sản phẩm thành công</span>";
		// 			return $alert;
		// 		}else{
		// 			$alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
		// 			return $alert;
		// 		}
		// 	}
		// }
		public function update_product($data,$files,$id){
			// var_dump($_FILES);	
		
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			// $type = mysqli_real_escape_string($this->db->link, $data['type']);
			$quanti = mysqli_real_escape_string($this->db->link, $data['quanti']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			if ($_FILES['image']['name'] !== '') {
				$permited  = array('jpg', 'jpeg', 'png', 'gif');
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_temp = $_FILES['image']['tmp_name'];

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				// $file_current = strtolower(current($div));
				$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
				$uploaded_image = "uploads/".$unique_image;
			}

			//image1
			if ($_FILES['image1']['name'] !== '') {	
				$permited1  = array('jpg', 'jpeg', 'png', 'gif');
				$file_name1 = $_FILES['image1']['name'];
				$file_size1 = $_FILES['image1']['size'];
				$file_temp1 = $_FILES['image1']['tmp_name'];

				$div1 = explode('.', $file_name1);
				$file_ext1 = strtolower(end($div1));
				// $file_current = strtolower(current($div));
				$unique_image1 = substr(md5(time()+1), 0, 10).'.'.$file_ext1;
				$uploaded_image1 = "uploads/".$unique_image1;
			}
			
			//image2
			if ($_FILES['image2']['name'] !== '') {
				$permited2  = array('jpg', 'jpeg', 'png', 'gif');

				$file_name2 = $_FILES['image2']['name'];
				$file_size2 = $_FILES['image2']['size'];
				$file_temp2 = $_FILES['image2']['tmp_name'];

				$div2 = explode('.', $file_name2);
				$file_ext2 = strtolower(end($div2));
				// $file_current = strtolower(current($div));
				$unique_image2 = substr(md5(time()+2), 0, 10).'.'.$file_ext2;
				$uploaded_image2 = "uploads/".$unique_image2;
			}
			
			if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" ||  $quanti==""){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				if ((isset($file_size) and $file_size > 4096000) or (isset($file_size1) and $file_size1 > 4096000) or (isset($file_size2) and $file_size2 > 4096000)) {

	    		 $alert = "<span class='success'>Kích thước hình ảnh nên nhỏ hơn 4MB!</span>";
				return $alert;
			    } 
				else if (
					(isset($file_ext) and in_array($file_ext, $permited) === false) or
					(isset($file_ext1) and in_array($file_ext1, $permited1) === false) or
					(isset($file_ext2) and in_array($file_ext2, $permited2) === false)) 
				{
			    $alert = "<span class='success'>Bạn chỉ có thể tải lên:-'jpg', 'jpeg', 'png', 'gif'</span>";
				return $alert;
				}
				if (isset($file_temp)) move_uploaded_file($file_temp,$uploaded_image);
				if (isset($file_temp1)) move_uploaded_file($file_temp1,$uploaded_image1);
				if (isset($file_temp2)) move_uploaded_file($file_temp2,$uploaded_image2);
				$query = "UPDATE tbl_product SET
				productName = '$productName',
				brandId = '$brand',
				catId = '$category', 
				quanti = '$quanti', 
				price = '$price', ";
				if (isset($file_name)) $query .= "image = '$unique_image',";
				if (isset($file_name1)) $query .= "image1 = '$unique_image1',";
				if (isset($file_name2)) $query .= "image2 = '$unique_image2',";
				$query .= "product_desc = '$product_desc'
				WHERE productId = '$id'";
					
				$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật sản phẩm không thành công</span>";
						return $alert;
					}
				
			}

		}
		public function insert_slider($data,$files){
			$sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($sliderName=="" || $type==""){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 2048000) {

		    		 $alert = "<span class='success'>Kích thước hình ảnh nên nhỏ hơn 2MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>Bạn chỉ có thể tải lên:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "INSERT INTO tbl_slider(sliderName,type,slider_image) VALUES('$sliderName','$type','$unique_image')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Thêm Slide thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm Slide không thành công</span>";
						return $alert;
					}
				}
				
				
			}
		}
		public function show_slider(){
			$query = "SELECT * FROM tbl_slider where type='1' order by sliderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_slider_list(){
			$query = "SELECT * FROM tbl_slider order by sliderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_product(){
			// $query = "

			// SELECT p.*,c.catName, b.brandName

			// FROM tbl_product as p,tbl_category as c, tbl_brand as b where p.catId = c.catId 

			// AND p.brandId = b.brandId 

			// order by p.productId desc";

			$query = "

			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 

			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 

			order by tbl_product.productId desc";

			// $query = "SELECT * FROM tbl_product order by productId desc";

			$result = $this->db->select($query);
			return $result;
		}
		public function update_type_slider($id,$type){

			$type = mysqli_real_escape_string($this->db->link, $type);
			$query = "UPDATE tbl_slider SET type = '$type' where sliderId='$id'";
			$result = $this->db->update($query);
			return $result;
		}
		public function del_slider($id){
			$query = "DELETE FROM tbl_slider where sliderId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa Slide thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa Slide không thành công</span>";
				return $alert;
			}
		}
		// public function update_product($data,$files,$id){

		
		// 	$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		// 	$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		// 	$category = mysqli_real_escape_string($this->db->link, $data['category']);
		// 	$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		// 	$price = mysqli_real_escape_string($this->db->link, $data['price']);
		// 	$type = mysqli_real_escape_string($this->db->link, $data['type']);
		// 	$quanti = mysqli_real_escape_string($this->db->link, $data['quanti']);
		// 	//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
		// 	$permited  = array('jpg', 'jpeg', 'png', 'gif');

		// 	$file_name = $_FILES['image']['name'];
		// 	$file_size = $_FILES['image']['size'];
		// 	$file_temp = $_FILES['image']['tmp_name'];

		// 	$div = explode('.', $file_name);
		// 	$file_ext = strtolower(end($div));
		// 	// $file_current = strtolower(current($div));
		// 	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		// 	$uploaded_image = "uploads/".$unique_image;

		// 	//image1
		// 	$permited1  = array('jpg', 'jpeg', 'png', 'gif');

		// 	$file_name1 = $_FILES['image1']['name'];
		// 	$file_size1 = $_FILES['image1']['size'];
		// 	$file_temp1 = $_FILES['image1']['tmp_name'];

		// 	$div1 = explode('.', $file_name1);
		// 	$file_ext1 = strtolower(end($div1));
		// 	// $file_current = strtolower(current($div));
		// 	$unique_image1 = substr(md5(time()+1), 0, 10).'.'.$file_ext1;
		// 	$uploaded_image1 = "uploads/".$unique_image1;
		// 	//image2
		// 	$permited2  = array('jpg', 'jpeg', 'png', 'gif');

		// 	$file_name2 = $_FILES['image2']['name'];
		// 	$file_size2 = $_FILES['image2']['size'];
		// 	$file_temp2 = $_FILES['image2']['tmp_name'];

		// 	$div2 = explode('.', $file_name2);
		// 	$file_ext2 = strtolower(end($div2));
		// 	// $file_current = strtolower(current($div));
		// 	$unique_image2 = substr(md5(time()+2), 0, 10).'.'.$file_ext2;
		// 	$uploaded_image2 = "uploads/".$unique_image2;
		// 	if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type==""|| $quanti==""){
		// 		$alert = "<span class='error'>Các trường không được để trống</span>";
		// 		return $alert;
		// 	}else{
		// 		if(!empty($file_name) and !empty($file_name1) and !empty($file_name2)){
		// 			//Nếu người dùng chọn ảnh
		// 			if ($file_size > 404800 and $file_size1 > 404800 and $file_size2) {

		//     		 $alert = "<span class='success'>Kích thước hình ảnh nên nhỏ hơn 2MB!</span>";
		// 			return $alert;
		// 		    } 
		// 			elseif (in_array($file_ext, $permited) === false and in_array($file_ext1, $permited1) === false and in_array($file_ext2, $permited2) === false) 
		// 			{
		// 		     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
		// 		    $alert = "<span class='success'>Bạn chỉ có thể tải lên:-".implode(', ', $permited, $permited1, $permited2)."</span>";
		// 			return $alert;
		// 			}
		// 			move_uploaded_file($file_temp,$uploaded_image);
		// 			move_uploaded_file($file_temp1,$uploaded_image1);
		// 			move_uploaded_file($file_temp2,$uploaded_image2);
		// 			$query = "UPDATE tbl_product SET
		// 			productName = '$productName',
		// 			brandId = '$brand',
		// 			catId = '$category', 
		// 			type = '$type',
		// 			quanti = '$quanti', 
		// 			price = '$price', 
		// 			image = '$unique_image',
		// 			image1 = '$unique_image1',
		// 			image2 = '$unique_image2',
		// 			product_desc = '$product_desc'
		// 			WHERE productId = '$id'";
					
		// 		}else{
		// 			//Nếu người dùng không chọn ảnh
		// 			$query = "UPDATE tbl_product SET

		// 			productName = '$productName',
		// 			brandId = '$brand',
		// 			catId = '$category', 
		// 			type = '$type', 
		// 			price = '$price', 
		// 			quanti = '$quanti',
		// 			product_desc = '$product_desc'

		// 			WHERE productId = '$id'";
					
		// 		}
		// 		$result = $this->db->update($query);
		// 			if($result){
		// 				$alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
		// 				return $alert;
		// 			}else{
		// 				$alert = "<span class='error'>Cập nhật sản phẩm không thành công</span>";
		// 				return $alert;
		// 			}
				
		// 	}

		// }
		public function del_product($id){
			$query = "DELETE FROM tbl_product where productId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa sản phẩm thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
				return $alert;
			}
			
		}
		public function del_wlist($proid,$customer_id){
			$query = "DELETE FROM tbl_wishlist where productId = '$proid' AND customer_id='$customer_id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa sản phẩm yêu thích thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa sản phẩm yêu thích không thành công</span>";
				return $alert;
			}
		}
		public function del_compare($proid,$customer_id){
			$query = "DELETE FROM tbl_compare where productId = '$proid' AND customer_id='$customer_id'";
			$result = $this->db->delete($query);
			return $result;
		}
		public function getproductbyId($id){
			$query = "SELECT * FROM tbl_product where productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		//END BACKEND 
		public function getproduct_feathered(){
			$query = "
			SELECT tbl_product.productId,tbl_product.productName, tbl_product.price, tbl_product.image, tbl_product.image1, tbl_product.image2,
			IFNULL(COUNT(tbl_binhluan.productId), 0) as commentCount,
			IFNULL(SUM(tbl_order.price * tbl_order.quantity), 0) as orderCount,
			(tbl_product.view * 30 / 100 / 5 + IFNULL(COUNT(tbl_binhluan.productId), 0) * 30 /100 + IFNULL(SUM(tbl_order.price * tbl_order.quantity), 0) * 40 / 100 / 3000) as average_fethered
			FROM tbl_product
			LEFT JOIN tbl_binhluan ON tbl_product.productId = tbl_binhluan.productId
			LEFT JOIN tbl_order ON tbl_order.productId = tbl_product.productId
			GROUP BY tbl_product.productId
			ORDER BY average_fethered DESC
			LIMIT 9";
			$result = $this->db->select($query);
			return $result;
		} 
		public function getproduct_feathered1(){
			$query = "SELECT * FROM tbl_product";
			$result = $this->db->select($query);
			return $result;
		} 
		
		public function getproduct_new(){
			$sp_tungtrang = 9;
			if(!isset($_GET['trang'])){
				$trang = 1;
			}else{
				$trang = $_GET['trang'];
			}
			$tung_trang = ($trang-1)*$sp_tungtrang;
			$query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang,$sp_tungtrang";
			$result = $this->db->select($query);
			return $result;
		} 
		public function get_all_product(){
			$query = "SELECT * FROM tbl_product";
			$result = $this->db->select($query);
			return $result;
		} 
		public function get_details($id){
			$query = "

			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 

			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'

			";

			$result = $this->db->select($query);

			$update = "UPDATE tbl_product SET view = view + 1 WHERE productId=$id";

			$this->db->update($update);

			return $result;
		}
		public function getLastestIphone(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '1' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestIphonepro(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '1' order by productId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestSamsung(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '2' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestSamsungpro(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '2' order by productId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestSony(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '3' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestSonypro(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '3' order by productId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestOppo(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '4' order by productId desc LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestOppopro(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '4' order by productId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestXiaomi(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '5' order by productId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestNokia(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '6' order by productId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_compare($customer_id){
			$query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_wishlist($customer_id){
			$query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function insertCompare($productid, $customer_id){
			
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_compare = $this->db->select($check_compare);

			if($result_check_compare){
				$msg = "<span class='error'>Sản phẩm đã có trong so sánh </span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_compare = $this->db->insert($query_insert);

			if($insert_compare){
						$alert = "<span class='success'>Thêm vào so sánh thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm vào so sánh không thành công</span>";
						return $alert;
					}
			}
		}
		public function insertWishlist($productid, $customer_id){
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_wlist = $this->db->select($check_wlist);

			if($result_check_wlist){
				$msg = "<span class='error'>Sản phẩm đã được thêm vào danh sách yêu thích</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_wlist = $this->db->insert($query_insert);

			if($insert_wlist){
						$alert = "<span class='success'>Thêm vào danh sách yêu thích thành công </span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Yhêm vào danh sách yêu thích không thành công </span>";
						return $alert;
					}
			}
		}


	}
?>