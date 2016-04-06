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
                                                <div class="content"><?php echo $comment['comment_content'] ?></div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
