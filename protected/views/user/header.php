<div class="qh-user-page-header z-depth-1">
    <?php if (empty($profile->cover)): ?>
        <div class="image-cover bg-cover" style="background-image: url('<?php echo Yii::app()->theme->baseUrl; ?>/assets/stock/cover1.jpg');">
        <?php else: ?>
            <div class="image-cover bg-cover" style="background-image: url('<?php echo Yii::app()->request->getBaseUrl(true) . '/' . $profile->cover ?>');">
            <?php endif; ?>
            <div class="cover-gradient"></div>
            <div class="user-info">
                <div class="avatar" style="background-image: url('<?php echo StringHelper::generateUrlImage($profile->photo) ?>');"></div>
                <div class="username"><?php echo $profile->username ?></div>
                <?php if (empty($profile->description)): ?>
                    <div class="description">24 | HCMC | Fashionista | Vegatarian | Love Cats</div>
                <?php else: ?>
                    <div class="description"><?php echo $profile->description; ?></div>
                <?php endif; ?>
                <?php if ($profile->id != Yii::app()->session['user_id']): ?>
                    <?php if ($is_followed == FALSE): ?>
                        <div class="user-follow-btn" id="div-follow">
                            <button class="qh-btn qh-btn-normal qh-btn-sm qh-btn-icon left-icon" id="follow" onclick="follow()"><i class="fa fa-user"></i>Theo dõi</button>
                            <!-- <button class="qh-btn qh-btn-normal qh-btn-sm qh-btn-icon left-icon"><i class="fa fa-check"></i>Đang theo dõi</button> -->
                        </div>
                    <?php endif; ?>
                    <?php if ($is_followed == TRUE): ?>
                        <div class="user-follow-btn" id="div-follow">
                            <button class="qh-btn qh-btn-normal qh-btn-sm qh-btn-icon left-icon" id="unfollow" onclick="unfollow()"><i class="fa fa-user"></i>Bỏ theo dõi</button>
                            <!-- <button class="qh-btn qh-btn-normal qh-btn-sm qh-btn-icon left-icon"><i class="fa fa-check"></i>Đang theo dõi</button> -->
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="user-page-nav">
            <ul class="list">
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('user/profile') ?>">Bài đăng</a></li>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('user/wishlist') ?>">Đánh dấu</a></li>
                <?php if ($profile->id == Yii::app()->session['user_id']): ?>
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('user/editProfile') ?>">Thông tin</a></li>
                <?php endif; ?>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('user/getAlbum', array('user_id' => $profile->id)) ?>">Albums</a></li>
            </ul>
        </div>
    </div>
    <script>
        $('document').ready(function () {
            var url = window.location.href;
            $('a[href="' + url + '"]').parent().addClass('active');
        });

        function follow()
        {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('user/follow') ?>',
                type: 'POST',
                data: {user_follow: '<?php echo Yii::app()->session['user_id'] ?>', user_followed: '<?php echo $profile->id ?>', type: 'USER'},
                dataType: 'json',
                success: function (response) {
                    if (response.status === 1)
                    {
                        $('#div-follow').html('<button class="qh-btn qh-btn-normal qh-btn-sm qh-btn-icon left-icon" id="unfollow" onclick="unfollow()"><i class="fa fa-user"></i>Bỏ theo dõi</button>');
                        successNotifiDisplay({
                            title: 'Thành công !',
                            message: 'Từ giờ bạn sẽ theo dõi người dùng này !'
                        });
                    } else {
                        errorNotifiDisplay({title: 'Có lỗi xảy ra !', message: 'Chúng tôi đang trong quá trình khắc phục, bạn vui lòng thử lại sau'});
                    }
                }
            });
        }

        function unfollow()
        {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('user/unfollow') ?>',
                type: 'POST',
                data: {user_follow: '<?php echo Yii::app()->session['user_id'] ?>', user_followed: '<?php echo $profile->id ?>', type: 'USER'},
                dataType: 'json',
                success: function (response) {
                    if (response.status === 1)
                    {
                        $('#div-follow').html(' <button class="qh-btn qh-btn-normal qh-btn-sm qh-btn-icon left-icon" id="follow" onclick="follow()"><i class="fa fa-user"></i>Theo dõi</button>');
                        successNotifiDisplay({
                            title: 'Thành công !',
                            message: 'Từ giờ bạn sẽ theo dõi người dùng này !'
                        });
                    } else {
                        errorNotifiDisplay({title: 'Có lỗi xảy ra !', message: 'Chúng tôi đang trong quá trình khắc phục, bạn vui lòng thử lại sau'});
                    }
                }
            });
        }

    </script>