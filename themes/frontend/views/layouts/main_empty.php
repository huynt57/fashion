
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Header Menu</title>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/style.css">
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/modernizr.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>

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
                FB.login(function () {
                    FB.api('/me?fields=id,name,first_name, last_name, link, age_range', function (response) {
                        console.log(response);
                        $.ajax({
                            url: '<?php echo Yii::app()->createUrl('user/LoginWithFacebook') ?>',
                            type: 'POST',
                            data: {
                                facebook_id: response.id,
                                //gender: response.gender,
                                name: response.name,
                                email: response.email,
                                //location: response.locale,
                                //  birthday: response.birthday,
                                //photo: response.picture.data.url,
                            },
                            dataType: 'json',
                            success: function (response) {
                                console.log(response);
                                if (response.status === 1)
                                {
                                    window.location = '<?php echo Yii::app()->createAbsoluteUrl('home/newsFeed') ?>';
                                }
                            },
                        });
                    });
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

        <header id="site-header" class="site-header">
            <div class="df-container">
                <div class="left-side">
                    <div class="site-logo">
                        <h1><a href="#">PutLogoHere</a></h1>
                    </div>
                    <nav class="top-nav">
                        <ul class="top-nav-ctn">
                            <li class="top-nav-explore">
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
                </div><!-- right-side -->
                <div class="clearfix"></div>
            </div>
        </header>



        <!-- site content here -->
        <?php echo $content ?>





        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.iframe-transport"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/masonry.pkgd.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/featherlight.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/main.js"></script>

    </body>
</html>