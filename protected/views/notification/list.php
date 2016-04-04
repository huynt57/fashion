<?php foreach ($data as $item): ?>
    <li class="notifi-item" noti-id="<?php echo $item->id ?>" onclick="markSeen('<?php echo $item->id ?>')">
        <a href="<?php echo $item->url ?>" class="notifi-link">
            <?php $user = User::model()->findByPk($item->user_id) ?>
            <div class="image bg-cover" style="background-image: url('<?php echo StringHelper::generateUrlImage($user->photo) ?>');"></div>

            <div class="content"><?php echo $item->content ?></div>
            <div class="info">
                <?php echo Util::getTypeNotificationHtml($item->type) ?>

                <span class="date"><?php echo date('d/m/Y', $item->created_at) ?></span>
            </div>
        </a>
    </li>
<?php endforeach; ?>
<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
    'maxButtonCount' => 1,
    'htmlOptions' => array('class' => 'msr-pagination',
    ),
    'header' => '',
    'prevPageLabel' => '',
    'nextPageLabel' => 'Loading ...',
    'firstPageLabel' => '',
    'lastPageLabel' => '',
    'selectedPageCssClass' => 'active',
        )
)
?>
<div class="msr-loading"></div>
