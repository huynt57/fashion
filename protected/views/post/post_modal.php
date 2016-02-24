
<button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>


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
                    <a href="#" class="user-avatar" style="background-image: url('<?php echo $data['user'][0]['photo'] ?>');"></a>
                </div>
                <div class="user-info">
                    <div class="display-name"><a href="#" class="display-name-link"><?php echo $data['user'][0]['username'] ?></a></div>
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
                                <div class="avatar" style="background-image: url('<?php echo $comment['photo'] ?>');"></div>
                                <div class="user-name"><a href="#"><?php echo $comment['username'] ?></a></div>
                                <div class="time"><?php echo Util::time_elapsed_string($comment['created_at']) ?></div>
                                <div class="content"><?php echo $comment['comment_content'] ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function comment()
    {
        //event.preventDefault();
        var form = $('#form_comment');
        var post_id = form.find($('#post-id'));
        var data = form.serialize();
        $.ajax({
            beforeSend: function (xhr) {
                $('#loading-comment').show();
            },
            type: 'POST',
            url: '<?php echo Yii::app()->createUrl('comment/add') ?>',
            data: data,
            dataType: 'json',
            success: function (response) {
                //console.log(response);
                $('#loading-comment').hide();
                $('#comment_content').val('');

                if (response.status === 1)
                {
                    var cnt_like_modal = parseInt($('#comment-count-modal-' + post_id.val()).text());
                    var cnt_like = parseInt($('#comment-count-' + post_id.val()).text());

                    $('#comment-count-modal-' + post_id.val()).text(cnt_like_modal + 1);
                    $('#comment-count-' + post_id.val()).text(cnt_like + 1);
                    $('#list-comment').prepend('<li class="single-comment">' +
                            '<div class="avatar" style="background-image: url(' + response.data.photo + ');"></div>' +
                            '<div class="user-name"><a href="#">' + response.data.username + '</a></div>' +
                            '<div class="time">' + response.data.created_at + '</div>' +
                            '<div class="content">' + response.data.comment_content + '</div>' +
                            '</li>');
                }
            },
            error: function (response) {
                console.log(response);
            }
        })
    }
</script>

<script>
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
                    var cnt_like = parseInt($('#like-count-modal-' + post_id).text());
                    if ($('#like-' + post_id).hasClass('active'))
                    {
                        $('#like-' + post_id).removeClass('active');
                        $('#like-modal-' + post_id).removeClass('active');
                        $('#like-count-' + post_id).text(cnt_like - 1);
                        $('#like-count-modal-' + post_id).text(cnt_like - 1);
                    } else {
                        $('#like-' + post_id).addClass('active');
                        $('#like-modal-' + post_id).addClass('active');
                        $('#like-count-' + post_id).text(cnt_like + 1);
                        $('#like-count-modal-' + post_id).text(cnt_like + 1);
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
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('wishlist/add') ?>',
            type: 'POST',
            data: {user_id: '<?php echo Yii::app()->session['user_id'] ?>', post_id: post_id},
            dataType: 'json',
            success: function (response) {
                if (response.status === 1)
                {
                    if ($('#bookmark-modal-' + post_id).hasClass('active'))
                    {
                        $('#bookmark-' + post_id).removeClass('active')
                        $('#bookmark-modal-' + post_id).removeClass('active');
                    } else {
                        $('#bookmark-modal-' + post_id).addClass('active');
                        $('#bookmark-' + post_id).addClass('active');
                    }
                    successNotifiDisplay({
                        title: 'Thành công !',
                        message: 'Bạn đã đánh dấu bài viết này :D'
                    });
                } else {
                    errorNotifiDisplay({title: 'Có lỗi xảy ra !', message: 'Chúng tôi đang trong quá trình khắc phục, bạn vui lòng thử lại sau'});
                }
            }
        });
    }
</script>




