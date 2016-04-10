<?php $this->renderPartial('header', array('profile' => $profile, 'is_followed' => $is_followed)) ?>
<?php //var_dump($data); die;   ?>
<!-- Modal New Album -->
<div class="modal fade" id="addNewAlbumModal">
    <div class="qh-modal-dialog qh-upload-section qh-add-album-section z-depth-2">
        <form action="Javascript::void(0)" class="qh-form qh-form-normal" id="formAddAlbum">
            <div class="qh-form-row">
                <input type="text" class="qh-input-control" placeholder="Tên album" name="album_name" id="album_name">
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
<div class="qh-container">
    <div class="post-cards-wrap clearfix">
        <div class="card-single">
            <div class="card-single-inner">
                <div class="add-new-album-btn">
                    <a href="" class="post-link" data-toggle="modal" data-target="#addNewAlbumModal">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/add-album.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>


        <?php foreach ($data as $item): ?>
            <div class="card-single">
                <div class="card-single-inner">
                    <div class="c-image">
                        <div class="post-image">
                            <img src="" alt="" class="hidden">
                            <a href="<?php echo Yii::app()->createUrl('user/listPostAlbums', array('album_id' => $item['album_id'])) ?>" class="post-link album-link">
                                <?php foreach ($item['images_preview'] as $image): ?>
                                    <div class="album-image bg-cover" style="background-image: url('<?php echo StringHelper::generateUrlImage($image) ?>');"></div>
                                <?php endforeach; ?>
                            </a>
                        </div>				
                    </div>
                    <div class="c-body">
                        <div class="album-info">
                            <span class="single-info">Album gồm <?php echo $item['number_posts'] ?> bài</span>
                            <span class="single-info"><a href="#">Chỉnh sửa</a></span>
                        </div>
                        <div class="album-name"><a href="#" title="<?php echo $item['album_name'] ?>"><?php echo $item['album_name'] ?></a></div>
                    </div>
                    <!-- <div class="c-header">
                            <div class="user-image">
                                    <a href="#" class="user-avatar" style="background-image: url('assets/stock/avatar.jpg');"></a>
                            </div>
                            <div class="user-info">
                                    <div class="display-name"><a href="#" class="display-name-link">Nguyễn Hoàng Thảo</a></div>
                                    <div class="post-info">
                                            <span class="time">Album cập nhật lúc 23/12/2015</span>
                                    </div>
                            </div> 
                    </div>-->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    $('#btnAddAlbum').click(function () {
        var form = $('#formAddAlbum');
        var data = form.serialize();
        $.ajax({
            beforeSend: function (xhr) {
                var album_name = $('#album_name').val();
                // var description = $('#description').val();
                if (album_name === '')
                {
                    xhr.abort();
                    alert('Bạn không được để trống tên album');
                }
            },
            type: 'POST',
            url: '<?php echo Yii::app()->createUrl('user/addAlbum') ?>',
            data: data,
            success: function (response) {
                $('#addNewAlbumModal').modal('hide');
                successNotifiDisplay({
                    title: 'Thành công !',
                    message: 'Thêm album thành công'
                });
            },
            error: function (response)
            {
            }
        });
    });
</script>