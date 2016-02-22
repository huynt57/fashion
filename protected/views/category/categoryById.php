<div class="qh-page-header z-depth-1 text-center">
    <div class="page-title"><?php echo StringHelper::returnCategoryNameById($_GET['cat_id']); ?></div>
</div>


<?php
$this->renderPartial('//home/index', array('data' => $data)
);
?>