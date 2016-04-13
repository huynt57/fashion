<div class="qh-page-header z-depth-1 text-center">
    <div class="page-title"><?php echo $album->album_name ?></div>
    <div class="page-subtitle"><?php echo $album->description ?></div>
</div>
<?php $cnt = count($data)?>
<?php if($cnt == 0):?>
<div class="qh-page-header z-depth-1 text-center">
    <div class="page-title">Album chưa có bài đăng nào</div>
   
</div>
<?php endif;?>
<?php
$this->renderPartial('//home/index', array('data' => $data, 'pages' => $pages)
);
?>
<?php
$this->renderPartial('//home/modal'
);
?>