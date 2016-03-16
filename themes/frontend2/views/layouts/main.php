
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
        <script>

//            if (typeof (EventSource) !== "undefined") {
//                // var timestamp = getCurrentTimestamp();
//                var source = new EventSource("<?php echo Yii::app()->createUrl('notification/getNotification') ?>");
//                source.onmessage = function (event) {
//                    //  document.getElementById("response").innerHTML += event.data + "<br>";
//                    //  var cloned = $('#message-right').clone().show();
//                    //   console.log(event.data);
//                    var response = JSON.parse(event.data);
//                    $('#message_list').prepend('<div class="row">' +
//                            '<li style="float: left; ; background-color: #EDEFED;">' +
//                            '<div class="comment_info">' +
//                            'Gửi bởi <a href="#">' + response.username + '</a><span>|</span> ' + response.date + ' <span>' +
//                            '</div>' +
//                            '<div class="avatar" ><a href="#"><img src="' + response.avatar + '" alt="" style="height:68px; width:68px;"></a></div>' +
//                            '<div class="comment_right clearfix">' +
//                            '<p>' +
//                            response.data +
//                            '</p>' +
//                            '</div>' +
//                            '</li>' +
//                            '</div>');
//                    $('#response').prepend(event.data);
//
//                    // $('#message_left').clone().prependTo('#message_list');
//                };
//            } else {
//                alert("Xin lỗi, trình duyệt của bạn không hỗ trợ chức năng chat của chúng tôi. Bạn vui lòng sử dụng Chrome hoặc Firefox thay thế !");
//            }
        </script>

    </head>
    <body>
        <!-- SITE HEADER -->
        <header id="site-header" class="site-header">
            <div class="qh-container">
                <div class="left-side">
                    <h1 class="main-logo"><a href="<?php echo Yii::app()->createUrl('home/newsFeed') ?>" class="bg-cover" style="background-image: url('http://placehold.it/40x40');">Fitme</a></h1>
                    <div class="main-nav">
                        <ul class="list">
                            <li class="active"><a href="<?php echo Yii::app()->createUrl('home/newsFeed') ?>">Bảng tin</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('rank/rankPostByTime', array('time' => 'DAY')) ?>">Phổ biến</a></li>
                            <li><a href="#">Chuyên mục <i class="fa fa-angle-down"></i></a>
                                <ul class="inner-list category-list">
                                    <li><a href="<?php echo Yii::app()->createUrl('category/index', array('type' => 3)) ?>">Thời trang nữ</a></li>
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
                        <form action="<?php echo Yii::app()->createUrl('search/searchPostWeb') ?>" method="GET" class="header-search-form">
                            <input name="query" type="text" class="search-input" placeholder="Tìm kiếm ảnh, album hoặc mọi người ...">
                            <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="action-nav">
                        <ul class="list">
                            <li class="upload-open-btn"><a href="#" id="upload-post" title="Tải ảnh lên" data-toggle="modal" data-target="#uploadNewPostModal" data-url="<?php echo Yii::app()->createUrl('post/upload') ?>">
                                    <i class="fa fa-cloud-upload"></i>
                                </a></li>
                            <li class="notifi-open-btn">
                                <div class="dropdown notifi-header-list open">
                                    <button class="notifi-open-btn-drd" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-bell"></i>
                                        <span class="notifi-badge">9</span>
                                    </button>
                                    <ul class="dropdown-menu user-option-list pull-right z-depth-0">
                                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 380px;"><div class="user-option-list-inner" style="overflow: hidden; width: auto; height: 380px;">
                                                <li class="notifi-item unread">
                                                    <a href="#" class="notifi-link">
                                                        <div class="content">Đây là unread notifi. Vince Gill - "Peaceful Easy Feeling" (Glenn Frey Tribute)</div>
                                                        <div class="info">
                                                            <span class="date">23/02/2016</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="notifi-item">
                                                    <a href="#" class="notifi-link">
                                                        <div class="content">Đây là default notifi. Không phải ai cũng biết người Thái Lan là chủ sở hữu đội Leicester, đang dẫn đầu giải Premier League.</div>
                                                        <div class="info">
                                                            <span class="date">23/02/2016</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="notifi-item">
                                                    <a href="#" class="notifi-link">
                                                        <div class="image bg-cover" style="background-image: url('assets/stock/avatar.jpg');"></div>
                                                        <div class="content"><b>Vichai Srivadd</b> thích bài đăng của bạn: "Bộ này hơi bị mát, chất liệu làm từ ..." .</div>
                                                        <div class="info">
                                                            <span class="icon"><i class="fa fa-heart notifi-like"></i></span>
                                                            <span class="date">23/02/2016</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="notifi-item">
                                                    <a href="#" class="notifi-link">
                                                        <div class="image bg-cover" style="background-image: url('assets/stock/avatar.jpg');"></div>
                                                        <div class="content"><b>Nguyễn Hoàng Thảo</b> bình luận trong bài đăng của bạn: "Bộ này hơi bị mát, chất liệu làm từ ..." .</div>
                                                        <div class="info">
                                                            <span class="icon"><i class="fa fa-comment notifi-comment"></i></span>
                                                            <span class="date">23/02/2016</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="notifi-item">
                                                    <a href="#" class="notifi-link">
                                                        <div class="image bg-cover" style="background-image: url('assets/stock/avatar.jpg');"></div>
                                                        <div class="content"><b>Hoàng Lê Trung</b> theo dõi bạn.</div>
                                                        <div class="info">
                                                            <span class="icon"><i class="fa fa-user-plus notifi-follower-add"></i></span>
                                                            <span class="date">23/02/2016</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="notifi-item notifi-following-post">
                                                    <a href="#" class="notifi-link">
                                                        <div class="image bg-cover" style="background-image: url('assets/stock/avatar.jpg');"></div>
                                                        <div class="content"><b>Lê Trà My</b> có 2 bài đăng mới.</div>
                                                        <div class="info">
                                                            <span class="icon"><i class="fa fa-picture-o notifi-following-post"></i></span>
                                                            <span class="date">23/02/2016</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <div class="loading-icon text-center"><i class="fa fa-spinner fa-spin fa-lg"></i></div>
                                            </div><div class="slimScrollBar" style="width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 315.974px; background: rgb(158, 158, 158);"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                                        <div class="view-all"><a href="#">Xem tất cả</a></div>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="login-btn">
                            <a href="#" class="facebook-login-btn qh-btn qh-btn-icon left-icon qh-btn-facebook qh-btn-md"><i class="fa fa-facebook"></i> Đăng nhập với Facebook</a>
                    </div> -->
                    <div class="user-nav">
                        <ul class="list">
                            <li class="user-profile-link">
                                <a href="<?php echo Yii::app()->createUrl('user/profile') ?>">
                                    <div class="user-avatar bg-cover" style="background-image: url('<?php echo Yii::app()->session['user_avatar'] ?>');"></div>
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