<?php foreach ($data as $item): ?>
    <div class="card-single">
        <div class="card-single-inner">
            <div class="c-image">
                <div class="post-image">
                    <a href="" class="post-link" data-toggle="modal" data-target="#singlePostModal">
                        <div class="album-behind-border first-border"></div>
                        <div class="album-behind-border second-border"></div>
                        <div class="album-behind-border third-border"></div>
                        <div class="single-album-image"><img src="<?php $item['image_preview'] ?>" alt=""></div>
                    </a>
                </div>				
            </div>
            <div class="c-body">
                <div class="album-info">
                    <span class="single-info">Album gồm <?php echo $item['number_posts'] ?> bài đăng</span>
                    <span class="single-info"><a href="#">Chỉnh sửa</a></span>
                </div>

                <div class="item-description album-description"><?php $item['description'] ?></div>
            </div>
            <div class="c-header">
                <div class="user-image">
                    <a href="#" class="user-avatar" style="background-image: url('assets/stock/avatar.jpg');"></a>
                </div>
                <div class="user-info">
                    <div class="display-name"><a href="#" class="display-name-link">Nguyễn Hoàng Thảo</a></div>
                    <div class="post-info">
                        <span class="time">Album cập nhật lúc <?php $item['updated_at'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>
