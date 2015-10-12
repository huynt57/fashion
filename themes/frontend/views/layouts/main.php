
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Header Menu</title>
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/style.css">
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/modernizr.js"></script>
</head>
<body>

	<header id="site-header" class="site-header">
		<div class="df-container">
			<div class="left-side">
				<div class="site-logo">
					<h1><a href="#">PutLogoHere</a></h1>
				</div>
				<nav class="top-nav">
					<ul class="top-nav-ctn">
						<li class="top-nav-explore active">
							<a href="#">
								<i class="fa fa-compass fa-lg icon-on-small"></i>
								<span class="text-on-large">Khám phá</span>
							</a>
						</li>
						<li class="top-nav-category dropdown">
							<a id="top-nav-category" href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-list-ul fa-lg icon-on-small"></i>
								<span class="text-on-large">Chuyên mục</span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" aria-labelledby="top-nav-category">
						    <li><a href="#">Thời trang nữ</a></li>
						    <li><a href="#">Thời trang nam</a></li>
						    <li><a href="">Dịch vụ thời trang</a></li>
						    <li><a href="">Mỹ phẩm - Sức khỏe</a></li>
						  </ul>
						</li>
					</ul>
				</nav>
			</div><!-- left-side -->
			<div class="right-side">
				<div class="search-form">
					<form action="#">
						<input type="text" placeholder="Ảnh, album hoặc mọi người ...">
				    <button type="submit"><i class="fa fa-search fa-lg"></i></button>
					</form>
				</div>
				<div class="tools-nav">
					<ul class="tools-nav-ctn">
						<li class="upload-icon">
							<a href="upload.html .upload-container" data-featherlight="ajax"><i class="fa fa-cloud-upload"></i></a>
						</li>
						<li class="notify-icon dropdown">
							<a id="notify-nav-list" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notify-count">45</span>
							</a>
							<ul class="dropdown-menu pull-right" aria-labelledby="notify-nav-list">
								<div class="notify-nav-header">
									<h3 class="notify-nav-title">
										<span class="text-title">Thông báo</span>
										<a href="#" class="view-all">Xem tất cả</a>
									</h3>
								</div>
								<div class="notify-nav-body">
									<li class="notify-item item-unread">
										<a href="">
											<span class="avatar">
							    			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/avatar2.jpg" alt="altdemo" width="36" height="36">
							    		</span>
							    		<span class="descr">
							    			<span class="des-text">
							    				<b>Michael Buble</b> thích bài đăng của bạn: "Chỉ cần diện những chiếc áo sơ mi đơn giản ..."</span>
							    			<span class="des-time">3 ngày trước</span>
							    		</span>
							    	</a>
									</li>
									<li class="notify-item">
										<a href="">
											<span class="avatar">
							    			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/avatar6.jpg" alt="altdemo" width="36" height="36">
							    		</span>
							    		<span class="descr">
							    			<span class="des-text">
							    				<b>Thu Trang</b> và 2346 người khác thích bài đăng của bạn: "Chỉ cần diện những chiếc áo sơ mi đơn giản ..."</span>
							    			<span class="des-time">3 ngày trước</span>
							    		</span>
							    	</a>
									</li>
									<li class="notify-item">
										<a href="">
											<span class="avatar">
							    			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/avatar6.jpg" alt="altdemo" width="36" height="36">
							    		</span>
							    		<span class="descr">
							    			<span class="des-text">
							    				<b>Thu Trang</b> và 2346 người khác thích bài đăng của bạn: "Chỉ cần diện những chiếc áo sơ mi đơn giản ..."</span>
							    			<span class="des-time">43 ngày trước</span>
							    		</span>
							    	</a>
									</li>
									<li class="notify-item">
										<a href="">
											<span class="avatar">
							    			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/avatar6.jpg" alt="altdemo" width="36" height="36">
							    		</span>
							    		<span class="descr">
							    			<span class="des-text">
							    				<b>Thu Trang</b> và 2346 người khác thích album <b>Thu về trong gió</b> của bạn</span>
							    			<span class="des-time">463 ngày trước</span>
							    		</span>
							    	</a>
									</li>
								</div>
						  </ul>
						</li>
						<li class="account-icon">
							<a href=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/avatar5.jpg" alt="theFabulousName" width="33" height="33"></a>
						</li>
						<li class="other-icon dropdown">
							<a id="other-nav-menu" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-angle-down fa-lg"></i>
							</a>
							<ul class="dropdown-menu pull-right" aria-labelledby="other-nav-menu">
						    <li><a href=""><i class="fa fa-apple"></i>iOS App</a></li>
						    <li><a href=""><i class="fa fa-android"></i>Android App</a></li>
						    <li class="divider"></li>
						    <li><a href="">Về chúng tôi</a></li>
						    <li><a href="">Điều khoản</a></li>
								<li><a href="">Hướng dẫn</a></li>
						    <li><a href="">Trợ giúp</a></li>
						    <li><a href="">Báo lỗi</a></li>
						    <li class="divider"></li>
						    <li><a href="">Đăng xuất</a></li>
						  </ul>
						</li>
					</ul>
				</div>
			</div><!-- right-side -->
			<div class="clearfix"></div>
		</div>
	</header>

	<div id="site-content" class="site-content">
		<!-- site content here -->
                <?php echo $content?>
	</div>



	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/masonry.pkgd.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/featherlight.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/main.js"></script>

</body>
</html>