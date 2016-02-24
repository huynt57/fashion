
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php if (isset($this->pageTitle)): ?>
            <title><?php echo $this->pageTitle ?></title>
        <?php endif; ?>
        <?php if (!isset($this->pageTitle)): ?>
            <title>Template</title>
        <?php endif; ?>
        <!-- Favicon -->
        <!-- <link rel="shortcut icon" href="assets/img/favicon.jpg" type="image/x-icon" /> -->
        <!-- CSS libs -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/font-awesome/css/font-awesome.css">
        <!-- CSS main -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/style.css">
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/jquery.slimscroll.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/masonry.pkgd.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/jquery.infinitescroll.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/bootstrap-notify.min.js"></script>
        <!-- JS main -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/main.js"></script>
    </head>
    <body>
        <!-- SITE HEADER -->
        <header id="site-header" class="site-header">
            <div class="qh-container">
                <div class="left-side">
                    <h1 class="main-logo"><a href="#" class="bg-cover" style="background-image: url('http://placehold.it/40x40');">Fitme</a></h1>
                    <div class="main-nav">
                        <ul class="list">
                            <li class="active"><a href="<?php echo Yii::app()->createUrl('home/newsFeed') ?>">Trang chủ</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('rank/rankPostByTime', array('time' => 'DAY')) ?>">Xếp hạng</a></li>
                            <li><a href="#">Chuyên mục <i class="fa fa-angle-down"></i></a>
                                <ul class="inner-list category-list">
                                    <li><a href="<?php echo Yii::app()->createUrl('category/index', array('type' => 2)) ?>">Thời trang nữ</a></li>
                                    <li><a href="<?php echo Yii::app()->createUrl('category/index', array('type' => 1)) ?>">Thời trang nam</a></li>
                                    <li><a href="<?php echo Yii::app()->createUrl('category/index', array('type' => 0)) ?>">Đồ dùng khác</a></li>
                                </ul>
                                <span class="border-hide"></span>
                            </li>
                            <li><a href="<?php echo Yii::app()->createUrl('recommend/index') ?>">Gợi ý</a></li>
                        </ul>
                    </div>
                </div>
                <div class="right-side">
                    <div class="search-bar">
                        <form action="#" class="header-search-form">
                            <input type="text" class="search-input" placeholder="Tìm kiếm ảnh, album hoặc mọi người ...">
                            <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="action-nav">
                        <ul class="list">
                            <li class="upload-open-btn"><a href="#" id="upload-post" title="Tải ảnh lên" data-toggle="modal" data-target="#uploadNewPostModal" data-url="<?php echo Yii::app()->createUrl('post/upload') ?>">
                                    <i class="fa fa-cloud-upload"></i>
                                </a></li>
                            <li class="notifi-open-btn"><a href="#" title="Thông báo">
                                    <i class="fa fa-bell"></i>
                                    <span class="notifi-badge">9</span>
                                </a></li>
                        </ul>
                    </div>
                    <!-- <div class="login-btn">
                            <a href="#" class="facebook-login-btn qh-btn qh-btn-icon left-icon qh-btn-facebook qh-btn-md"><i class="fa fa-facebook"></i> Đăng nhập với Facebook</a>
                    </div> -->
                    <div class="user-nav">
                        <ul class="list">
                            <li class="user-profile-link">
                                <a href="#">
                                    <!--                                    <div class="user-avatar bg-cover" style="background-image: url('assets/stock/avatar.jpg');"></div>-->
                                    <div class="user-name"><?php echo Yii::app()->session['username'] ?></div>
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-caret-down"></i></a>
                                <ul class="inner-list pull-right">
                                    <li><a href="#">Về FitMe</a></li>
                                    <li><a href="#">Điều khoản</a></li>
                                    <li><a href="#">Bảo mật</a></li>
                                    <li><a href="#">Quảng cáo</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">IOS App</a></li>
                                    <li><a href="#">Android App</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Đăng xuất</a></li>
                                </ul>
                                <span class="border-hide"></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- end SITE HEADER -->


        <div id="site-content" class="site-content">
            <!-- site content here -->
            <?php echo $content ?>
        </div>




        <!-- Modal Upload -->
        <div class="modal fade" id="uploadNewPostModal">


        </div>

    </body>
</html>