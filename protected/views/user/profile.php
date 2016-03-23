<div class="qh-container">
    <!-- User Page -->
    <?php $this->renderPartial('header', array('profile' => $profile, 'is_followed'=>$is_followed)) ?>
    <?php $this->renderPartial('listPost', array('data' => $posts, 'pages' => $pages)) ?>
</div>


