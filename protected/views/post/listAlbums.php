<select class="qh-input-control" name="album" id="album">
    <?php foreach ($albums as $album): ?>
        <option value="<?php echo $album->album_id ?>"><?php echo $album->album_name ?></option>
    <?php endforeach; ?>
</select>