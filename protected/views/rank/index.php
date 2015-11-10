<div class="df-container title-card with-title-and-menu">
    <div class="intro-text">
        <h2 class="intro-title">Bảng xếp hạng</h2>
        <p class="intro-des">Bảng xếp hạng theo thời gian của hệ thống </p>
    </div>
    <div class="menu-section">
        <div class="main-menu-section">
            <ul>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('rank/rankPostBytime', array('time' => 'DAY')); ?>">Ngày</a></li>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('rank/rankPostBytime', array('time' => 'WEEK')); ?>">Tuần</a></li>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('rank/rankPostBytime', array('time' => 'MONTH')); ?>">Tháng</a></li>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('rank/rankPostBytime', array('time' => 'YEAR')); ?>">Năm</a></li>
            </ul>
        </div>
    </div>
</div>
<?php $this->renderPartial('cards_post', array('data' => $data, 'pages' => $pages)); ?>
<script>
    $('document').ready(function () {
        var url = window.location.href;
        $('a[href="' + url + '"]').parent().addClass('active');
    });

</script>