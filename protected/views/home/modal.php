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
                        <input id="from" type="hidden" name="from" value="<?php echo Yii::app()->session['user_id']?>">
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
                    <button type="button" class="btn btn-default btn-sm" id="btnSubmitReport">Báo cáo</button>
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
                <a href="" class="facebook-color"><i class="fa fa-facebook-square fa-3x"></i></a>
                <a href="" class="twitter-color"><i class="fa fa-twitter-square fa-3x"></i></a>
                <a href="" class="ggplus-color"><i class="fa fa-google-plus-square fa-3x"></i></a>
            </div>
        </div>
    </div>
</div>

<script>
//    $(document).ready(function() {
//       $('#btnSubmitReport').click(function() {
//           var form = $('#form-report');
//           var data = form.serialize();
//           $.ajax({
//               url: '<?php echo Yii::app()->createUrl('post/reportPost');?>',
//               data: data,
//               type: 'POST',
//               success: function(response)
//               {
//                   alert(response.message);
//               }
//           });
//       }); 
//    });
</script>