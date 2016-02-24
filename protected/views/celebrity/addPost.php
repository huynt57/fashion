<div class="qh-user-section qh-section-article z-depth-1">
    <form  action="<?php echo Yii::app()->createUrl('celebrity/insertPostCeleb') ?>" enctype="multipart/form-data" method="POST" class="qh-form qh-upload-post-form">
        <h3 class="form-title">Thêm bài viết cho người nổi tiếng</h3>
        <hr>
        <div class="qh-form-row">
            <textarea rows="4" placeholder="Miêu tả" class="qh-input-control" name="post_content"></textarea>
        </div>
        <div class="qh-form-row clearfix ">
           

            <div class="post-image-input">
                <label class="qh-form-label">Đăng ảnh, có thể đăng nhiều ảnh một lúc</label>
                <input type="file" id="inputPostImage" name="images[]" multiple>
            </div>
        </div>
        <div class="qh-form-row clearfix ">

            <label class="qh-form-label">Chọn người nổi tiếng</label>
            <select class="qh-input-control" name="celeb_id">
                <?php foreach ($celebs as $celeb): ?>
                    <option value="<?php echo $celeb->id ?>"><?php echo $celeb->celeb_name ?></option>
                <?php endforeach; ?>
            </select>

        </div>
        <div class="qh-form-row clearfix ">
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
        <div class="qh-form-row clearfix ">
            <button class="qh-btn qh-btn-red600" type="submit">Đăng ảnh</button>
        </div>
    </form>
</div>