<div class="qh-user-section qh-section-article z-depth-1">
    <h3>Khảo sát</h3>
    <hr>
    <p>Thân hình của bạn thuộc loại nào sau đây:</p>
    <form action="<?php Yii::app()->createUrl('recommend/celeb') ?>" class="qh-form qh-form-horizontal qh-form-user-body-quiz">
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Chiều cao</label>
            </div>
            <div class="col-xs-10">
                <input type="radio" id="inputWeightThin" class="hiddens" name="inputWeight"><label for="inputWeightThin" class="image-label"><img src="http://placehold.it/64?text=gay"></label>
                <input type="radio" id="inputWeightLThin" class="hiddens" name="inputWeight"><label for="inputWeightLThin" class="image-label"><img src="http://placehold.it/64?text=hg"></label>
                <input type="radio" id="inputWeightNormal" class="hiddens" name="inputWeight" checked><label for="inputWeightNormal" class="image-label"><img src="http://placehold.it/64?text=bt"></label>
                <input type="radio" id="inputWeightLFat" class="hiddens" name="inputWeight"><label for="inputWeightLFat" class="image-label"><img src="http://placehold.it/64?text=hb"></label>
                <input type="radio" id="inputWeightFat" class="hiddens" name="inputWeight"><label for="inputWeightFat" class="image-label"><img src="http://placehold.it/64?text=beo"></label>
            </div>
        </div>
        <div class="qh-form-row">
            <div class="col-xs-2">
                <label class="qh-form-label">Cân nặng:</label>
            </div>
            <div class="col-xs-10">
                <input type="radio" id="inputHeightShort" name="inputHeight"><label for="inputHeightShort" class="image-label"><img src="http://placehold.it/64?text=lun"></label>
                <input type="radio" id="inputHeightLShort" name="inputHeight"><label for="inputHeightLShort" class="image-label"><img src="http://placehold.it/64?text=hl"></label>
                <input type="radio" id="inputHeightNormal" name="inputHeight" checked><label for="inputHeightNormal" class="image-label"><img src="http://placehold.it/64?text=bt"></label>
                <input type="radio" id="inputHeightLTall" name="inputHeight"><label for="inputHeightLTall" class="image-label"><img src="http://placehold.it/64?text=hc"></label>
                <input type="radio" id="inputHeightTall" name="inputHeight"><label for="inputHeightTall" class="image-label"><img src="http://placehold.it/64?text=cao"></label>
            </div>
        </div>
        <hr>
        <div class="qh-form-row">
            <div class="col-xs-10 col-xs-offset-2">
                <button class="qh-btn qh-btn-red600">Gửi kết quả</button>
            </div>
        </div>
    </form>

</div>

