<?php
   include 'inc/header.php';
   require('mail/sendmail.php');
?>

<?php
    if(isset($_POST['order']) && isset($_POST['email'])){
        $tieude = "Đặt hàng Website Chu Store thành công.";

        $danhSach = "";
        $tong1 = 0;
        $tong2 = 0;
        $tong3 = 0;
        $productNames = explode(",", $_POST['productNames']);
        $productNames1 = explode(",", $_POST['productNames1']);
        $productNames2 = explode(",", $_POST['productNames2']);
        $productNames3 = explode(",", $_POST['productNames3']);
        for($i = 0; $i < count($productNames); $i++) {
            $danhSach .= "<tr>
                        <td style='border:1px solid black'>".$productNames[$i]."</td>
                        <td style='border:1px solid black'>".$productNames1[$i]."</td>
                        <td style='border:1px solid black'>".$productNames2[$i]."</td>
                        <td style='border:1px solid black'>".$productNames3[$i]."</td>
                      </tr>";
            $tong1 += $productNames1[$i];
            $tong2 += $productNames2[$i];
            $tong3 += $productNames3[$i];
        }

        $noidung ="<p>Cảm ơn quý khách đã đặt hàng tại Chu Store</p>
                    <p>Thông tin đơn hàng</p>
                <table style='width:100%;border:1px solid black'>
                      <tr>
                        <td style='border:1px solid black'>Tên sản phẩm</td>
                        <td style='border:1px solid black'>Số lượng</td>
                        <td style='border:1px solid black'>Giá</td>
                        <td style='border:1px solid black'>Tổng tiền</td>
                      </tr>
                      ".$danhSach."
                      <tr>
                        <td style='border:1px solid black'>Tổng cộng</td>
                        <td style='border:1px solid black'>".$tong1."</td>
                        <td style='border:1px solid black'>".$tong2."</td>
                        <td style='border:1px solid black'>".$tong3."</td>
                      </tr>
                </table>
                    ";
        //echo $noidung;
        //return;
        $maildathang = $_POST['email'];
        $mail = new Mailer();
        $mail->dathangmail($tieude,$noidung,$maildathang);
        $customer_id = Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delCart = $ct->del_all_data_cart();
        header('Location:success.php');
    }
?>

<div class="container-new">
        
        <div class="content-new">
            
            <div class="content-new2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Thanh toán trực tiếp</h2>
                    </div>
                    <table>
                        <tr>
                            <th >ID</th>
                            <th >Tên sản phẩm</th>
                            <th >Hình ảnh</th>
                            <th >Tạm tính</th>
                            <th >Số lượng</th>
                            <th >Tổng tiền</th>
                        </tr>
                        <?php
                            $productNames = [];
                            $productNames1 = [];
                            $productNames2 = [];
                            $productNames3 = [];
                            $get_product_cart = $ct->get_product_cart();
                            if($get_product_cart){
                                $subtotal = 0;
                                $qty = 0;
                                $i = 0;
                                while($result = $get_product_cart->fetch_assoc()){
                                    array_push($productNames,$result['productName']);
                                    array_push($productNames1,$result['quantity']);
                                    array_push($productNames2,$result['price']* $result['quantity']);
                                    array_push($productNames3,$result['price']* $result['quantity']+$result['price']* $result['quantity']*0.05);
                                    
                                    $i++;
                        ?>
                        <tr>
                            <td ><?php echo $i; ?></td>
                            <td ><?php echo $result['productName'] ?></td>
                            <td ><img src="admin/uploads/<?php echo $result["image"] ?>" style="width: 100px;height: 100px;" /></td>
                            <td ><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></td>
                            <td ><?php echo $result['quantity'] ?></td>
                            <td ><?php 
                            $total = $result['price'] * $result['quantity'];echo $fm->format_currency($total).' '.'VNĐ' ;?></td>
                        </tr>
                        <?php
                            $subtotal += $total;
                            $qty = $qty + $result['quantity'];
                            }
                        }
                        ?>
                        
                    </table>
                    <?php
                            $check_cart = $ct->check_cart();
                                if($check_cart){
                    ?>
                </div>
                <div class="new-students">
                    <div class="title">
                        <table >
                            <?php
                            $id = Session::get('customer_id');
                            $email = '';
                            $get_customers = $cs->show_customers($id);
                            if($get_customers){
                                while($result = $get_customers->fetch_assoc()){
                                    $email = $result['email'];
                            ?>
                                <tr>
                                    <td>Tên</td>
                                    <td>:</td>
                                    <td><?php echo $result['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Thành phố</td>
                                    <td>:</td>
                                    <td><?php echo $result['city'] ?></td>
                                </tr>
                                <tr>
                                    <td>SĐT</td>
                                    <td>:</td>
                                    <td><?php echo $result['phone'] ?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Quốc gia</td>
                                    <td>:</td>
                                    <td><?php echo $result['country'] ?></td>
                                </tr> -->
                                <!-- <tr>
                                    <td>Zipcode</td>
                                    <td>:</td>
                                    <td><?php echo $result['zipcode'] ?></td>
                                </tr> -->
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?php echo $result['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>:</td>
                                    <td><?php echo $result['address'] ?></td>
                                </tr>
                                <!-- <tr >
                                    <td colspan="3"><a href="editprofile.php" class="btn" >Cập nhật thông tin</a></td> 
                                </tr> -->
                
                                <?php
                                    }
                                }
                                ?>
                            </table>
                    </div>
                    <table>
                        <tr>
                            <th>Tạm tính: </th>
                                <td><?php 

                                    echo $fm->format_currency($subtotal).' '.'VNĐ' ;
                                    Session::set('sum',$subtotal);
                                    Session::set('qty',$qty);
                                ?></td>
                        </tr>
                        <tr>
                            <th>VAT: </th>
                                <td>5% (<?php echo $fm->format_currency($vat = $subtotal * 0.05).' '.'VNĐ'; ?>)</td>
                        </tr>
                        <tr>
                            <th>Tổng tiền:</th>
                                <td><?php 

                                $vat = $subtotal * 0.05;
                                $gtotal = $subtotal + $vat;
                                echo $fm->format_currency($gtotal).' '.'VNĐ' ;
                                ?></td>
                        </tr>
                       

                    </table>
                    <?php
                    }else{
                        echo "<span class='cart'>Giỏ của bạn trống! Hãy mua sắm ngay bây giờ</span>";
                    }
                    ?>
                    <style type="text/css">
                        .cart{
                            font-size: 18px;
                            color: red;
                            text-align: center;
                            margin: auto;
                            text-transform: none;
                        }
                    </style>
                    <div class="title">
                        <form method="post">
                            <input type="hidden" name="productNames" value="<?= implode(",",$productNames) ?>"/>
                            <input type="hidden" name="productNames1" value="<?= implode(",",$productNames1) ?>"/>
                            <input type="hidden" name="productNames2" value="<?= implode(",",$productNames2) ?>"/>
                            <input type="hidden" name="productNames3" value="<?= implode(",",$productNames3) ?>"/>
                            <input type="hidden" name="email" value="<?= $email ?>"/>
                            <button name="order" class="btn">Đặt hàng ngay</button>
                        </form>
                        
                    </div>
                </div>
               
            </div>
        </div>
<?php
   include 'inc/footer.php';
?>
</div>
<style type="text/css">
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
h2{
    font-size: 22px;

}
td{
    font-size: 18px;
    text-transform: none;
}
th{
    font-size: 18px;
    text-transform: none;
}
a {
    text-decoration: none;
}

li {
    list-style: none;
}

h1,
h2 {
    color: #0984e3;
}

h3 {
    color: #999;
}

.btn1 {
    background: #f05462;
    color: white;
    padding: 5px 10px;
    text-align: center;
}

.btn1:hover {
    color: #f05462;
    background: white;
    padding: 3px 8px;
    border: 2px solid #f05462;
}

.title {
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding: 15px 10px;
    border-bottom: 2px solid #999;
}

table {
    padding: 10px;
}

th,
td {
    text-align: left;
    padding: 8px;
}

.side-menu {
    position: fixed;
    background: #f05462;
    width: 20vw;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.side-menu .brand-name {
    height: 10vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.side-menu li {
    font-size: 24px;
    padding: 10px 40px;
    color: white;
    display: flex;
    align-items: center;
}

.side-menu li:hover {
    background: white;
    color: #f05462;
}

.container-new {
    position: absolute;
    right: 0;
    width: 100vw;
    height: 100vh;

}

.container-new .header {
    position: fixed;
    top: 0;
    right: 0;
    width: 80vw;
    height: 10vh;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.container-new .header .nav {
    width: 90%;
    display: flex;
    align-items: center;
}

.container-new .header .nav .search {
    flex: 3;
    display: flex;
    justify-content: center;
}

.container-new .header .nav .search input[type=text] {
    border: none;
    background: #f1f1f1;
    padding: 10px;
    width: 50%;
}

.container-new .header .nav .search button {
    width: 40px;
    height: 40px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.container-new .header .nav .search button img {
    width: 30px;
    height: 30px;
}

.container-new .header .nav .user {
    flex: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.container-new .header .nav .user img {
    width: 40px;
    height: 40px;
}

.container-new .header .nav .user .img-case {
    position: relative;
    width: 50px;
    height: 50px;
}

.container-new .header .nav .user .img-case img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.container-new .content-new {
    position: relative;
    margin-top: 5vh;
    min-height: 80vh;
    background: #f1f1f1;
}

.container-new .content-new .cards {
    padding: 20px 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

.container-new .content-new .cards .card {
    width: 250px;
    height: 150px;
    background: white;
    margin: 20px 10px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.container-new .content-new .content-new2 {
    min-height: 60vh;
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
    flex-wrap: wrap;
}

.container-new .content-new .content-new2 .recent-payments {
    min-height: 50vh;
    flex: 5;
    background: white;
    margin: 0 25px 25px 25px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    display: flex;
    flex-direction: column;
}

.container-new .content-new .content-new2 .new-students {
    flex: 2;
    background: white;
    min-height: 50vh;
    margin: 0 25px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    display: flex;
    flex-direction: column;
}

.container-new .content-new .content-new2 .new-students table td:nth-child(1) img {
    height: 40px;
    width: 40px;
}

@media screen and (max-width: 1050px) {
    .side-menu li {
        font-size: 18px;
    }
}

@media screen and (max-width: 940px) {
    .side-menu li span {
        display: none;
    }
    .side-menu {
        align-items: center;
    }
    .side-menu li img {
        width: 40px;
        height: 40px;
    }
    .side-menu li:hover {
        background: #f05462;
        padding: 8px 38px;
        border: 2px solid white;
    }
}

@media screen and (max-width:536px) {
    .brand-name h1 {
        font-size: 16px;
    }
    .container-new .content-new .cards {
        justify-content: center;
    }
    .side-menu li img {
        width: 30px;
        height: 30px;
    }
    .container-new .content-new .content-new2 .recent-payments table th:nth-child(2),
    .container-new .content-new .content-new2 .recent-payments table td:nth-child(2) {
        display: none;
    }
}

</style>



