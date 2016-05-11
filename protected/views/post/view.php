<div class="qh-container">

    <div class="single-post-page">
        <!-- Modal Single Post -->
        <div class="">
            <div class="qh-single-post-section z-depth-1">
                <div class="post-image-view">
                    <div id="singlePostImageCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php foreach ($data['images'] as $key => $image): ?>
                                <li data-target="#singlePostImageCarousel" data-slide-to="<?php echo $key ?>" style="background-image: url('<?php echo StringHelper::generateUrlImage($image['img_url']) ?>');" class="<?php if ($key == 0): ?>active<?php endif; ?>"></li>
                            <?php endforeach; ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php foreach ($data['images'] as $key => $image): ?>
                                <div class="item <?php if ($key == 0): ?>active<?php endif; ?>">
                                    <img src="<?php echo StringHelper::generateUrlImage($image['img_url']) ?>" alt="...">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Controls -->
                        <a class="left qh-carousel-control" href="#singlePostImageCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left fa-lg"></i></a>
                        <a class="right qh-carousel-control" href="#singlePostImageCarousel" role="button" data-slide="next"><i class="fa fa-angle-right fa-lg"></i></a>

                    </div>
                </div>
                <div class="post-info-view">
                    <div class="card-single">
                        <div class="card-single-inner">
                            <div class="c-header">
                                <div class="user-image">
                                    <?php if (!empty($data['user_id'])): ?>
                                        <a href="<?php echo Yii::app()->createUrl('user/profile', array('ref_web' => 'ref_web', 'user_id' => $data['user_id'])) ?>" class="user-avatar" style="background-image: url('<?php echo $data['user'][0]['photo'] ?>');"></a>
                                    <?php endif; ?>
                                    <?php if (!empty($data['celeb_id'])): ?>
                                        <a href="<?php echo Yii::app()->createUrl('user/profileCeleb', array('ref_web' => 'ref_web', 'celeb_id' => $data['celeb_id'])) ?>" class="user-avatar" style="background-image: url('<?php echo '/' . $data['photo_celeb'] ?>');"></a>
                                    <?php endif; ?>
                                </div>
                                <div class="user-info">
                                    <?php if (!empty($data['user_id'])): ?>
                                        <div class="display-name"><a href="<?php echo Yii::app()->createUrl('user/profile', array('ref_web' => 'ref_web', 'user_id' => $data['user_id'])) ?>" class="display-name-link"><?php echo $data['user'][0]['username'] ?></a></div>
                                    <?php endif; ?>
                                    <?php if (!empty($data['celeb_id'])): ?>
                                        <div class="display-name"><a href="<?php echo Yii::app()->createUrl('user/profileCeleb', array('ref_web' => 'ref_web', 'celeb_id' => $data['celeb_id'])) ?>" class="display-name-link"><?php echo $data['username_celeb'] ?></a></div>
                                    <?php endif; ?>
                                    <div class="post-info">
                                        <span class="time"><?php echo Util::time_elapsed_string($data['created_at']) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="c-body">
                                <div class="item-description"><?php echo $data['post_content'] ?></div>
                                <div class="item-categories">
                                    <?php foreach ($data['cat'] as $cat): ?>
                                        <a class="single-category" href="<?php echo Yii::app()->createUrl('category/detailCategory', array('cat_id' => $cat[1])) ?>"><?php echo $cat[0] ?></a>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <?php if(!empty(Yii::app()->session['user_id'])):?>
                            <div class="c-footer">
                                <div class="item-buttons">
                                    <a href="" class="post-link single-button item-button-comment" data-toggle="modal" data-target="#singlePostModal" data-href="<?php echo Yii::app()->createUrl('post/view', array('post_id' => $data['post_id'])) ?>" >
                                        <span class="icon"><i class="fa fa-comments"></i></span>
                                        <span class="count" id="comment-count-modal-<?php echo $data['post_id'] ?>"><?php echo $data['post_comment_count'] ?></span>
                                        <a id="bookmark-modal-<?php echo $data['post_id'] ?>" href="javascript::void(0)" class="single-button item-button-pin <?php if ($data['is_bookmarked']): ?>active<?php endif; ?>" onclick="bookmark_modal(<?php echo $data['post_id'] ?>)">
                                            <span class="icon"><i class="fa fa-thumb-tack"></i></span>
                <!--                                    <span class="count">10</span>-->
                                        </a>
                                        <a id="like-modal-<?php echo $data['post_id'] ?>" href="javascript::void(0)" onclick="like_modal(<?php echo Yii::app()->session['user_id'] ?>, <?php echo $data['post_id'] ?>)" class="single-button item-button-like <?php if ($data['is_liked']): ?>active<?php endif; ?>">
                                            <span class="icon"><i class="fa fa-heart"></i></span>
                                            <span class="count" id="like-count-modal-<?php echo $data['post_id'] ?>"><?php echo $data['post_like_count'] ?></span>
                                        </a>
                                    </a>
                                </div>
                            </div>
                            <div class="c-comments">
                                <form action="javascript::void(0)" class="comment-post-form" id="form_comment">
                                    <textarea class="comment-post-input-area" rows="2" placeholder="Viết bình luận" name="comment_content" id="comment_content"></textarea>
                                    <div class="text-right">
                                        <input name="user_id" type="hidden" value="<?php echo Yii::app()->session['user_id'] ?>" />
                                        <input id="post-id" name="post_id" type="hidden" value="<?php echo $data['post_id'] ?>" />
                                        <span class="loading" id="loading-comment" style="display: none"><i class="fa fa-spinner fa-pulse"></i></span>
                                        <button type="button" class="comment-post-submit qh-btn qh-btn-red600 qh-btn-sm" id="submit-comment" onclick="comment()">Đăng</button>
                                    </div>
                                </form>
                                <div class="comment-list">
                                    <ul class="list" id="list-comment">
                                        <?php foreach ($data['comments'] as $comment): ?>
                                            <li class="single-comment">
                                                <div class="avatar" style="background-image: url('<?php echo StringHelper::generateUrlImage($comment['photo']) ?>');"></div>
                                                <div class="user-name"><a href="<?php echo Yii::app()->createUrl('user/profile', array('user_id' => $comment['created_by'], 'ref_web' => 'ref_web')) ?>"><?php echo $comment['username'] ?></a></div>
                                                <div class="time"><?php echo Util::time_elapsed_string($comment['created_at']) ?></div>
                                                <?php echo $comment['created_at'];?>
                                                <div class="content"><?php echo $comment['comment_content'] ?></div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

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

    function report_modal(post_id, user_id)
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

    function bookmark_modal(post_id)
    {
        $('#post_id_pin').val(post_id);
        $('#user_id_pin').val('<?php echo Yii::app()->session['user_id'] ?>');

        $('#btnPinPost').attr('id', 'btnPinPost' + post_id);

        $(document).on('click', '#btnPinPost' + post_id, function (e) {
            var form = $('#formPinPost');
            var data = form.serialize();
            e.preventDefault();
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('wishlist/add') ?>',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 1)
                    {
                        if ($('#bookmark-' + post_id).hasClass('active'))
                        {
                            $('#bookmark-' + post_id).removeClass('active');
                        } else {
                            $('#bookmark-' + post_id).addClass('active');
                        }
                        $('#postPinToAlbumModal').modal('hide');
                        successNotifiDisplay({
                            title: 'Thành công !',
                            message: 'Bạn đã đánh dấu bài viết này :D'
                        });
                    } else {
                        $('#postPinToAlbumModal').modal('hide');
                        errorNotifiDisplay({title: 'Có lỗi xảy ra !', message: 'Chúng tôi đang trong quá trình khắc phục, bạn vui lòng thử lại sau'});
                    }
                }
            });
        });
    }

    function share(url)
    {
        $('#fb-sharer').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url));
        $('#gg-sharer').attr('href', 'https://plus.google.com/share?url=' + encodeURIComponent(url));
        $('#tt-sharer').attr('href', 'http://www.twitter.com/share?url=' + encodeURIComponent(url));
    }
</script>

