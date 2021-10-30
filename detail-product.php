<?php 
    if($_GET['id']) {
        require_once './models/Product.php';
        $id = $_GET['id'];
        $Product = new Product();
        $product =$Product->detail($id);
        $images = $Product->getImages($id);
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
                            <img class="img-fluid" src="./products-img/<?php echo $images[0]['TenHinh']?>" alt="Ảnh review">
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
                                <button onclick="confirmOrder('<?php echo $product['MSHH']?>')" class="btn btn-primary">Mua ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" style='z-index:100000' id="confirmOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                        <!-- form xóa xác nhận xóa sản phẩm -->
                        <form action="" method="POST" id="formConfirm" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Đặt hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                   Tạo tài khoảng để  thuận tiện hơn cho viêc mua hàng.
                                </div>
                                <div class="modal-footer" style="place-content: space-between;">
                                    <div>
                                        <a href="./register.php" class="btn btn-white">Đăng ký</a>
                                        <a href="./login.php" class="btn btn-success">Đăng nhập</a>
                                    </div>
                                    <div>
                                        <button class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                        <a href="./order.php?id=<?php echo $product['MSHH']?>"class="btn btn-primary">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script>
        var formConfirm = document.getElementById('formConfirm');
        function confirmOrder(id) {
            console.log(id);
            $('#confirmOrder').modal({
                show:true
            })
            formConfirm.onsubmit = function(e) {
                let deleteId = e.target.elements.deleteId;
                deleteId.value = id
            };
        }
    </script>
</body>
</html>