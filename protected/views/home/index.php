<div class="cards-display-main">
    <div class="df-container" id="container">
        <div class="cards-display-main-ctn">
            <div class="card-sizer"></div>
            <?php foreach ($data as $item): ?>
                <div class="card-item card-hide">
                    <div class="card-item-inner">
                        <div class="post-image card-image <?php echo StringHelper::returnClassForMultipleImages(count($item['images'])) ?>">
                            <a href="<?php echo Yii::app()->createUrl('post/viewPost', array('post_id' => $item['post_id'])); ?> .lightbox-post" data-featherlight="ajax">
                                <?php foreach ($item['images'] as $image): ?>
                                                                                                                                            <!--                                    <span style="background-image: url('<?php //echo Yii::app()->request->getBaseUrl(true) . '/' . $image['img_url']                                  ?>');"></span>-->
                                    <img src="<?php echo Yii::app()->request->getBaseUrl(true) . '/' . $image['img_url'] ?>" class="img-fullwidth">

                                <?php endforeach; ?>
                            </a>
                        </div>
                        <div class="post-header card-header">
                            <div class="header-avatar">
                                <a href=""><img src="<?php echo $item['user'][0]['photo'] ?>" alt="" width="40" height="40"></a>
                            </div>
                            <div class="header-info">
                                <h4 class="name">
                                    <span class="name-original"><a href=""><?php echo $item['user'][0]['username'] ?></a></span>
                                </h4>
                                <p class="time"><?php echo $item['created_at']; ?></p>
                            </div>
                            <div class="header-menu">
                                <div class="dropdown">
                                    <a id="post-header-menu" class="post-header-menu" href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-angle-down fa-lg"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right" aria-labelledby="post-header-menu">
                                        <li><a href="#" onclick="hide_post(<?php echo $item['post_id'] ?>)">Ẩn bài đăng này</a></li>
                                        <li><a href="#" onclick="block_user(<?php echo $item['user_id'] ?>, <?php echo $item['post_id'] ?>)">Ẩn bài từ <?php echo $item['user'][0]['username'] ?></a></li>
                                        <li><a href="#" onclick="report(<?php echo $item['post_id'] ?>, <?php echo $item['user_id'] ?>)"data-toggle="modal" data-target="#post-report-modal">Báo cáo sai phạm</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="post-content card-content">
                            <div class="content-main">
                                <p class="desc"><?php echo $item['post_content'] ?>
                                <p class="cats">
                                    <?php foreach ($item['cat_name'] as $cat): ?>
                                        <span><a href=""><?php echo $cat ?></a></span>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        </div>
                        <div class="post-footer card-footer">
                            <div class="footer-count">
                                <span class="item-count"><a href=""><?php echo $item['post_like_count'] ?> thích</a></span>
                                <span class="item-count"><a href=""><?php echo $item['post_comment_count'] ?> bình luận</a></span>
                            </div>
                            <div class="footer-action">
                                <ul class="icon-container">
                                    <li class="like-icon"><a href="#" onclick="like(<?php echo $item['user_id'] ?>, <?php echo $item['post_id'] ?>)"title="Thích"><i class="fa fa-star"></i></a></li>
                                    <li class="pin-icon"><a href="#" onclick="bookmark(<?php echo $item['post_id'] ?>)"title="Đánh dấu"><i class="fa fa-thumb-tack"></i></a></li>
                                    <li class="comment-icon"><a href="#" title="Bình luận"><i class="fa fa-comment"></i></a></li>
                                    <li class="share-icon"><a href="#" onclick="share('<?php echo Yii::app()->createAbsoluteUrl('post/viewPost', array('post_id' => $item['post_id'])) ?>')" title="Chia sẻ" data-toggle="modal" data-target="#post-share-modal"><i class="fa fa-share"></i></a></li>
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
                alert(response.message);
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
                alert(response.message);
            }
        });
    }

    function report(post_id, user_id)
    {
        $('#btnSubmitReport').click(function () {
            var from = $('#from').val();
            var type = $('input[name=type]:checked').val();
            var content = $('#upload-des').val();
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('post/reportPost'); ?>',
                data: {post_id: post_id, from: from, type: type, user_id: user_id, content: content},
                type: 'POST',
                success: function (response)
                {
                    alert(response.message);
                    $('#from').val('');
                    $('input[name=type]:checked').val('');
                    $('#upload-des').val('');
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
            success: function (response) {
                console.log(response);
                alert(response.message);
            }
        });
    }

    function bookmark(post_id)
    {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('wishlist/add') ?>',
            type: 'POST',
            data: {user_id: '<?php echo Yii::app()->session['user_id'] ?>', post_id: post_id},
            success: function (response) {
                console.log(response);
                alert(response.message);
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
    $(document).ready(function () {

        // masonry layout for cards
        $cardContainer = $('.cards-display-main-ctn');
        $cardItem = $('.card-item');

        $cardItem.hide();
        $cardContainer.imagesLoaded().done(function () {
            $cardItem.fadeIn();
            $cardContainer.masonry({
                columnWidth: '.card-item',
                itemSelector: '.card-item',
                percentPosition: true,
                transitionDuration: 0
            });
        });

        $cardContainer.infinitescroll({
            navSelector: '.next',
            nextSelector: '.next a',
            itemSelector: '.cards-display-main-ctn',
            loading: {
                finishedMsg: 'ÄÃ£ háº¿t post',
                img: '',
                msgText: "Äang táº£i..."
            }
        },
        // trigger Masonry as a callback

        function (newElements) {
            var $newElems = $(newElements).css({
                opacity: 0
            });
            $newElems.imagesLoaded(function () {
                $newElems.animate({
                    opacity: 1
                });
                $cardContainer.masonry('appended', $newElems, true);
            });
        }
        );

        // single post image slider
        $('.carousel').carousel({
            interval: false,
            wrap: false
        });

        // lightbox ajax
        // $.featherlight{}



    });
</script>