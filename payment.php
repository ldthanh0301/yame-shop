<?php 
    require_once './database/database.php';
    $db = Database::getInstance();
    $con = $db->connectDB;
    if($_GET['id']) {
        $id=$_GET['id'];
        $product = getProduct ($id, $con);
    }
    if($_SERVER['REQUEST_METHOD'] ==='POST') {
        $isSuccess = true;
        $MSHH= $_POST['MSHH'];
        $fullname= $_POST['fullname'];
        $address= $_POST['address'];
        $phoneNumber= $_POST['phone-number'];
        $email= $_POST['email'];
        $quantity = $_POST['quantity'];
        $total = $_POST['total'];

        // thêm khách hàng
        $query = "INSERT INTO `khachhang`(`HoTenKH`, `SoDienThoai`, `Email`) VALUES ('$fullname','$phoneNumber','$email')";
        $result = $con->query($query);
        if (!$result) {
            $isSuccess= false;
        }else {
            $MSKH = $con->insert_id;

            $query = "INSERT INTO `diachikh`(`DiaChi`, `MSKH`) VALUES ('$address',$MSKH)";
            $result = $con->query($query);

            // thêm vào bảng đơn hàng
            $query = "INSERT INTO `dathang`(`MSKH`) VALUES ($MSKH)";
            $result = $con->query($query);
            $SoDH = $con->insert_id;

            // thêm vào bảng chi tiết đơn hàng
            $query = "INSERT INTO `chitietdathang`(`SoDonDH`,`MSHH`,`SoLuong`,`GiaDatHang`) VALUES ($SoDH, $MSHH, $quantity,$total)";
            $result = $con->query($query);

            // thêm vào bảng chi tiết đơn hàng
            if(!$result ) {
                $isSuccess = false;
            } 

        }
        // lấy chi tiết sản phẩm
        $product = getProduct($id, $con);
        
    }
    function getProduct ($id, $con) {
        //lấy loai hàng hóa
        $result = $con->query("SELECT * FROM `hanghoa`as hh JOIN hinhhanghoa as hhh ON hh.MSHH = hhh.MSHH where hh.MSHH = $id");// 
        $product =$result->fetch_assoc();
        return $product;
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
                        if (isset($isSuccess) && !$isSuccess) {
                            echo '<h6 class="notify--danger">Lỗi khi đặt hàng!!!!</h6>';
                        }
                        if (isset($isSuccess) && $isSuccess) {
                            echo '<h6 class="notify--success">Đặt hàng thành công!!!!</h6>';
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
                                        <img style='width:100px' src="./products-img/<?php echo $product['TenHinh']?>" alt="Ảnh review">
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