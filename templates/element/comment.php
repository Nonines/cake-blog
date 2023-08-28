<?php foreach ($comments as $comment) : ?>

    <div class="d-flex my-4">
        <div class="ms-3">
            <div class="fw-bold"><?= h($comment->name) ?></div>
            <?= h($comment->content) ?>
        </div>
        <div class="flex-shrink-0">
            <?= $this->Html->link(__('Reply'), ['controller' => "Comments", 'action' => 'reply', "comment_id" => $comment->id, "article_id" => $article->id]) ?>
        </div>
    </div>

    <?php if ($comment->child_comments) : ?>
        <div class="ms-5">
            <?= $this->element('comment', [
                'comments' => $comment->child_comments
            ]); ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
