<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
<div class="qh-user-section qh-section-article z-depth-1">
    <form action="<?php echo Yii::app()->createUrl('celebrity/addCeleb') ?>" class="qh-form qh-form-horizontal" method="POST" enctype="multipart/form-data">
        <h3 class="form-title">Thông tin người nổi tiếng</h3>
        <hr>
        <div class="col-md-6">
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Tên</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_name">
                </div>
            </div>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Tuổi</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_age">
                </div>
            </div>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Giới thiệu</label>
                </div>
                <div class="col-xs-10">
                    <textarea class="qh-input-control" rows="5" name="celeb_profile"></textarea>
                </div>
            </div>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Chiều cao</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_height">
                </div>
            </div>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Cân nặng</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_weight">
                </div>
            </div>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Instagram</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_instagram">
                </div>
            </div>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Facebook</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_facebook">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Vòng 1</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_v1">
                </div>
            </div>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Vòng 2</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_v2">
                </div>
            </div>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Vòng 3</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_v3">
                </div>
            </div>

            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Chỉ số IBM</label>
                </div>
                <div class="col-xs-10">
                    <input type="text" class="qh-input-control" name="celeb_ibm">
                </div>
            </div>
            
            <div class="qh-form-row">
                <label class="qh-form-label">Đánh giá chiều cao</label>
                <select class="qh-input-control" name="celeb_height_rate">
                    <option value="LOW">Thấp</option>
                    <option value="MEDIUM">Trung bình</option>
                    <option value="HIGH">Cao</option>
                </select>
            </div>
            <div class="qh-form-row">
                <label class="qh-form-label">Đánh giá cân nặng</label>
                <select class="qh-input-control" name="celeb_weight_rate">
                    <option value="LOW">Gầy</option>
                    <option value="MEDIUM">Trung bình</option>
                    <option value="HIGH">Béo</option>
                </select>
            </div>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Ảnh đại diện</label>
                </div>
                <div class="col-xs-10">

                    <input type="file" id="inputAvatarUpload" name="celeb_image">
                </div>
            </div>
            <hr>
            <div class="qh-form-row">
                <div class="col-xs-2">
                    <label class="qh-form-label">Ảnh cover</label>
                </div>
                <div class="col-xs-10">

                    <input type="file" id="inputCoverUpload" name="celeb_cover">
                </div>
            </div>
        </div>


        <hr>
        <div class="qh-form-row">
            <div class="col-xs-2 col-xs-offset-5">
                <button class="qh-btn qh-btn-red600">Lưu thông tin</button>
            </div>
        </div>
    </form>
</div>
