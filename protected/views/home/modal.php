<!-- ========================================================= -->
<!-- Modal, có vài cái template modal ở dưới chưa ghép vào link nào cả (default) -->

<!-- Modal Report -->
<div class="modal fade" id="post-report-modal">
    <div class="qh-modal-dialog qh-default-modal z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <h3 class="title"></h3>
        <div class="qh-modal-title">Báo cáo sai phạm</div>
        <div class="qh-modal-content">
            <p>Vì sao bạn nghĩ bài đăng này vi phạm qui định?</p>
            <form action="#" class="qh-form qh-form-normal"  id="form-report">
                <div class="qh-form-row">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" value="1">
                            Nội dung không phù hợp, đồi trụy
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" value="2">
                            Vi phạm bản quyền
                        </label>
                    </div>
                    <input id="from" type="hidden" name="from" value="<?php echo Yii::app()->session['user_id'] ?>">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" value="3">
                            Spam, virus
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" value="5">
                            Lý do khác
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="upload-des">Thông tin thêm</label>
                        <textarea id="upload-des"  name="content" class="form-control" rows="2" placeholder="Thông tin thêm cho bộ phận quản lý"></textarea>
                    </div>
                    <!--                    <div class="radio disabled">
                                            <label>
                                                <input type="radio" name="optionsRadios" disabled>
                                                Option three is disabled
                                            </label>
                                        </div>-->
                </div>
                <div class="qh-form-row">
                    <button type="button" class="btn btn-default btn-sm" name="btnSubmitReport" id="btnSubmitReport">Báo cáo</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Share -->
<div class="modal fade" id="postShareSocialModal">
    <div class="qh-modal-dialog qh-default-modal qh-modal-sm-size z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <div class="qh-modal-content">
            <p class="text-center">Chia sẻ ảnh</p>
            <hr>
            <p class="text-center">
                <a href="#" class="qh-btn qh-btn-icon left-icon qh-btn-facebook"><i class="fa fa-facebook fa-lg"></i>Facebook</a>
                <a href="#" class="qh-btn qh-btn-icon left-icon qh-btn-twitter"><i class="fa fa-twitter fa-lg"></i>Twitter</a>
                <a href="#" class="qh-btn qh-btn-icon left-icon qh-btn-ggplus"><i class="fa fa-google-plus fa-lg"></i>Google</a>
            </p>
        </div>
    </div>
</div>

<!-- Modal Hide Post -->
<div class="modal fade" id="hidePostFromUserModal">
    <div class="qh-modal-dialog qh-default-modal z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <div class="qh-modal-content">
            <p>Ẩn cái bài đăng từ <b>Nguyễn Thảo Trang</b> ?</p>
            <p>Các bài đăng của Nguyễn Thảo Trang sẽ không hiện lên các trang khám phá của bạn nữa.</p>
            <hr>
            <p><button class="qh-btn qh-btn-normal">Đồng ý</button></p>
        </div>
    </div>
</div>

<!-- Modal Blocok User -->
<div class="modal fade" id="blockUserFromPostModal">
    <div class="qh-modal-dialog qh-default-modal z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <div class="qh-modal-content">
            <p>Chặn Nguyễn Thảo Trang ?</p>
            <hr>
            <p><button class="qh-btn qh-btn-normal">Chặn</button></p>
        </div>
    </div>
</div>
<!-- Modal Tks -->
<div class="modal fade" id="postReportThanksModal">
    <div class="qh-modal-dialog qh-default-modal z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <div class="qh-modal-content">
            <p>Cám ơn phản hồi của bạn.</p>
        </div>
    </div>
</div>

<!-- Modal Single Post -->
<div class="modal fade" id="singlePostModal">
    <div class="qh-modal-dialog qh-single-post-section z-depth-2" id="single-post-modal">

    </div>
</div>



<!-- Modal Loading -->
<div class="modal fade" id="modal-loading">
    <div class="qh-modal-dialog qh-loading-modal z-depth-2">
        <div class="loading-spin"><i class="fa fa-circle-o-notch fa-spin fa-3x"></i></div>
    </div>
</div>

<!-- Modal Default -->
<div class="modal fade" id="">
    <div class="qh-modal-dialog qh-default-modal z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <div class="qh-modal-title">But I must explain to you how ...</div>
        <div class="qh-modal-content">
            <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>
            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?</p>
        </div>
    </div>
</div>

<!-- Modal Default Sucess -->
<div class="modal fade" id="">
    <div class="qh-modal-dialog qh-default-modal qh-modal-xs-size z-depth-2">
        <button class="close-modal-button" data-dismiss="modal"><i class="fa fa-close"></i></button>
        <div class="qh-modal-content">
            <p>Đăng bài thành công.</p>
        </div>
    </div>
</div>
<!-- Report Modal -->
<div class="modal fade modal-post-report" id="post-report-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Báo cáo sai phạm</h4>
            </div>
            <div class="modal-body">
                <form action="" id="form-report">
                    <div class="form-group">
                        <label>Lý do bạn cho rằng bài đăng vi phạm?</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="optionsRadios1" value="1">
                                Sexual Content
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="optionsRadios1" value="2">
                                Vi phạm bản quyền
                            </label>
                        </div>
                        <input id="from" type="hidden" name="from" value="<?php echo Yii::app()->session['user_id'] ?>">
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="optionsRadios1" value="3">
                                Spam, Virus
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="optionsRadios1" value="4">
                                Option one is this and that—be sure to include why it's great
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" id="optionsRadios1" value="5">
                                Lý do khác
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="upload-des">Thông tin thêm</label>
                        <textarea id="upload-des"  name="content" class="form-control" rows="2" placeholder="Thông tin thêm cho bộ phận quản lý"></textarea>
                    </div>
                    <hr>
                    <!-- <div class="form-group">
                          <p class="error-color">
                                  Đã chọn chuyên mục đâu thím ơi.
                          </p>
                    </div> -->
                    <button type="button" class="btn btn-default btn-sm" name="btnSubmitReport" id="btnSubmitReport">Báo cáo</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Share Modal -->
<div class="modal fade modal-post-shared" id="post-share-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Chia sẻ</h4>
            </div>
            <div class="modal-body">
                <a href="" class="facebook-color" id="fb-sharer"><i class="fa fa-facebook-square fa-3x"></i></a>
                <a href="" class="twitter-color" id="tt-sharer"><i class="fa fa-twitter-square fa-3x"></i></a>
                <a href="" class="ggplus-color" id="gg-sharer"><i class="fa fa-google-plus-square fa-3x"></i></a>
            </div>
        </div>
    </div>
</div>

