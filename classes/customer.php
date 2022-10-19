<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class customer
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		// public function insert_binhluan(){
		// 	$product_id = $_POST['product_id_binhluan'];
			
		// 	$binhluan = $_POST['binhluan'];
		// 	if( $binhluan==''){
		// 		$alert = "<span class='error'>Không để trống các trường</span>";
		// 		return $alert;
		// 	}else{
		// 		$query = "INSERT INTO tbl_binhluan(binhluan) VALUES('$binhluan')";
		// 			$result = $this->db->insert($query);
		// 			if($result){
		// 				$alert = "<span class='success'>Bình luận đã gửi</span>";
		// 				return $alert;
		// 			}else{
		// 				$alert = "<span class='error'>Bình luận không thành công</span>";
		// 				return $alert;
		// 		}
		// 	}
		// }
		public function del_comment($id){
			$query = "DELETE FROM tbl_binhluan where binhluan_id = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa bình luận thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa bình luận không thành công</span>";
				return $alert;
			}
		}
		public function show_comment($productId){
            $query = "SELECT binhluan_Id,name,adminName,binhluan,tbl_binhluan.id AS id FROM tbl_binhluan 
			  LEFT JOIN tbl_product ON tbl_binhluan.productId = tbl_product.productId LEFT JOIN tbl_admin ON tbl_admin.adminId = tbl_binhluan.adminId LEFT JOIN tbl_customer ON tbl_customer.id = tbl_binhluan.id
			  WHERE tbl_binhluan.productId=$productId AND rep_Id = ''
			  order by binhluan_Id desc";
            $result = $this->db->select($query);
            return $result;
        }
		public function insert_contact(){
			$contactId = $_POST['contact_id'];
			$contactName = $_POST['contact_name'];
			$contactEmail = $_POST['contact_email'];
			$contactPhone = $_POST['contact_phone'];
			$contactTitle = $_POST['contact_title'];
			$contactDesc = $_POST['contact_desc'];
			if($contactName=='' || $contactEmail==''|| $contactPhone==''|| $contactTitle==''|| $contactDesc==''){
				$alert = "<span class='error'>Không để trống các trường</span>";
				return $alert;
			}else{
				$query = "INSERT INTO tbl_contact(contactName,contactEmail,contactPhone,contactTitle,contactDesc,contactId) VALUES('$contactName','$contactEmail','$contactPhone','$contactTitle','$contactDesc','$contactId')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Ý kiến đã gửi</span></div>";
						return $alert;
					}else{
						$alert = "<span class='error'>Ý kiến không thành công</span>";
						return $alert;
				}
			}
		}
		public function del_contact($id){
			$query = "DELETE FROM tbl_contact where contactId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa ý kiến thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa ý kiến không thành công</span>";
				return $alert;
			}
		}
		public function show_contact(){
			$query = "SELECT * FROM tbl_contact order by contactId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function insert_customers($data){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($name=="" || $city=="" || $zipcode=="" || $email=="" || $address=="" || $country=="" || $phone =="" || $password ==""){
				$alert = "<span class='error'>Không được để trống thông tin </span>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Email đã tồn tại! Vui lòng nhập một email khác</span>";
					return $alert;
				}else{
					$query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password) VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Đăng ký thành công </span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Đăng ký không thành công</span>";
						return $alert;
					}
				}
			}
		}
		// public function insert_customers($data,$files){
		// 	$name = mysqli_real_escape_string($this->db->link, $data['name']);
		// 	$city = mysqli_real_escape_string($this->db->link, $data['city']);
		// 	$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
		// 	$email = mysqli_real_escape_string($this->db->link, $data['email']);
		// 	$address = mysqli_real_escape_string($this->db->link, $data['address']);
		// 	$country = mysqli_real_escape_string($this->db->link, $data['country']);
		// 	$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		// 	$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
		// 	//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
		// 	$permited  = array('jpg', 'jpeg', 'png', 'gif');
		// 	$file_name = $_FILES['image']['name'];
		// 	$file_size = $_FILES['image']['size'];
		// 	$file_temp = $_FILES['image']['tmp_name'];

		// 	$div = explode('.', $file_name);
		// 	$file_ext = strtolower(end($div));
		// 	$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		// 	$uploaded_image = "uploads/".$unique_image;
		// 	if($name=="" || $city=="" || $zipcode=="" || $email=="" || $address=="" || $country=="" || $phone =="" || $password ==""){
		// 		$alert = "<span class='error'>Không được để trống thông tin </span>";
		// 		return $alert;
		// 	}else{
		// 		$check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
		// 		$result_check = $this->db->select($check_email);
		// 		if($result_check){
		// 			$alert = "<span class='error'>Email đã tồn tại! Vui lòng nhập một email khác</span>";
		// 			return $alert;
		// 		}else{
		// 		move_uploaded_file($file_temp,$uploaded_image);
		// 		$query = "INSERT INTO tbl_customer(name,city,zipcode,email,address,country,phone,password) VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password','$unique_image')";
		// 		$result = $this->db->insert($query);
		// 		if($result){
		// 			$alert = "<span class='success'>Thêm danh mục thành công</span>";
		// 			return $alert;
		// 		}else{
		// 			$alert = "<span class='error'>Thêm danh mục không thành công</span>";
		// 			return $alert;
		// 		}
		// 	}
		// 	}
			
		// }
		public function login_customers($data){
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($email=='' || $password==''){
				$alert = "<span class='error'>Mật khẩu và Email không được để trống.</span>";
				return $alert;
			}else{
				$check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
				$result_check = $this->db->select($check_login);
				if($result_check){

					$value = $result_check->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id',$value['id']);
					Session::set('customer_name',$value['name']);
					header('Location:cart.php');
					$alert = "<span class='success'>Đăng nhập thành công <a href='payment.php'>Đến trang thanh toán</a></span>";
						return $alert;
				}else{
					$alert = "<span class='error'>Email hoặc mật khẩu không khớp.</span>";
					return $alert;
				}
			}
		}
		public function show_customers($id){
			$query = "SELECT * FROM tbl_customer WHERE id='$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_customers($data, $id){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			// $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			// $email = mysqli_real_escape_string($this->db->link, $data['email']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			
			if($name=="" || $city=="" || $address=="" || $phone ==""){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				$query = "UPDATE tbl_customer SET name='$name',city='$city',address='$address',phone='$phone' WHERE id ='$id'";
				$result = $this->db->insert($query);
				if($result){
						$alert = "<span class='success'>Cập nhật thông tin thành công</span>";
						return $alert;
				}else{
						$alert = "<span class='error'>Cập nhật thông tinkhông thành công</span>";
						return $alert;
				}
				
			}

		}
		public function update_customers1($data,$files,$id){

		
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			// $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			// $email = mysqli_real_escape_string($this->db->link, $data['email']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "admin/uploads/".$unique_image;


			if($name==""||$city==""||$address==""||$phone==""){
				$alert = "<span class='error'>Các trường không được để trống</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 204800) {

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
					$query = "UPDATE tbl_customer SET
					name = '$name',
					city = '$city',
					address = '$address',
					phone = '$phone',
					avatar = '$unique_image'
					WHERE id = '$id'";
					
				}else{
					//Nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_customer SET

					name = '$name',
					city = '$city',
					address = '$address',
					phone = '$phone'

					WHERE id = '$id'";
					
				}
				$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật thông tin thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật thông tin không thành công</span>";
						return $alert;
					}
				
			}

		}
		// binh luan
		public function insert_binhluan($binhluan, $productId){
            $adminId = Session::get('adminId') ? Session::get('adminId'):"";
            $id = Session::get('customer_id') ? Session::get('customer_id') : "";
            if($binhluan==''){
                $alert = "<span class='error'>Không để trống các trường</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_binhluan(productId,id,adminId,binhluan) VALUES('$productId','$id','$adminId','$binhluan')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class='success'>Bình luận đã gửi</span>";
                        return $alert;
                    }else{
                        $alert = "<span class='error'>Bình luận không thành công</span>";
                        return $alert;
                }
            }
        }
    
        public function show_binhluan($productId){
            $query = "SELECT binhluan_Id,name,adminName,binhluan,tbl_binhluan.id AS id FROM tbl_binhluan 
            LEFT JOIN tbl_product ON tbl_binhluan.id = tbl_product.id LEFT JOIN tbl_admin ON tbl_admin.adminId = tbl_binhluan.adminId WHERE productId=$productId AND rep_Id = '' 
             order by binhluan_Id desc";
            $result = $this->db->select($query);
            return $result;
        }
         public function show_rep($productId,$binhluan_Id){
            $query = "SELECT binhluan_Id,tbl_binhluan.id AS id,name,adminName,binhluan,rep_Id FROM tbl_binhluan 
            LEFT JOIN tbl_product ON tbl_binhluan.id = tbl_product.id LEFT JOIN tbl_admin ON tbl_admin.adminId = tbl_binhluan.adminId WHERE productId=$productId AND rep_Id = $binhluan_Id
             order by binhluan_Id desc";
            $result = $this->db->select($query);
            return $result;
        }
        
         public function show_binhluan_admin(){
            $query = "SELECT productId,binhluan_Id,name,adminName,binhluan FROM tbl_binhluan 
            LEFT JOIN tbl_product ON tbl_binhluan.id = tbl_product.id 
            LEFT JOIN tbl_admin ON tbl_binhluan.adminId = tbl_admin.adminId
             order by binhluan_Id desc";
            $result = $this->db->select($query);
            return $result;

        } 
      
        function deletebinhluan($id){
        $query="SELECT id FROM tbl_binhluan WHERE binhluan_Id = $id";
        $result = $this->db->select($query);
        $bl = $result -> fetch_assoc();
        if (Session::get('customer_id') == $bl['id']) {
        $query = "DELETE FROM tbl_binhluan WHERE binhluan_Id = $id ";
        $this->db->delete($query);

        }

    }
    	public function show_comment_admin(){
			$query = "SELECT * FROM tbl_binhluan order by binhluan_id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_comment1(){
            $query = "SELECT binhluan_Id,productName,name,adminName,binhluan,tbl_binhluan.id AS id FROM tbl_binhluan 
			  LEFT JOIN tbl_product ON tbl_binhluan.productId = tbl_product.productId LEFT JOIN tbl_admin ON tbl_admin.adminId = tbl_binhluan.adminId LEFT JOIN tbl_customer ON tbl_customer.id = tbl_binhluan.id
			  
			  order by binhluan_Id desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function del_order($id){
        	$orderQuery = $this->db->select("SELECT * FROM tbl_order WHERE id = '$id'");
			$order = [];
			if($orderQuery){
	            while($result = $orderQuery->fetch_assoc()){
	            	$order = $result;
	            }
	        }

			$query = "DELETE FROM tbl_order where id = '$id' and status='0' and  payment='1'";
			$result = $this->db->delete($query);

			if($result){
				$customerId = $order['customer_id'];
		        $customerQuery = $this->db->select("SELECT * FROM tbl_customer WHERE id = '$customerId'");
		        $customer = [];
		        if($customerQuery){
		            while($result = $customerQuery->fetch_assoc()){
		            	$customer = $result;
		            }
		        }

		        $customerName = $customer['name'];
		        $customerEmail = $customer['email'];
		        $productName = $order['productName'];
		        $productQuantity = $order['quantity'];
		        $productPrice = $order['price']*$order['quantity'];
		        $productSumPrice = $order['price']*$order['quantity']+$order['price']*$order['quantity']*0.05;
		        $productSum = $productQuantity * $productPrice;
		        $productDate = $order['date_order'];

		        $tieude = 'Hủy đặt hàng Website Chu Store';
		        $noidung = "
		        	<p>Xin chào <b>$customerName</b>,</p>
		        	<p>Bạn đã hủy đơn hàng thành công!</p>
		        	<p><b>THÔNG TIN ĐƠN HÀNG:</b></p>
		        	<p>Tên sản phẩm: $productName</p>
		        	<p>Tổng giá: $productPrice</p>
		        	<p>Tổng tiền: $productSumPrice</p>
		        	<p>Số lượng: $productQuantity</p>
		        	<p>Ngày đặt: $productDate</p>
		        	<p>Trạng thái: <b>Đã hủy</b></p>
		        	<br/>
		        	Trân trọng,
		        	Chu Store
		        ";
		        $mail = new Mailer();
	    		$mail->dathangmail($tieude,$noidung,$customerEmail);
				$alert = "<span class='success'>Hủy đơn hàng thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Hủy đơn hàng không thành công</span>";
				return $alert;
			}
			
		}

}
?>