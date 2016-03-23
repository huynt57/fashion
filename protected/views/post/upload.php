<div class="qh-modal-dialog qh-upload-section z-depth-2">
    <form  action="<?php echo Yii::app()->createUrl('post/AddPostForWeb') ?>" enctype="multipart/form-data" method="POST" class="qh-form qh-upload-post-form">
        <div class="qh-form-row">
            <textarea rows="4" placeholder="Miêu tả" class="post-description" name="post_content"></textarea>
        </div>
        <div class="qh-form-row clearfix text-center">
            <div class="post-image-upload">

            </div>
            <input type="hidden" value="<?php echo Yii::app()->request->url ?>" name="previous_url">
            <input type="hidden" value="<?php echo Yii::app()->session['user_id'] ?>" name="user_id" >
            <div class="post-image-input">
                <input type="file" class="hidden" id="inputPostImage" name="images[]" multiple="">
                <label for="inputPostImage" class="label-image-input text-center">
                    <div class="icon"><i class="fa fa-plus"></i></div>
                    <div class="text">Thêm ảnh</div>
                </label>
            </div>
        </div>
        <div class="qh-form-row clearfix text-center">
            <div class="category-title">Chọn chuyên mục (tối đa: 2)</div>
            <div class="category-choosing">
                <div class="qh-form-row">
                    <label class="qh-form-label">Thời trang nam</label>
                    <?php foreach ($male_cats as $cat): ?>
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="cats[]" value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></label>
                        </div>
                    <?php endforeach; ?>
                    <label class="qh-form-label">Thời trang nữ</label>
                    <?php foreach ($female_cats as $cat): ?>
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="cats[]" value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></label>
                        </div>
                    <?php endforeach; ?>
                    <label class="qh-form-label">Khác</label>
                    <?php foreach ($other_cats as $cat): ?>
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="cats[]" value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="qh-form-row clearfix text-center">
            <div class="category-title">Chọn album</div>
            <div class="col-xs-8 col-xs-offset-2">
                <select class="qh-input-control" name="album">
                    <?php foreach ($albums as $album): ?>
                        <option value="<?php echo $album->album_id?>"><?php echo $album->album_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="qh-form-row clearfix text-center">
            <button class="qh-btn qh-btn-red600" type="submit">Đăng ảnh</button>
            <div class="post-cancel"><a href="#" onclick="dismissModal()">Hủy đăng ảnh</a></div>
        </div>
    </form>
</div>

<script>
    function dismissModal()
    {
        $('#uploadNewPostModal').modal('hide');
    }
</script>