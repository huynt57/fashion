<?php $this->renderPartial('header', array('profile' => $profile)) ?>
<?php

$this->renderPartial('//home/index', array('data' => $data, 'pages' => $pages)
);
?>
<?php

$this->renderPartial('//home/modal'
);
?>
