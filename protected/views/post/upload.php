<div class="upload-page">
    <div class="upload-container clearfix">
        <form action="<?php echo Yii::app()->createUrl('post/AddPostForWeb') ?>" class="upload-content-form" method="POST" enctype="multipart/form-data" id="addPostForm">
            <input type="hidden" value="<?php echo Yii::app()->session['user_id'] ?>" />
            <div class="form-group">
                <label for="upload-image">Chọn ảnh (tối đa: 5)</label>
                <input type="file" id="upload-image" name="images[]" multiple>
            </div>
            <div class="form-group">
                <label for="upload-des">Miêu tả</label>
                <textarea name="post_content" id="upload-des" class="form-control" rows="3" placeholder="Miêu tả cho bài đăng"></textarea>
            </div>
            <input type="hidden" value="<?php echo Yii::app()->request->url ?>" name="previous_url">
            <input type="hidden" value="<?php echo Yii::app()->session['user_id'] ?>" name="user_id" > 
            <div class="form-group">
                <label>Chọn chuyên mục (tối đa: 2)</label>
                <div class="checkbox-container">
                    <div class="thoi-trang-nam">
                        <h4>- Thời trang nam</h4>
                        <?php foreach ($male_cats as $cat): ?>
                            <div class="checkbox">
                                <label><input type="checkbox" name="cats[]" value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="thoi-trang-nu">
                        <h4>- Thời trang nữ</h4>
                        <?php foreach ($female_cats as $cat): ?>
                            <div class="checkbox">
                                <label><input type="checkbox" name="cats[]" value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="chuyen-muc-khac">
                        <h4>- Chuyên mục khác</h4>
                        <?php foreach ($other_cats as $cat): ?>
                            <div class="checkbox">
                                <label><input type="checkbox" name="cats[]" value="<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <p class="error-color">
                    Chưa có ảnh. <br>
                    Chưa chọn chuyên mục.
                </p>
            </div>
            <button type="submit" id="submitButton" class="btn btn-default">Đăng</button>

        </form>
        <!-- <form action="#" class="dropzone">
                
        </form> -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
//        $("#addPostForm").submit(function () {
//            $.ajax(this.action, {
//                data: $(":text", this).serializeArray(),
//                files: $("#images", this),
//                iframe: true
//            }).complete(function (data) {
//                console.log(data);
//            });
//        });
    });

    $(document).on('submit', '#addPostForm', function (e) {
        e.preventDefault();
        if ($('#upload-image').get(0).files.length === 0) {
            alert('Bạn chưa chọn ảnh, bạn phải chọn ít nhất 1 ảnh và tối đa 10 ảnh');
            return false;
        }

        if ($('#upload-image').get(0).files.length > 10) {
            alert('Bạn chỉ được chọn tối đa 10 ảnh');
            return false;
        }

        if ($("input:checkbox:checked").length === 0)
        {
            alert('Bạn phải chọn ít nhất một tiện nghi trong nhà !');
            return false;
        }
    });
</script>