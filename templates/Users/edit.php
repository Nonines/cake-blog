<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('View Blog'), ["_name" => "home"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Article'), ["_name" => "articles:admin:add"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Categories'), ["_name" => "categories:admin:index"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Tags'), ["_name" => "tags:admin:index"], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('Edit Account'), ["_name" => "admin:edit"], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="users form content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
        echo $this->Form->control('email');
        echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
