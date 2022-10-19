<?php
   include 'inc/header.php';
?>
<?php
    
    $login_check = Session::get('customer_login'); 
    if($login_check==false){
        header('Location:login.php');
    }
        
?>
<style>
    h3.payment {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
    }
    .wrapper_method {
    text-align: center;
    width: 550px;
    margin: 0 auto;
    border: 1px solid #666;
    padding: 20px;
    /* margin: 20px; */
    background: cornsilk;
    }
    .wrapper_method a {
    padding: 10px;
  
    background: red;
    color: #fff;
    
    }
    .wrapper_method h3 {
     margin-bottom: 20px;
    }
</style>
<!-- product banner section starts  -->

<section class="product-banner">

    <h1 class="heading"> <span style="text-transform: none;">Chọn phương thức thanh toán</span></h1>

    <div class="box-container">
        <div class="box">
            <img src="images/off.png" alt="">
            <div class="content">
                <span><a style="text-transform:none; color:#0984e3;font-size:18px;font-weight:bold;" href="offlinepayment.php">Thanh toán ngoại tuyến </a></span>
                <h3><a style="color:black;text-transform: none;font-size:17px;" href="cart.php"> Quay về</a></h3>
            </div>
        </div>

        <div class="box">
            <img src="images/on.png" alt="">
            <div class="content">
                <span><a style="text-transform:none; color:#0984e3;font-size:18px;font-weight:bold;" href="onlinepayment.php">Thanh toán online </a></span>
                <h3><a style="color:black;text-transform: none;font-size:17px;" href="cart.php"> Quay về</a></h3>
                
            </div>
        </div>

    </div>
    
</section>

<!-- product banner section ends -->

<?php
   include 'inc/footer.php';
?>
