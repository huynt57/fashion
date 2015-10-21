<div class="df-container title-card with-title-and-menu">
    <div class="intro-text">
        <h2 class="intro-title">Bảng xếp hạng</h2>
        <p class="intro-des">What did I do, what did i say? </p>
    </div>
    <div class="menu-section">
        <div class="main-menu-section">
            <ul>
                <li class="active"><a href="#">Ngày</a></li>
                <li><a href="#">Tuần</a></li>
                <li><a href="#">Tháng</a></li>
                <li><a href="#">Năm</a></li>
            </ul>
        </div>
    </div>
</div>


<div class="cards-display-main">
    <div class="df-container">
        <div class="cards-display-main-ctn">
            <div class="card-sizer"></div>

            <?php foreach ($data as $item): ?>
                <!-- normal upload card with 1 image -->
                <div class="card-item card-hide">
                    <div class="card-item-inner">
                        <div class="post-image card-image has-one-image">
                            <a href="single.html .lightbox-post" data-featherlight="ajax">
                                <img src="<?php echo $item->photo?>" class="img-fullwidth">
                            </a>
                        </div>
                        <div class="post-header card-header">
                            <div class="header-avatar">
                                <a href=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/avatar7.jpg" alt="" width="40" height="40"></a>
                            </div>
                            <div class="header-info">
                                <h4 class="name">
                                    <span class="name-original"><a href="">Summer Dreamz</a></span>
                                </h4>
                                <p class="time">4 giờ trước</p>
                            </div>
                            <div class="header-menu">
                                <div class="dropdown">
                                    <a id="post-header-menu" class="post-header-menu" href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-angle-down fa-lg"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right" aria-labelledby="post-header-menu">
                                        <li><a href="#">Ẩn bài đăng này</a></li>
                                        <li><a href="#">Ẩn bài từ Summer Dreamz</a></li>
                                        <li><a href="" data-toggle="modal" data-target="#post-report-modal">Báo cáo sai phạm</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="post-content card-content">
                            <div class="content-main">
                                <p class="desc">Lightbox ở Report và share</p>
                                <p class="cats">
                                    <span><a href="">Áo nam</a></span>
                                    <span><a href="">Phụ kiện nam</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="post-footer card-footer">
                            <div class="footer-count">
                                <span class="item-count"><a href="">9999 thích</a></span>
                                <span class="item-count"><a href="">123 bình luận</a></span>
                            </div>
                            <div class="footer-action">
                                <ul class="icon-container">
                                    <li class="like-icon"><a href="" title="Thích"><i class="fa fa-star"></i></a></li>
                                    <li class="pin-icon"><a href="" title="Đánh dấu" data-toggle="modal" data-target="#post-pin-modal"><i class="fa fa-thumb-tack"></i></a></li>
                                    <li class="comment-icon"><a href="" title="Bình luận"><i class="fa fa-comment"></i></a></li>
                                    <li class="share-icon"><a href="" title="Chia sẻ" data-toggle="modal" data-target="#post-share-modal"><i class="fa fa-share"></i></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php $this->renderPartial('modal'); ?>

<div style="display: none;">
    <?php
    $this->widget('CLinkPager', array(
        'pages' => $pages,
        'maxButtonCount' => 1,
        'htmlOptions' => array('class' => 'pagination',
        ),
        'header' => '',
        'prevPageLabel' => 'Trước',
        'nextPageLabel' => 'Sau',
        'firstPageLabel' => 'Đầu tiên',
        'lastPageLabel' => 'Cuối cùng',
        'selectedPageCssClass' => 'active',
            )
    )
    ?>
</div>

<script>

    function hide_post(post_id)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('post/hidePostForUser') ?>',
            type: 'POST',
            data: {'user_block': '<?php echo Yii::app()->session['user_id'] ?>', 'post_id': post_id},
            success: function (response) {
                console.log(response);
            }
        });

    }

    function block_user(user_blocked, post_id)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('user/blockUser') ?>',
            type: 'POST',
            data: {'user_block': '<?php echo Yii::app()->session['user_id'] ?>', 'post_id': post_id, 'user_blocked': user_blocked},
            success: function (response) {
                console.log(response);
            }
        });
    }

    function report(post_id)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('post/reportPost') ?>',
            type: 'POST',
            data: '',
            success: function (response) {
                console.log(response);
            }
        });
    }

</script>

<script>
//    $(function () {
//
//        var $container = $('#container');
//
//        try {
//            $container.infinitescroll({
//                navSelector: '.next', // selector for the paged navigation 
//                nextSelector: '.next a', // selector for the NEXT link (to page 2)
//                itemSelector: '.card-item', // selector for all items you'll retrieve
//                loading: {
//                    finishedMsg: 'No more pages to load.',
//                    img: 'http://i.imgur.com/6RMhx.gif'
//                }
//            },
//            // trigger Masonry as a callback
//            function (newElements) {
//                // hide new items while they are loading
//                var $newElems = $(newElements).css({opacity: 0});
//                // ensure that images load before adding to masonry layout
//                $newElems.imagesLoaded(function () {
//                    // show elems now they're ready
//                    $newElems.animate({opacity: 1});
//                    $container.masonry('appended', $newElems, true);
//                });
//            }
//            );
//        } catch (exception) {
//            console.log(exception);
//        }
//
//
//    });
</script>