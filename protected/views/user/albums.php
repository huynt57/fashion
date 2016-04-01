 <?php $this->renderPartial('header', array('profile' => $profile, 'is_followed'=>$is_followed)) ?>
<div class="card-single">
    <div class="card-single-inner">
        <div class="add-new-album-btn">
            <a href="" class="post-link" data-toggle="modal" data-target="#addNewAlbumModal">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/add-album.jpg" alt="">
            </a>
        </div>
    </div>
</div>
<!-- Modal New Album -->
<div class="modal fade" id="addNewAlbumModal">
    <div class="qh-modal-dialog qh-upload-section qh-add-album-section z-depth-2">
        <form action="Javascript::void(0)" class="qh-form qh-form-normal" id="formAddAlbum">
            <div class="qh-form-row">
                <input type="text" class="qh-input-control" placeholder="Tên album" name="album_name">
            </div>
            <div class="qh-form-row">
                <textarea row="3" class="qh-input-control" placeholder="Mô tả" name="description"></textarea>
            </div>
            <hr>
            <div class="qh-form-row clearfix text-center">
                <button class="qh-btn qh-btn-red600" id="btnAddAlbum">Thêm Album</button>
                <div class="post-cancel"><a href="#">Hủy</a></div>
            </div>
        </form>
    </div>
</div>

<?php foreach ($data as $item): ?>
    <div class="card-single">
        <div class="card-single-inner">
            <div class="c-image">
                <div class="post-image">
                    <a href="" class="post-link" data-toggle="modal" data-target="#singlePostModal">
                        <div class="album-behind-border first-border"></div>
                        <div class="album-behind-border second-border"></div>
                        <div class="album-behind-border third-border"></div>
                        <div class="single-album-image"><img src="<?php echo $item['image_preview'] ?>" alt=""></div>
                    </a>
                </div>				
            </div>
            <div class="c-body">
                <div class="album-info">
                    <span class="single-info">Album gồm <?php echo $item['number_posts'] ?> bài đăng</span>
                    <span class="single-info"><a href="#">Chỉnh sửa</a></span>
                </div>

                <div class="item-description album-description"><?php echo $item['description'] ?></div>
            </div>
            <div class="c-header">
                
                <div class="user-info">
                   
                    <div class="post-info">
                        <span class="time">Album cập nhật lúc <?php echo $item['updated_at'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>
<script>
    $('#btnAddAlbum').click(function () {
        var form = $('#formAddAlbum');
        var data = form.serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createUrl('user/addAlbum') ?>',
            data: data,
            success: function (response) {
            },
            error: function (response)
            {
            }
        });
    });
</script>
