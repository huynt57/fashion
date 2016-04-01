<!-- User Section -->
<?php $this->renderPartial('header', array('profile' => $profile)) ?>
<div class="qh-user-section qh-section-article z-depth-1">
    <form action="<?php echo Yii::app()->createUrl('user/updateInfo')?>" class="qh-form qh-form-horizontal" enctype="multipart/form-data">
        <h3 class="form-title">Thông tin cá nhân</h3>
        <hr>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Username</label>
            </div>
            <div class="col-xs-10">
                <input type="text" class="qh-input-control" name="username">
            </div>
        </div>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Giới thiệu</label>
            </div>
            <div class="col-xs-10">
                <textarea class="qh-input-control" rows="5" name="description"></textarea>
            </div>
        </div>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Ảnh đại diện</label>
            </div>
            <div class="col-xs-10">
                <div class="user-avatar-upload">
                    <div class="avatar-image bg-cover" style="background-image: url('<?php echo StringHelper::generateUrlImage($profile->photo) ?>');"></div>
                </div>
                <input name="user_photo" type="file" id="inputAvatarUpload" class="hidden"><label for="inputAvatarUpload" class="qh-btn qh-btn-normal qh-btn-sm">Chọn ảnh</label>
            </div>
        </div>
        <hr>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Ảnh cover</label>
            </div>
            <div class="col-xs-10">
                <div class="user-cover-upload">
                    <img src="assets/stock/cover1.jpg" alt="">
                </div>
                <input name="user_cover" type="file" id="inputCoverUpload" class="hidden"><label for="inputCoverUpload" class="qh-btn qh-btn-normal qh-btn-sm">Chọn ảnh</label>
            </div>
        </div>
        <hr>
        <div class="qh-form-row">
            <div class="col-xs-10 col-xs-offset-2">
                <button class="qh-btn qh-btn-red600" type="submit">Lưu thông tin</button>
            </div>
        </div>
    </form>
</div>

