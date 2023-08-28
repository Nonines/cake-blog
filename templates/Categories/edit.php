<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Form->postLink(__('Delete'), ["_name" => "categories:admin:delete", "id" => $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Articles'), ["_name" => "admin:home"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Article'), ["_name" => "articles:admin:add"], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="categories form content">
    <?= $this->Form->create($category) ?>
    <fieldset>
        <legend><?= __('Edit Category') ?></legend>
        <?php
        echo $this->Form->control('title');
        echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
