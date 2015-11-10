<div class="user-profile-page">

    <div class="user-header">
        <div class="cover-photo" style="background-image: url('<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/cover1.jpg')">
            <div class="cover-gradient"></div>
            <div class="cover-content">
                <div class="df-container">
                    <div class="cover-content-inner">
                        <div class="avatar">
                            <img src="<?php echo Yii::app()->session['user_avatar']?>" height="128" width="128" alt="">
                        </div>
                        <div class="info">
                            <h1 class="name"><?php echo $profile->username?></h1>
                            <div class="about">
                                <p class="about-text">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you.</p>
                                <p class="about-link">
<!--                                    <span class="location"><i class="fa fa-map-marker"></i><?php //echo $profile->location ?></span>-->
                                    <!-- <span class="website"><i class="fa fa-globe"></i><a href="">www.juliagabriel.com</a></span> -->
                                    <span class="social">
                                        <a href=""><i class="fa fa-facebook-square"></i></a>
                                        <a href=""><i class="fa fa-twitter-square"></i></a>
                                        <a href=""><i class="fa fa-tumblr-square"></i></a>
                                        <a href=""><i class="fa fa-instagram"></i></a>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="user-meta clearfix">
                            <p>
                                <span class="meta-count"><?php echo count($posts) ?> Bài đăng</span>
<!--                                <span class="meta-count">344 Album</span>-->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-section">
            <div class="df-container">
                <div class="main-menu-section">
                    <ul>
                        <li class="active"><a href="#">
                                <i class="fa fa-home icon-on-small"></i>
                                <span class="text-on-large">Tường</span>
                            </a></li>
                        <li><a href="#">
                                <i class="fa fa-cloud-upload icon-on-small"></i>
                                <span class="text-on-large">Bài đăng</span>
                            </a></li>
                        <li><a href="#">
                                <i class="fa fa-picture-o icon-on-small"></i>
                                <span class="text-on-large">Album</span>
                            </a></li>
                        <!-- <li><a href="#">
                                <i class="fa fa-thumb-tack icon-on-small"></i>
                                <span class="text-on-large">Đánh dấu</span>
                        </a></li> -->
                    </ul>
                </div>
                <div class="other-menu-section">
                    <ul>
                        <li id="user-other-menu" class="dropdown">
                            <a href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-angle-down fa-lg"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" aria-labelledby="user-other-menu">
                                <li><a href="#">Sửa thông tin</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <?php $this->renderPartial('listpost', array('data' => $posts)); ?>
            </div>
        </div>
    </div>

</div>
