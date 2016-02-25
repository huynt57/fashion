<!-- User Section -->
<?php $this->renderPartial('header', array('profile' => $profile)) ?>
<div class="qh-user-section qh-section-article z-depth-1">
    <form action="#" class="qh-form qh-form-horizontal">
        <h3 class="form-title">Thông tin cá nhân</h3>
        <hr>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Họ tên</label>
            </div>
            <div class="col-xs-10">
                <input type="text" class="qh-input-control">
            </div>
        </div>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Email</label>
            </div>
            <div class="col-xs-10">
                <input type="text" class="qh-input-control">
            </div>
        </div>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Giới thiệu</label>
            </div>
            <div class="col-xs-10">
                <textarea class="qh-input-control" rows="5"></textarea>
            </div>
        </div>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Mật khẩu</label>
            </div>
            <div class="col-xs-10">
                <a class="qh-btn qh-btn-normal">Thay đổi mật khẩu</a>
            </div>
        </div>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Ảnh đại diện</label>
            </div>
            <div class="col-xs-10">
                <div class="user-avatar-upload">
                    <div class="avatar-image bg-cover" style="background-image: url('assets/stock/avatar.jpg');"></div>
                </div>
                <input type="file" id="inputAvatarUpload" class="hidden"><label for="inputAvatarUpload" class="qh-btn qh-btn-normal qh-btn-sm">Chọn ảnh</label>
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
                <input type="file" id="inputCoverUpload" class="hidden"><label for="inputCoverUpload" class="qh-btn qh-btn-normal qh-btn-sm">Chọn ảnh</label>
            </div>
        </div>
        <hr>
        <div class="qh-form-row">
            <div class="col-xs-10 col-xs-offset-2">
                <button class="qh-btn qh-btn-red600">Lưu thông tin</button>
            </div>
        </div>
    </form>
</div>

