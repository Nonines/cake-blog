<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 * @var \App\Model\Entity\Comment[]|\Cake\Collection\CollectionInterface $comments
 * @var \App\Model\Entity\Tag[]|\Cake\Collection\CollectionInterface $tags
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('List Articles'), ["_name" => "admin:home"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('View Blog'), ["_name" => "home"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Article'), ["_name" => "articles:admin:add"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Categories'), ["_name" => "categories:admin:index"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Tags'), ["_name" => "tags:admin:index"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Edit Account'), ["_name" => "admin:edit"], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="articles form content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Add Article') ?></legend>
        <?php
        echo $this->Form->control('category_id', ['options' => $categories, 'empty' => true]);
        echo $this->Form->control('title');
        echo $this->Form->control('slug');
        echo $this->Form->control('excerpt');
        echo $this->Form->control('image');
        echo $this->Form->control('caption');
        echo $this->Form->control('content');
        echo $this->Form->control('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
