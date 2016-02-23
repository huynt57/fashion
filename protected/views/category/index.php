<div class="qh-page-header z-depth-1 text-center">
    <div class="page-title"> <?php echo StringHelper::returnCategoryTypeName($_GET['type']); ?></div>
    <div class="child-category-view">
        <ul class="child-category-list">
            <?php foreach ($cats as $cat): ?>
                <li><a href="<?php echo Yii::app()->createUrl('category/detailCategory', array('cat_id' => $cat->cat_id)); ?>">
                        <div class="bg-image" style="background-image: url('<?php echo Yii::app()->theme->baseUrl; ?>/assets/stock/card01.jpg')"></div>
                        <div class="bg-gradient"></div>
                        <div class="cat-name">Quần nam</div>
                    </a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php
$this->renderPartial('//home/index', array('data' => $data, 'pages' => $pages)
);
?>
<?php $this->renderPartial('//home/modal'); ?>