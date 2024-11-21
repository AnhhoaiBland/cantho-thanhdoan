<?php if (!empty($ds_baiDang) && is_array($ds_baiDang)): ?>
    <?php foreach ($ds_baiDang as $baiDang): ?>
        <div class="baiviet">
            <h2><?= esc($baiDang['title']) ?></h2>
            <p><?= esc($baiDang['content']) ?></p>
            <p><strong>Chuyên mục:</strong> <?= esc($baiDang['category']) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Không có bài viết nào.</p>
<?php endif; ?>