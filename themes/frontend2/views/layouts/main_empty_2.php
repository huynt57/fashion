
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
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/libs/jscroll.js"></script>

        <!-- JS main -->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/main.js"></script>
        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '<?php echo Yii::app()->params['fb_app_id'] ?>',
                    xfbml: true,
                    version: 'v2.5'
                });
            };

            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));



// Only works after `FB.init` is called
            function myFacebookLogin() {
                FB.login(function (response) {
                    if (response.authResponse) {
                        FB.api('/me?fields=id,name, email,  picture, first_name, last_name, link, age_range', function (response) {
                            console.log(response);
                            $.ajax({
                                url: '<?php echo Yii::app()->createUrl('user/LoginWithFacebook') ?>',
                                type: 'POST',
                                data: {
                                    facebook_id: response.id,
                                    gender: response.gender,
                                    name: response.name,
                                    email: response.email,
                                    location: response.locale,
                                    birthday: response.birthday,
                                    photo: 'https://graph.facebook.com/' + response.id + '/picture?type=large',
                                },
                                dataType: 'json',
                                success: function (response) {
                                    //console.log(response);
                                    if (response.status === 1)
                                    {
                                        window.location = '<?php echo Yii::app()->createAbsoluteUrl('home/newsFeed') ?>';
                                    }
                                },
                            });
                        });
                    }
                }, {scope: 'public_profile, email'});
            }

            function myFacebookLogout() {
                FB.logout(function (response) {
                    // user is now logged out
                });
            }
        </script>
    </head>
    <body>
        <div class="sign-in-page bg-cover">

            <div class="sign-in-page-inner">
                <header id="site-header" class="site-header">
                    <div class="qh-container">
                        <div class="left-side">
                            <h1 class="main-logo"><a href="<?php echo Yii::app()->createUrl('home/explore')?>" class="bg-cover" style="background-image: url('<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logo.png');">Fitme</a></h1>
                            <div class="main-nav">
                                <ul class="list">
                                   
                                    <li><a href="<?php echo Yii::app()->createUrl('home/explore')?>">Khám phá</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="right-side">
                           
                            <div class="user-nav">
                                <ul class="list">
                                    <!-- <li class="user-profile-link">
                                            <a href="#">
                                                    <div class="user-avatar bg-cover" style="background-image: url('assets/stock/avatar.jpg');"></div>
                                                    <div class="user-name">Thanh Nga</div>
                                            </a>
                                    </li> -->
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
                                        
                                        </ul>
                                        <span class="border-hide"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>	

                <?php echo $content ?>
            </div>

        </div>

    </body>
</html>