<div class="single-post-page">
    <div class="single-post lightbox-post">

        <div class="single-post-container">
            <div class="single-post-image">
                <!-- image here -->
                <div id="post-images-carousel" class="carousel fade" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($data['images'] as $key => $image): ?>
                            <div class="item <?php if ($key == 0): ?>active<?php endif; ?>">
                                <span class="helper-align"></span><img src="<?php echo StringHelper::generateUrlImage($image['img_url']) ?>" alt="...">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="carousel-navigation">
                        <a class="cn-prev" href="#post-images-carousel" role="button" data-slide="prev">
                            <i class="fa fa-angle-left fa-2x"></i>
                        </a>
                        <ul class="carousel-indicators">
                            <?php foreach ($data['images'] as $key => $image): ?>
                                <li data-target="#post-images-carousel" data-slide-to="<?php echo $key ?>" <?php if ($key == 0): ?>class="active"<?php endif; ?>>
                                    <img src="<?php echo StringHelper::generateUrlImage($image['img_url']) ?>" alt="" style="height: 100%; width: 100%;">
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
                        <a href=""><img src="<?php echo StringHelper::generateUrlImage($data['user'][0]['photo']) ?>" alt="" width="40" height="40"></a>
                    </div>
                    <div class="header-info">
                        <h4 class="name">
                            <span class="name-original"><a href=""><?php echo $data['user'][0]['username'] ?></a></span>
                        </h4>
                        <p class="time"><?php echo Util::time_elapsed_string($data['created_at']) ?></p>
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

                            <?php foreach ($data['cat'] as $cat): ?>
                                <span><a href="<?php echo Yii::app()->createUrl('category/detailCategory', array('cat_id' => $cat[1])) ?>"><?php echo $cat[0] ?></a></span>
                            <?php endforeach; ?>
                        </p>
                    </div>
                </div>
                <div class="post-footer single-post-footer">
                    <div class="footer-count">
                        <span class="item-count"><a href="" id="post_like_count"><span id='post_like_cnt'><?php echo $data['post_like_count'] ?></span> thích</a></span>
                        <span class="item-count"><a href="" id="post_view_count"><span id='post_view_cnt'><?php echo $data['post_view_count'] ?></span> lượt xem</a></span>
                        <span class="item-count"><a href="" id="post_comment_count"><span id='post_cmt_cnt'><?php echo $data['post_comment_count'] ?></span> bình luận</a></span>
<!--                        <span class="item-count"><a href="">1234 chia sẻ</a></span>-->
                    </div>
                    <div class="footer-action">
                        <ul class="icon-container">
                            <li class="like-icon <?php if ($data['is_liked']): ?>active<?php endif; ?>" id="like-<?php echo $data['post_id'] ?>"><a href="javascript: void(0)" onclick="like(<?php echo $data['user_id'] ?>, <?php echo $data['post_id'] ?>)"title="Thích"><i class="fa fa-star"></i></a></li>
                            <li class="pin-icon <?php if ($data['is_bookmarked']): ?>active<?php endif; ?>" id="bookmark-<?php echo $data['post_id'] ?>"><a href="javascript: void(0)" onclick="bookmark(<?php echo $data['post_id'] ?>)"title="Đánh dấu"><i class="fa fa-thumb-tack"></i></a></li>

                            <li class="share-icon"><a href="javascript: void(0)" onclick="share('<?php echo Yii::app()->createAbsoluteUrl('post/viewPost', array('post_id' => $data['post_id'])) ?>')" title="Chia sẻ" data-toggle="modal" data-target="#post-share-modal"><i class="fa fa-share"></i></a></li>
                        </ul>
                    </div>

                </div>
                <div class="post-comment single-post-comment">
                    <div class="enter-comment-form clearfix">
                        <div class="avatar">
                            <img src="<?php echo Yii::app()->session['user_avatar'] ?>" alt="" width="40" height="40">
                        </div>
                        <form id="form_comment" action="javascript::void(0)">
                            <textarea name="comment_content" id="comment_content"></textarea>
                            <input name="user_id" type="hidden" value="<?php echo Yii::app()->session['user_id'] ?>" />
                            <input name="post_id" type="hidden" value="<?php echo $data['post_id'] ?>" />
                            <button type="submit">Gửi bình luận</button>
                            <img style="display: none" id="ajax-loader"src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/ajax-loader.gif">
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
                                        <span class="time"><?php echo Util::time_elapsed_string($comment['created_at']) ?></span>
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
<?php $this->renderPartial('modal') ?>

<script>

    $(document).ready(function () {
        $('#ajax-loader').hide();
        $(document).on('submit', '#form_comment', function (event) {
            event.preventDefault();
            var form = $('#form_comment');
            var data = form.serialize();
            $.ajax({
                beforeSend: function (xhr) {
                    $('#ajax-loader').show();
                },
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl('comment/add') ?>',
                data: data,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('#ajax-loader').hide();
                    $('#comment_content').val('');
                    var post_cmt_cnt = parseInt($('#post_cmt_cnt').text());
                    $('#post_cmt_cnt').text(post_cmt_cnt + 1);
                    if (response.status === 1)
                    {
                        $('#comment-list').prepend('<li class="comment-item clearfix">' +
                                '<div class="avatar">' +
                                '<img src="' + response.data.photo + '" alt="" width="40" height="40">' +
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

<script>

    function hide_post(post_id)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('post/hidePostForUser') ?>',
            type: 'POST',
            data: {'user_block': '<?php echo Yii::app()->session['user_id'] ?>', 'post_id': post_id},
            dataType: 'json',
            success: function (response) {
                if (response.status === 1)
                {
                    $.toast('Ẩn bài viết thành công !!');
                    $('#' + post_id).hide();
                } else {
                    $.toast('Có lỗi xảy ra, vui lòng thử lại sau !!');
                    $('#' + post_id).hide();
                }
            }
        });

    }

    function block_user(user_blocked, post_id)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('user/blockUser') ?>',
            type: 'POST',
            data: {'user_block': '<?php echo Yii::app()->session['user_id'] ?>', 'post_id': post_id, 'user_blocked': user_blocked},
            dataType: 'json',
            success: function (response) {
                if (response.status === 1)
                {
                    $.toast('Chặn người dùng thành công !!');
                } else {
                    $.toast('Có lỗi xảy ra, vui lòng thử lại sau !!');

                }
            }
        });
    }

    function report(post_id, user_id)
    {
        var btnSubmitReport = $("[name=btnSubmitReport]");
        btnSubmitReport.attr("id", "btnSubmitReport" + post_id);
        $(document).on('click', '#btnSubmitReport' + post_id, function () {
            var from = $('#from').val();
            var type = $('input[name=type]:checked').val();
            var content = $('#upload-des').val();
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('post/reportPost'); ?>',
                data: {post_id: post_id, from: from, type: type, user_id: user_id, content: content},
                type: 'POST',
                success: function (response)
                {
                    //  alert(response.message);
                    //$('#from').val('');
                    $('input[name=type]:checked').val('');
                    $('#upload-des').val('');
                    $('#post-report-modal').modal('hide');
                    if (response.status === 1)
                    {
                        $.toast('Thành công !!');
                    } else {
                        $.toast('Có lỗi xảy ra, vui lòng thử lại sau !!');
                    }
                }
            });
        });
    }

    function like_modal(to, post_id)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('post/likePost') ?>',
            type: 'POST',
            data: {from: '<?php echo Yii::app()->session['user_id'] ?>', post_id: post_id, to: to},
            dataType: 'json',
            success: function (response) {
                if (response.status === 1)
                {
                    var cnt_like = parseInt($('#like-count-' + post_id).text());

                    if ($('#like-' + post_id).hasClass('active'))
                    {
                        $('#like-' + post_id).removeClass('active');
                        $('#like-count-' + post_id).text(cnt_like - 1);
                    } else {
                        $('#like-' + post_id).addClass('active');
                        $('#like-count-' + post_id).text(cnt_like + 1);
                    }
                    successNotifiDisplay({
                        title: 'Thành công !',
                        message: 'Bạn đã thích bài viết này :D'
                    });
                } else {
                    errorNotifiDisplay({title: 'Có lỗi xảy ra !', message: 'Chúng tôi đang trong quá trình khắc phục, bạn vui lòng thử lại sau'});
                }
            }
        });
    }

    function bookmark(post_id)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('wishlist/add') ?>',
            type: 'POST',
            data: {user_id: '<?php echo Yii::app()->session['user_id'] ?>', post_id: post_id},
            dataType: 'json',
            success: function (response) {
                if (response.status === 1)
                {
                    $.toast('Đánh dấu thành công !!');
                } else {
                    $.toast('Có lỗi xảy ra, vui lòng thử lại sau !!');
                }
            }
        });
    }

    function share(url)
    {
        $('#fb-sharer').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url));
        $('#gg-sharer').attr('href', 'https://plus.google.com/share?url=' + encodeURIComponent(url));
        $('#tt-sharer').attr('href', 'http://www.twitter.com/share?url=' + encodeURIComponent(url));
    }
</script>

