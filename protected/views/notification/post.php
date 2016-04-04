<li class="notifi-item" noti-id="<?php echo $data->id ?>" onclick="markSeen('<?php echo $data->id ?>')">
    <a href="<?php echo $data->url ?>" class="notifi-link">
        <?php $user = User::model()->findByPk($data->user_id) ?>
        <div class="image bg-cover" style="background-image: url('<?php echo StringHelper::generateUrlImage($user->photo) ?>');"></div>

        <div class="content"><?php echo $data->content ?></div>
        <div class="info">
            <span class="icon"><i class="fa fa-picture-o notifi-following-post"></i></span>
            <span class="date"><?php echo date('d/m/Y', $data->created_at) ?></span>
        </div>
    </a>
</li>