<div class="qh-container">
    <!-- User Page -->
    <?php $this->renderPartial('header', array('profile' => $profile)) ?>
    <?php $this->renderPartial('listPost', array('data' => $posts, 'pages' => $pages)) ?>
</div>


