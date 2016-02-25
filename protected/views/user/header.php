<div class="qh-user-page-header z-depth-1">
    <div class="image-cover bg-cover" style="background-image: url('<?php echo Yii::app()->theme->baseUrl; ?>/assets/stock/cover1.jpg');">
        <div class="cover-gradient"></div>
        <div class="user-info">
            <div class="avatar" style="background-image: url('<?php echo StringHelper::generateUrlImage($profile->photo)?>');"></div>
            <div class="username"><?php echo $profile->username ?></div>
            <div class="description">24 | HCMC | Fashionista | Vegatarian | Love Cats</div>
        </div>
    </div>
    <div class="user-page-nav">
        <ul class="list">
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('user/profile')?>">Bài đăng</a></li>
            <li><a href="#">Yêu thích</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('user/wishlist')?>">Đánh dấu</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('user/editProfile')?>">Thông tin</a></li>
        </ul>
    </div>
</div>
<script>
    $('document').ready(function () {
        var url = window.location.href;
        $('a[href="' + url + '"]').parent().addClass('active');
    });

</script>