<div class="cards-display-main-ctn">
    <div class="card-sizer"></div>
    <?php foreach ($data as $item): ?>
        <div class="card-item card-hide">
            <div class="card-item-inner">
                <div class="post-image card-image <?php echo StringHelper::returnClassForMultipleImages(count($item['images'])) ?>">
                    <a href="<?php echo Yii::app()->createUrl('post/viewPost', array('post_id' => $item['post_id'])); ?> .lightbox-post" data-featherlight="ajax">
                        <?php foreach ($item['images'] as $image): ?>
                            <?php if (count($item['images']) == 1): ?>                                                                                                             <!--                                    <span style="background-image: url('<?php //echo Yii::app()->request->getBaseUrl(true) . '/' . $image['img_url']                                     ?>');"></span>-->
                                <img src="<?php echo Yii::app()->request->getBaseUrl(true) . '/' . $image['img_url'] ?>" class="img-fullwidth">
                            <?php endif; ?>
                            <?php if (count($item['images']) > 1): ?>  
            <span style="background-image: url('<?php echo Yii::app()->request->getBaseUrl(true) . '/' . $image['img_url'] ?>');"></span>                                                                                                           <!--                                    <span style="background-image: url('<?php //echo Yii::app()->request->getBaseUrl(true) . '/' . $image['img_url']                                        ?>');"></span>-->
                            <?php endif; ?>
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
                                <li><a href="#" data-toggle="modal" data-target="#post-report-modal">Báo cáo sai phạm</a></li>
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
                            <li class="like-icon"><a href="" title="Thích"><i class="fa fa-star"></i></a></li>
                            <li class="pin-icon"><a href="" title="Đánh dấu"><i class="fa fa-thumb-tack"></i></a></li>
                            <li class="comment-icon"><a href="" title="Bình luận"><i class="fa fa-comment"></i></a></li>
                            <li class="share-icon"><a href="" title="Chia sẻ" data-toggle="modal" data-target="#post-share-modal"><i class="fa fa-share"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>