<div class="qh-container">

    <!-- Post Card -->

    <div class="post-cards-wrap clearfix">
        <?php foreach ($data as $item): ?>
            <div class="card-single">
                <div class="card-single-inner">
                    <div class="c-image">
                        <div class="post-image">
                            <a href="" class="post-link" data-toggle="modal" data-target="#singlePostModal" data-href="<?php echo Yii::app()->createUrl('post/view', array('post_id' => $item['post_id'])) ?>" >
                                <img src="<?php echo Images::model()->getImagePreviewByPostId($item['post_id']) ?>" alt="">
                                <?php if(count($item['images']) > 1):?>
                                <span class="more-image">+ <?php echo count($item['images']) - 1?> ảnh</span>
                                <?php endif; ?>
                            </a>
                        </div>				
                    </div>
                    <div class="c-header">
                        <div class="user-image">
                            <a href="<?php echo Yii::app()->createUrl('user/profile', array('ref_web' => 'ref_web', 'user_id' => $item['user_id'])) ?>" class="user-avatar" style="background-image: url('<?php echo $item['user'][0]['photo'] ?>');"></a>
                        </div>
                        <div class="user-info">
                            <div class="display-name"><a href="<?php echo Yii::app()->createUrl('user/profile', array('ref_web' => 'ref_web', 'user_id' => $item['user_id'])) ?>" class="display-name-link"><?php echo $item['user'][0]['username'] ?></a></div>
                            <div class="post-info">
                                <span class="time"><?php echo Util::time_elapsed_string($item['created_at']); ?></span>
                            </div>
                            <div class="dropdown user-option">
                                <button class="user-option-btn" data-toggle="dropdown"><i class="fa fa-angle-down"></i></button>
                                <ul class="dropdown-menu user-option-list pull-right z-depth-2">
                                    <li><a href="#" data-toggle="modal" data-target="#postReportModal">Báo cáo sai phạm</a></li>
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
                        <div class="item-buttons">
                            <a href="" class="post-link single-button item-button-comment" data-toggle="modal" data-target="#singlePostModal" data-href="<?php echo Yii::app()->createUrl('post/view', array('post_id' => $item['post_id'])) ?>" >
                                <span class="icon"><i class="fa fa-comments"></i></span>
                                <span class="count"><?php echo $item['post_comment_count'] ?></span>
                                <a href="#" class="single-button item-button-pin" <?php if ($item['is_bookmarked']): ?>active<?php endif; ?>>
                                    <span class="icon"><i class="fa fa-thumb-tack"></i></span>
    <!--                                    <span class="count">10</span>-->
                                </a>
                                <a href="#" class="single-button item-button-like <?php if ($item['is_liked']): ?>active<?php endif; ?>">
                                    <span class="icon"><i class="fa fa-heart"></i></span>
                                    <span class="count"><?php echo $item['post_like_count'] ?></span>
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

<!-- ========================================================= -->
<!-- Modal, có vài cái template modal ở dưới chưa ghép vào link nào cả (default) -->

<!-- Modal Report -->
<div class="modal fade" id="postReportModal">
    <div class="qh-modal-dialog qh-default-modal z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <h3 class="title"></h3>
        <div class="qh-modal-title">Báo cáo sai phạm</div>
        <div class="qh-modal-content">
            <p>Vì sao bạn nghĩ bài đăng này vi phạm qui định?</p>
            <form action="#" class="qh-form qh-form-normal">
                <div class="qh-form-row">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" checked>
                            Option one is this and that&mdash;be sure to include why it's great
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" checked>
                            Option two is this and that&mdash;be sure to include why it's great
                        </label>
                    </div>
                    <div class="radio disabled">
                        <label>
                            <input type="radio" name="optionsRadios" disabled>
                            Option three is disabled
                        </label>
                    </div>
                </div>
                <div class="qh-form-row">
                    <button class="qh-btn qh-btn-normal">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tks -->
<div class="modal fade" id="postReportThanksModal">
    <div class="qh-modal-dialog qh-default-modal z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <div class="qh-modal-content">
            <p>Cám ơn phản hồi của bạn.</p>
        </div>
    </div>
</div>

<!-- Modal Single Post -->
<div class="modal fade" id="singlePostModal">
    <div class="qh-modal-dialog qh-single-post-section z-depth-2" id="single-post-modal">

    </div>
</div>



<!-- Modal Loading -->
<div class="modal fade" id="modal-loading">
    <div class="qh-modal-dialog qh-loading-modal z-depth-2">
        <div class="loading-spin"><i class="fa fa-circle-o-notch fa-spin fa-3x"></i></div>
    </div>
</div>

<!-- Modal Default -->
<div class="modal fade" id="">
    <div class="qh-modal-dialog qh-default-modal z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <div class="qh-modal-title">But I must explain to you how ...</div>
        <div class="qh-modal-content">
            <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>
            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?</p>
        </div>
    </div>
</div>

<!-- Modal Default Sucess -->
<div class="modal fade" id="">
    <div class="qh-modal-dialog qh-default-modal qh-modal-xs-size z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <div class="qh-modal-content">
            <p>Đăng bài thành công.</p>
        </div>
    </div>
</div>

<?php $this->renderPartial('modal'); ?>



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
                    $cardContainer = $('.cards-display-main-ctn');
                    $cardItem = $('.card-item');
                    $cardContainer.imagesLoaded().done(function () {
                        $cardContainer.masonry({
                            columnWidth: '.card-item',
                            itemSelector: '.card-item',
                            percentPosition: true,
                            transitionDuration: 0
                        });
                    });
                    // $cardContainer.data('masonry')['_reLayout']()
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

    function like(to, post_id)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('post/likePost') ?>',
            type: 'POST',
            data: {from: '<?php echo Yii::app()->session['user_id'] ?>', post_id: post_id, to: to},
            dataType: 'json',
            success: function (response) {
                if (response.status === 1)
                {
                    if ($('#like-' + post_id).hasClass('active'))
                    {
                        $('#like-' + post_id).removeClass('active');
                    } else {
                        $('#like-' + post_id).addClass('active');
                    }
                    $.toast('Đã thích !!');
                } else {
                    $.toast('Có lỗi xảy ra, vui lòng thử lại sau !!');
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
                    if ($('#bookmark-' + post_id).hasClass('active'))
                    {
                        $('#bookmark-' + post_id).removeClass('active');
                    } else {
                        $('#bookmark-' + post_id).addClass('active');
                    }
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




