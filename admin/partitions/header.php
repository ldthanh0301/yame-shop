<div id="header">
            <a href="#" class="header_brand">
                <span>
                    <img class="img-fluid" src="../assets/img/logo/logo-admin.png" alt="ảnh">
                </span>
            </a>
            <div class="header-main">
                <div class="header-main__wrapper">
                    <div class="header-search">
                        <input class="header-search__input" type="text" placeholder="Search">
                        <button class="btn header-search__btn"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="dropdown mr-4">
                    <div class="header-main__user dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="header-main__user__img" style="background-image: url(../assets/img/products/vuong/hinh1.jpg);"></div>
                        <span class="header-main__user_name"><?php echo $_SESSION['HoTenNV']?></span>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Thông tin tài khoản</a>
                        <hr>
                        <a class="dropdown-item" href="#">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>