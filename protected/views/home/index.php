<div class="qh-container">

    <!-- Post Card -->

    <div class="post-cards-wrap clearfix">
        <?php foreach ($data as $item): ?>
            <div class="card-single" id="<?php echo $item['post_id'] ?>">
                <div class="card-single-inner">
                    <div class="c-image">
                        <div class="post-image">
                            <a href="" class="post-link" data-toggle="modal" data-target="#singlePostModal" data-href="<?php echo Yii::app()->createUrl('post/view', array('post_id' => $item['post_id'])) ?>" >
                                <img src="<?php echo Images::model()->getImagePreviewByPostId($item['post_id']) ?>" alt="">
                                <?php if (count($item['images']) > 1): ?>
                                    <span class="more-image">+ <?php echo count($item['images']) - 1 ?> ảnh</span>
                                <?php endif; ?>
                            </a>
                        </div>				
                    </div>
                    <div class="c-header">
                        <div class="user-image">
                            <?php if (!empty($item['user_id'])): ?>
                            <a href="<?php echo Yii::app()->createUrl('user/profile', array('ref_web' => 'ref_web', 'user_id' => $item['user_id'])) ?>" class="user-avatar" style="background-image: url('<?php echo StringHelper::generateUrlImage($item['user'][0]['photo']) ?>');"></a>
                            <?php endif; ?>
                            <?php if (!empty($item['celeb_id'])): ?>
                                <a href="<?php echo Yii::app()->createUrl('user/profileCeleb', array('ref_web' => 'ref_web', 'celeb_id' => $item['celeb_id'])) ?>" class="user-avatar" style="background-image: url('<?php echo '/' . $item['photo_celeb'] ?>');"></a>
                            <?php endif; ?>
                        </div>
                        <div class="user-info">
                            <?php if (!empty($item['user_id'])): ?>
                                <div class="display-name"><a href="<?php echo Yii::app()->createUrl('user/profile', array('ref_web' => 'ref_web', 'user_id' => $item['user_id'])) ?>" class="display-name-link"><?php echo $item['user'][0]['username'] ?></a></div>
                            <?php endif; ?>
                            <?php if (!empty($item['celeb_id'])): ?>
                                <div class="display-name"><a href="<?php echo Yii::app()->createUrl('user/profileCeleb', array('ref_web' => 'ref_web', 'celeb_id' => $item['celeb_id'])) ?>" class="display-name-link"><?php echo $item['username_celeb'] ?></a></div>
                            <?php endif; ?>

                            <div class="post-info">
                                <span class="time"><?php echo Util::time_elapsed_string($item['created_at']); ?></span>
                            </div>
                            <div class="dropdown user-option">
                                <button class="user-option-btn" data-toggle="dropdown"><i class="fa fa-angle-down"></i></button>
                                <ul class="dropdown-menu user-option-list pull-right z-depth-2">
                                    <li><a href="#" data-toggle="modal" data-target="#post-report-modal" onclick="report(<?php echo $item['post_id'] ?>, <?php echo $item['user_id'] ?>)">Báo cáo sai phạm</a></li>
                                    <li><a href="#"  onclick="hide_post(<?php echo $item['post_id'] ?>)">Ẩn bài đăng này từ <?php echo $item['user'][0]['username'] ?></a></li>
                                    <?php if (!empty($item['user_id'])): ?>
                                        <li><a href="#" onclick="block_user(<?php echo $item['user_id'] ?>, <?php echo $item['post_id'] ?>, 'USER')" >Chặn <?php echo $item['user'][0]['username'] ?></a></li>
                                    <?php endif; ?>
                                    <?php if (!empty($item['celeb_id'])): ?>
                                        <li><a href="#" onclick="block_user(<?php echo $item['user_id'] ?>, <?php echo $item['post_id'] ?>, 'CELEB')" >Chặn <?php echo $item['user'][0]['username'] ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="c-body">
                        <div class="item-description"><?php echo $item['post_content'] ?></div>
                        <div class="item-categories">
                            <?php foreach ($item['cat'] as $cat): ?>
                                <a class="single-category" href="<?php echo Yii::app()->createUrl('category/detailCategory', array('cat_id' => $cat[1])) ?>"><?php echo $cat[0] ?></a>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="c-footer">
                        <div class="item-buttons left">
                            <a href="#" class="single-button item-button-comment" data-toggle="modal" data-target="#postShareSocialModal" onclick="share('<?php echo Yii::app()->createAbsoluteUrl('post/viewPost', array('post_id' => $item['post_id'])) ?>')">
                                <span class="icon"><i class="fa fa-share-square-o"></i></span>
                            </a>
                        </div>
                        <div class="item-buttons right">
                            <a href="" class="post-link single-button item-button-comment" data-toggle="modal" data-target="#singlePostModal" data-href="<?php echo Yii::app()->createUrl('post/view', array('post_id' => $item['post_id'])) ?>" >
                                <span class="icon"><i class="fa fa-comments"></i></span>
                                <span class="count" id="comment-count-<?php echo $item['post_id'] ?>"><?php echo $item['post_comment_count'] ?></span>
                                <a href="javascript: void(0)" id="bookmark-<?php echo $item['post_id'] ?>" data-toggle="modal" data-target="#postPinToAlbumModal" class="single-button item-button-pin <?php if ($item['is_bookmarked']): ?>active<?php endif; ?>" onclick="bookmark(<?php echo $item['post_id'] ?>)">
                                    <span class="icon"><i class="fa fa-thumb-tack"></i></span>
    <!--                                    <span class="count">10</span>-->
                                </a>
                                <?php if (!empty($item['user_id'])): ?>
                                    <a href="javascript: void(0)" id="like-<?php echo $item['post_id'] ?>" class="single-button item-button-like <?php if ($item['is_liked']): ?>active<?php endif; ?>" onclick="like(<?php echo $item['user_id'] ?>, <?php echo $item['post_id'] ?>, 'USER')">
                                    <?php endif; ?>
                                    <?php if (!empty($item['celeb_id'])): ?>
                                        <a href="javascript: void(0)" id="like-<?php echo $item['post_id'] ?>" class="single-button item-button-like <?php if ($item['is_liked']): ?>active<?php endif; ?>" onclick="like(<?php echo $item['celeb_id'] ?>, <?php echo $item['post_id'] ?>, 'CELEB')">
                                        <?php endif; ?>
                                        <span class="icon"><i class="fa fa-heart"></i></span>
                                        <span class="count" id="like-count-<?php echo $item['post_id'] ?>"><?php echo $item['post_like_count'] ?></span>
                                    </a>
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
        'maxButtonCount' => 1,
        'htmlOptions' => array('class' => 'msr-pagination',
        ),
        'header' => '',
        'prevPageLabel' => '',
        'nextPageLabel' => 'Loading ...',
        'firstPageLabel' => '',
        'lastPageLabel' => '',
        'selectedPageCssClass' => 'active',
            )
    )
    ?>
    <div class="msr-loading"></div>
</div>

<!-- end SITE CONTENT -->

<?php $this->renderPartial('modal'); ?>



<script>

    function hide_post(post_id)
    {
        $('#hidePostFromUserModal').modal('show');

        $('#submitHidePost').click(function () {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('post/hidePostForUser') ?>',
                beforeSend: function (xhr)
                {
                    $('#hidePostFromUserModal').modal('hide');
                },
                type: 'POST',
                data: {'user_block': '<?php echo Yii::app()->session['user_id'] ?>', 'post_id': post_id},
                dataType: 'json',
                success: function (response) {
                    if (response.status === 1)
                    {

                        $('#' + post_id).hide();
                        var masonry_selector = '.post-cards-wrap';
                        var masonry_item_selector = '.card-single';

                        // Initialize Masonry.
                        var $masonry = $(masonry_selector)
                                .masonry({
                                    itemSelector: masonry_item_selector
                                });
                        successNotifiDisplay({
                            title: 'Thành công !',
                            message: 'Ẩn bài viết thành công'
                        });

                        // $cardContainer.data('masonry')['_reLayout']()
                    } else {
                        errorNotifiDisplay({title: 'Có lỗi xảy ra !', message: 'Chúng tôi đang trong quá trình khắc phục, bạn vui lòng thử lại sau'});
                        $('#' + post_id).hide();
                    }
                }
            });
        });
    }

    function block_user(user_blocked, post_id, type)
    {
        $('#blockUserFromPostModal').modal('show');
        $('#submitBlockUser').click(function () {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('user/blockUser') ?>',
                type: 'POST',
                beforeSend: function (xhr) {
                    $('#blockUserFromPostModal').modal('hide');
                },
                data: {'user_block': '<?php echo Yii::app()->session['user_id'] ?>', 'post_id': post_id, 'user_blocked': user_blocked, 'type': type},
                dataType: 'json',
                success: function (response) {
                    if (response.status === 1)
                    {
                        successNotifiDisplay({
                            title: 'Thành công !',
                            message: 'Bạn đã chặn người dùng này'
                        });

                    } else {
                        errorNotifiDisplay({title: 'Có lỗi xảy ra !', message: 'Chúng tôi đang trong quá trình khắc phục, bạn vui lòng thử lại sau'});

                    }
                }
            });
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
                        successNotifiDisplay({
                            title: 'Thành công !',
                            message: 'Bạn đã báo cáo thành công'
                        });
                    } else {
                        errorNotifiDisplay({title: 'Có lỗi xảy ra !', message: 'Chúng tôi đang trong quá trình khắc phục, bạn vui lòng thử lại sau'});
                    }
                }
            });
        });
    }

    function like(to, post_id, type)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('post/likePost') ?>',
            type: 'POST',
            data: {from: '<?php echo Yii::app()->session['user_id'] ?>', post_id: post_id, to: to, type: type},
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
<script>
    $(document).on('click', '.post-link', function () {
        //alert('123');
        var url = $(this).attr('data-href');
        $.ajax({
            url: url,
            beforeSend: function (xhr) {
                $('#single-post-modal').empty();
                $('#single-post-modal').html('<img id="loading" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/loading.gif" alt="" style="' +
                        'display: block;' +
                        'margin: 0 auto;' +
                        'margin-top: 15%;' +
                        '">');

            },
            success: function (response)
            {
                //  $('#loading').hide();
                $('#single-post-modal').html(response);
                $('.qh-single-post-section .card-single-inner').slimScroll({
                    height: '470px',
                    size: '5px',
                    color: '#9E9E9E',
                    position: 'right'
                });
            }
        });
    });

    $(document).ready(function () {
        $(document).on('submit', '#formAddAlbum', function (event) {
            event.preventDefault();
            var form = $('#formAddAlbum');
            var data = form.serialize();
            $.ajax({
                beforeSend: function (xhr) {
                    $('#ajax-loader').show();
                },
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl('user/addAlbum') ?>',
                data: data,
                success: function (response) {
                    $('#ajax-loader').hide();
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo Yii::app()->createUrl('post/getAlbumByUser') ?>',
                        success: function (response)
                        {
                            $('#listAlbums').html(response);
                            $('#addNewAlbumModal').modal('hide');
                            successNotifiDisplay({
                                title: 'Thành công !',
                                message: 'Thêm album thành công'
                            });
                        },
                        error: function (response)
                        {
                            $('#addNewAlbumModal').hide();
                            errorNotifiDisplay({title: 'Có lỗi xảy ra !', message: 'Chúng tôi đang trong quá trình khắc phục, bạn vui lòng thử lại sau'});
                        }
                    });
                }
            });
        });

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




