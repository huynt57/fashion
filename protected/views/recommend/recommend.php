<div class="qh-user-section qh-section-article z-depth-1">
    <h3>Khảo sát</h3>
    <hr>
    <p>Thân hình của bạn thuộc loại nào sau đây:</p>
    <form action="<?php echo Yii::app()->createUrl('recommend/celeb') ?>" class="qh-form qh-form-horizontal qh-form-user-body-quiz" method="GET">
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Chiều cao</label>
            </div>
            <div class="col-xs-10">
                <input type="radio" id="inputHeightShort" value="LOW" name="rate_height"><label for="inputHeightShort" class="image-label"><img src="http://placehold.it/64?text=LOW"></label>
                <input type="radio" id="inputHeightLShort" value="MEDIUM" name="rate_height"><label for="inputHeightLShort" class="image-label"><img src="http://placehold.it/64?text=MEDIUM"></label>
                <input type="radio" id="inputHeightNormal" value="HIGH" name="rate_height" checked><label for="inputHeightNormal" class="image-label"><img src="http://placehold.it/64?text=HIGH"></label>
            </div>
        </div>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Cân nặng:</label>
            </div>
            <div class="col-xs-10">
                <input type="radio" id="inputWeightThin" value="LOW" class="hiddens" name="rate_weight"><label for="inputWeightThin" class="image-label"><img src="http://placehold.it/64?text=LOW"></label>
                <input type="radio" id="inputWeightLThin" value="MEDIUM" class="hiddens" name="rate_weight"><label for="inputWeightLThin" class="image-label"><img src="http://placehold.it/64?text=MEDIUM"></label>
                <input type="radio" id="inputWeightNormal" value="HIGH" class="hiddens" name="rate_weight" checked><label for="inputWeightNormal" class="image-label"><img src="http://placehold.it/64?text=HIGH"></label>
            </div>
        </div>
        <hr>
        <div class="qh-form-row">
            <div class="col-xs-10 col-xs-offset-2">
                <button class="qh-btn qh-btn-red600" type="submit">Gửi kết quả</button>
            </div>
        </div>
    </form>

</div>

