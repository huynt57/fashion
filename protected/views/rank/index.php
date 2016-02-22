<div class="qh-page-header z-depth-1 text-center">
    <div class="page-title">Bảng xếp hạng</div>
    <div class="page-subtitle">Bảng xếp hạng theo thời gian của hệ thống</div>

    <div class="page-header-nav">
        <ul class="nav nav-pills" role="tablist">
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('rank/rankPostBytime', array('time' => 'DAY')); ?>">Theo ngày</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('rank/rankPostBytime', array('time' => 'WEEK')); ?>">Theo tuần</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('rank/rankPostBytime', array('time' => 'MONTH')); ?>">Theo tháng</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('rank/rankPostBytime', array('time' => 'YEAR')); ?>">Theo năm</a></li>
        </ul>
    </div>
</div>

<?php $this->renderPartial('cards_post', array('data' => $data, 'pages' => $pages)); ?>
<script>
    $('document').ready(function () {
        var url = window.location.href;
        $('a[href="' + url + '"]').parent().addClass('active');
    });

</script>