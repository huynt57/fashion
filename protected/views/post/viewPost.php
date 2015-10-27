<div class="single-post-page">
    <div class="single-post lightbox-post">

        <div class="single-post-container">
            <div class="single-post-image">
                <!-- image here -->
                <div id="post-images-carousel" class="carousel fade" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($data['images'] as $image): ?>
                            <div class="item active">
                                <span class="helper-align"></span><img src="<?php echo Yii::app()->request->getBaseUrl(true) . '/' . $image['img_url'] ?>" alt="...">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="carousel-navigation">
                        <a class="cn-prev" href="#post-images-carousel" role="button" data-slide="prev">
                            <i class="fa fa-angle-left fa-2x"></i>
                        </a>
                        <ul class="carousel-indicators">
                            <?php foreach ($data['images'] as $image): ?>
                                <li data-target="#post-images-carousel" data-slide-to="0" class="active">
                                    <img src="<?php echo Yii::app()->request->getBaseUrl(true) . '/' . $image['img_url'] ?>" alt="">
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a class="cn-next" href="#post-images-carousel" role="button" data-slide="next">
                            <i class="fa fa-angle-right fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="single-post-main clearfix">
                <div class="post-header single-post-header">
                    <div class="header-avatar">
                        <a href=""><img src="<?php echo $data['user'][0]['photo'] ?>" alt="" width="40" height="40"></a>
                    </div>
                    <div class="header-info">
                        <h4 class="name">
                            <span class="name-original"><a href=""><?php echo $data['user'][0]['username'] ?></a></span>
                        </h4>
                        <p class="time"><?php echo $data['created_at'] ?></p>
                    </div>
                    <div class="header-menu">
                        <div class="dropdown">
                            <a id="post-header-menu" class="post-header-menu" href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-angle-down fa-lg"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" aria-labelledby="post-header-menu">
                                <li><a href="#">Ẩn bài đăng này</a></li>
                                <li><a href="#">Ẩn bài từ <?php echo $data['user'][0]['username'] ?></a></li>
                                <li><a href="" onclick="">Báo cáo sai phạm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="post-content single-post-content">
                    <div class="content-main">
                        <p class="desc"><?php echo $data['post_content'] ?></p>
                        <p class="cats">
                            <?php foreach ($data['cat_name'] as $cat): ?>
                                <span><a href=""><?php echo $cat ?></a></span>
                            <?php endforeach; ?>
                        </p>
                    </div>
                </div>
                <div class="post-footer single-post-footer">
                    <div class="footer-count">
                        <span class="item-count"><a href=""><?php echo $data['post_like_count'] ?> thích</a></span>
                        <span class="item-count"><a href=""><?php echo $data['post_view_count'] ?> lượt xem</a></span>
                        <span class="item-count"><a href=""><?php echo $data['post_comment_count'] ?> bình luận</a></span>
<!--                        <span class="item-count"><a href="">1234 chia sẻ</a></span>-->
                    </div>
                    <div class="footer-action">
                        <ul class="icon-container">
                            <li class="like-icon"><a href="" title="Thích"><i class="fa fa-star"></i></a></li>
                            <li class="pin-icon"><a href="" title="Đánh dấu"><i class="fa fa-thumb-tack"></i></a></li>
                            <li class="share-icon"><a href="" title="Chia sẻ"><i class="fa fa-share"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="post-comment single-post-comment">
                    <div class="enter-comment-form clearfix">
                        <div class="avatar">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/avatar1.jpg" alt="" width="40" height="40">
                        </div>
                        <form id="form_comment" action="javascript::void(0)">
                            <textarea name="comment_content" id="comment_content"></textarea>
                            <input name="user_id" type="hidden" value="<?php echo '1'//echo Yii::app()->session['user_id']     ?>" />
                            <input name="post_id" type="hidden" value="<?php echo $data['post_id'] ?>" />
                            <button type="submit">Gửi bình luận</button>
                        </form>
                    </div>
                    <ul class="comment-list" id="comment-list">
                        <?php foreach ($data['comments'] as $comment): ?>
                            <li class="comment-item clearfix">
                                <div class="avatar">
                                    <img src="<?php echo $comment['photo'] ?>" alt="" width="40" height="40">
                                </div>
                                <div class="content">
                                    <div class="content-header">
                                        <a href="" class="name"><?php echo $comment['username'] ?></a>
                                        <span class="time"><?php echo $comment['created_at'] ?></span>
                                    </div>
                                    <div class="content-comment"><?php echo $comment['comment_content'] ?></div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#form_comment').submit(function (event) {
            event.preventDefault();
            var form = $('#form_comment');
            var data = form.serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl('comment/add') ?>',
                data: data,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status === 1)
                    {
                        $('#comment-list').prepend('<li class="comment-item clearfix">' +
                                '<div class="avatar">' +
                                '<img src="'+response.data.photo+'" alt="" width="40" height="40">' +
                                '</div>' +
                                '<div class="content">' +
                                '<div class="content-header">' +
                                '<a href="" class="name">' + response.data.username + '</a>' +
                                '<span class="time">' + response.data.created_at + '</span>' +
                                '</div>' +
                                '<div class="content-comment">' + response.data.comment_content + '</div>' +
                                '</div>' +
                                '</li>');
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            })
        });
    });
</script>
