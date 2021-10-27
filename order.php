<?php 
    require_once './models/Product.php';
    require_once './models/Customer.php';
    require_once './models/Order.php';
    $Product = new Product();
    $Customer = new Customer();
    $Order = new Order();

    if($_GET['id']) {
        $id = $_GET['id'];
        $product =$Product->detail($id);
        $images = $Product->getImages($id);
    }
    if($_SERVER['REQUEST_METHOD'] ==='POST') {
        $msg = 'Đặt hàng thành công';
        $MSHH= $_POST['MSHH'];
        $fullname= $_POST['fullname'];
        $address= $_POST['address'];
        $phoneNumber= $_POST['phone-number'];
        $email= $_POST['email'];
        $quantity = $_POST['quantity'];
        $total = $_POST['total'];

        $MSKH = $Customer->insert($fullname,$email, $address,$phoneNumber);

        if (!$MSKH) {
            $isSuccess= 'Lỗi khi thêm khách hàng';
        }else {
            $SoDH = $Order->insertOrder($MSKH);
            // thêm vào bảng chi tiết đơn hàng
            if (!$SoDH) {
                $msg = 'Lỗi khi thêm đơn hàng';
            }
            else {
                $result = $Order->insertDetailOrder($SoDH,$MSHH,$quantity,$total);

                if(!$result ) {
                    $msg = 'Lỗi khi thêm chi tiết đơn hàng';
                } 
            }
        }
        // lấy chi tiết sản phẩm
        $product =$Product->detail($MSHH);
        $images = $Product->getImages($MSHH);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yame shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/font/fontawesome-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
</head>
<body>
    <div id="app">
        <!-- header -->
        <?php include_once('./partitions/header.php')?>
        <!-- main -->
        <main id="main">
        <div class="container">
            <form method="POST" action="" id="payment">
                    <?php 
                        if (isset($msg)) {
                            echo "<h6 class='notify--success'>$msg</h6>";
                        }
                    ?>
                <div class="row">
                    <div class="col-6">
                        <div class="product-info">
                            <h3>Thông tin sản phẩm</h3>
                            <div class="product-info__row">
                                <div>
                                    <span>Mã sản phẩm:</span>
                                    <input style="width: 100px;" type='text' value="<?php echo $product["MSHH"]?>" name="MSHH" readonly/>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <img style='width:100px' src="./products-img/<?php echo $images[0]['TenHinh']?>" alt="Ảnh review">
                                    </div>    
                                    <div class="col-6">
                                        <span><?php echo $product["TenHH"]?></span>
                                        
                                        <div class="div">
                                            <span>Số lượng còn lại:</span>
                                            <span><?php echo $product['SoLuongHang']?></span>
                                            <span>cái</span>
                                        </div>
                                        <div>
                                            <span>Giá sản phẩm</span>
                                            <span><?php echo $product['Gia']?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="product-info__quantity">
                                <div class="row">
                                    <div class="col-6">
                                        <h6>Số lượng sản phẩm</h6>
                                            <input class="form-control" name='quantity' type="text" value='1'>
                                    </div>
                                    <div class="col-6">
                                        <h6>Thành tiền</h6>
                                        <span><?php echo $product['Gia']?></span>
                                        <span>Đ</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="product-info_total">
                                <span>Tổng tiền:</span>
                                <div>
                                    <input style="border:none;min-width:100px;" type="number" name='total' readonly value="540000"/>
                                    <span>Đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="user-info">
                            <h3 >Thông tin đặt hàng</h3>
                            <div class="form-group">
                                <label for="fullname">Họ và tên:</label>
                                <input id="fullname" class="form-control" type="text" name="fullname">
                            </div>
                            <div class="form-group">
                                <label for="phone-number">Số điện thoại:</label>
                                <input id="phone-number" class="form-control" type="text" name="phone-number">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ giao hàng</label>
                                <input id="address" class="form-control" type="text" name="address">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input id="email" class="form-control" type="text" name="email">
                            </div>
                            <input type="button" class="btn btn-danger" value="Hủy">
                            <input type="submit" class="btn btn-primary" value="Đặt hàng">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </main>
        <!-- Footer -->
        <?php include_once('./partitions/footer.php')?>
    </div>
    <!-- Boostrap Script -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>