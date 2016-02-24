<div class="qh-user-page-header z-depth-1">
    <div class="image-cover bg-cover" style="background-image: url('<?php echo Yii::app()->theme->baseUrl; ?>/assets/stock/cover1.jpg');">
        <div class="cover-gradient"></div>
        <div class="user-info">
            <div class="avatar" style="background-image: url('<?php echo StringHelper::generateUrlImage($profile->celeb_image)?>');"></div>
            <div class="username"><?php echo $profile->celeb_name ?></div>
            <div class="description">24 | HCMC | Fashionista | Vegatarian | Love Cats</div>
        </div>
    </div>
    <div class="user-page-nav">
        <ul class="list">
            <li class="active"><a href="#">Bài đăng</a></li>
            <li><a href="#">Yêu thích</a></li>
            <li><a href="#">Đánh dấu</a></li>
            <li><a href="#">Thông tin</a></li>
        </ul>
    </div>
</div>