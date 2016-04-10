<div class="qh-page-header z-depth-1 text-center">
    <div class="page-title"><?php echo $album->album_name ?></div>
    <div class="page-subtitle"><?php echo $album->description ?></div>

    
</div>
<?php
$this->renderPartial('//home/index', array('data' => $data, 'pages' => $pages)
);
?>
<?php
$this->renderPartial('//home/modal'
);
?>