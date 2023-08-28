<?php $this->extend('/layout/TwitterBootstrap/cover'); ?>

<div class="w-100">
    <div class="row">
        <div class="text-light">
            <div class="fw-bold"><?= h($comment->name) ?></div>
            <div class="mb-3"><?= h($comment->content) ?></div>

            <?= $this->Form->create($comment_entity, ['url' => [
                'controller' => 'Comments',
                'action' => 'add'
            ]]); ?>
            <fieldset>
                <legend><?= __('Reply') ?></legend>
                <?php
                echo $this->Form->hidden('article_id', ['default' => $article_id]);
                echo $this->Form->hidden('parent_id', ['default' => $comment->id]);
                echo $this->Form->control('name');
                echo $this->Form->control('content');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Reply')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
