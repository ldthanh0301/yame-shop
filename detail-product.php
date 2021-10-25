<?php 
    if($_GET['id']) {
        require_once './database/database.php';
        $id =$_GET['id'];
        $db = Database::getInstance();
        $con = $db->connectDB;
        //lấy loai hàng hóa
        $result = $con->query("SELECT * FROM `hanghoa`as hh JOIN hinhhanghoa as hhh ON hh.MSHH = hhh.MSHH where hh.MSHH = $id");// 
        $product =$result->fetch_assoc();
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
        <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="product-review">
                            <img class="img-fluid" src="./products-img/<?php echo $product['TenHinh']?>" alt="Ảnh review">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-info">
                            <h1 class="product-info__title"><?php echo $product["TenHH"]?></h1>
                            <hr>
                            <div class="product-info__price">
                                <h6>Giá sản phẩm</h6>
                                <span><?php echo $product['Gia']?></span>
                                <span>Đ</span>
                            </div>
                            <hr>
                            <div class="product-info__quantity">
                                <h6>Số lượng còn lại</h6>
                                <span><?php echo $product['SoLuongHang']?></span>
                                <span>cái</span>
                            </div>
                            <hr>
                            <div class="product-info__desription">
                                <h6>Mô tả sản phẩm</h6>
                                <?php echo $product['MoTa']?>
                            </div>
                            <hr>
                            <div class="product-info__control">
                                <button class="btn btn-secondary">Thêm vào giỏ hàng</button>
                                <a href="./payment.php?id=<?php echo $product['MSHH']?>" class="btn btn-primary">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
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