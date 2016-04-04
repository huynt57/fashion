<?php $this->renderPartial('header', array('profile' => $profile, 'is_followed'=>$is_followed)) ?>
<?php

$this->renderPartial('//home/index', array('data' => $data, 'pages' => $pages)
);
?>
<?php

$this->renderPartial('//home/modal'
);
?>