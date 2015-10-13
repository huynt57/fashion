<div class="user-profile-page">

    <div class="user-header">
        <div class="cover-photo" style="background-image: url('<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/cover1.jpg')">
            <div class="cover-gradient"></div>
            <div class="cover-content">
                <div class="df-container">
                    <div class="cover-content-inner">
                        <div class="avatar">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/sample/avatar5.jpg" alt="">
                        </div>
                        <div class="info">
                            <h1 class="name">Juliana Gabriel</h1>
                            <div class="about">
                                <p class="about-text">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you.</p>
                                <p class="about-link">
                                    <span class="location"><i class="fa fa-map-marker"></i>Sài Gòn</span>
                                    <!-- <span class="website"><i class="fa fa-globe"></i><a href="">www.juliagabriel.com</a></span> -->
                                    <span class="social">
                                        <a href=""><i class="fa fa-facebook-square"></i></a>
                                        <a href=""><i class="fa fa-twitter-square"></i></a>
                                        <a href=""><i class="fa fa-tumblr-square"></i></a>
                                        <a href=""><i class="fa fa-instagram"></i></a>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="user-meta clearfix">
                            <p>
                                <span class="meta-count">1234 Bài đăng</span>
                                <span class="meta-count">344 Album</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-section">
            <div class="df-container">
                <div class="main-menu-section">
                    <ul>
                        <li class="active"><a href="#">
                                <i class="fa fa-home icon-on-small"></i>
                                <span class="text-on-large">Tường</span>
                            </a></li>
                        <li><a href="#">
                                <i class="fa fa-cloud-upload icon-on-small"></i>
                                <span class="text-on-large">Bài đăng</span>
                            </a></li>
                        <li><a href="#">
                                <i class="fa fa-picture-o icon-on-small"></i>
                                <span class="text-on-large">Album</span>
                            </a></li>
                        <!-- <li><a href="#">
                                <i class="fa fa-thumb-tack icon-on-small"></i>
                                <span class="text-on-large">Đánh dấu</span>
                        </a></li> -->
                    </ul>
                </div>
                <div class="other-menu-section">
                    <ul>
                        <li id="user-other-menu" class="dropdown">
                            <a href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-angle-down fa-lg"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" aria-labelledby="user-other-menu">
                                <li><a href="#">Sửa thông tin</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="edit-information">
        <div class="df-container">
            <div class="edit-information-inner shadow-depth-1">
                <form action="">
                    <h2>Thông tin cá nhân</h2><hr>
                    <div class="form-group">
                        <label for="user-username">Tên đăng nhập</label>
                        <input type="text" id="user-username" class="form-control" value="juliaanagal" disabled>
                    </div>
                    <div class="form-group">
                        <label for="user-email">Email</label>
                        <input type="email" id="user-email" class="form-control" value="juliaana123@gmali.com">
                        <p class="help-block error-color">Địa chỉ email không đúng</p>
                    </div>
                    <div class="form-group">
                        <label for="user-displayname">Tên hiển thị</label>
                        <input type="text" id="user-displayname" class="form-control" value="Juliana Gabriel">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu: <a href="profile_editpass.html" target="_blank">Thay đổi</a></label>
                    </div>
                    <div class="form-group">
                        <label for="user-img-avatar">Thay đổi ảnh đại diện</label>
                        <input type="file" id="upload-img-avatar">
                    </div>
                    <div class="form-group">
                        <label for="user-img-cover">Thay đổi ảnh cover</label>
                        <input type="file" id="upload-img-cover">
                    </div>
                    <div class="form-group">
                        <label for="user-description">Giới thiệu</label>
                        <textarea id="user-description" rows="3" class="form-control">Jullianna | 24 | Love Jesus</textarea>
                    </div>
                    <div class="form-group">
                        <label for="user-address">Địa chỉ</label>
                        <input type="text" id="user-address" class="form-control" value="Hà Nội">
                    </div>
                    <hr><h2>Mạng xã hội</h2><hr>
                    <div class="form-group">
                        <label for="user-sc-fb">Facebook</label>
                        <input type="text" id="user-sc-fb" class="form-control" value="https://www.facebook.com/hiep.taq">
                    </div>
                    <div class="form-group">
                        <label for="user-sc-tw">Twitter</label>
                        <input type="text" id="user-sc-tw" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="user-sc-gg">Google Plus</label>
                        <input type="text" id="user-sc-gg" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="user-sc-is">Instagram</label>
                        <input type="text" id="user-sc-is" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="user-sc-tb">Tumbrl</label>
                        <input type="text" id="user-sc-tb" class="form-control" value="">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-default">Hoàn tất</button>
                </form>
            </div>
        </div>
    </div>

</div>
