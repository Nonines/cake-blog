<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/signin'); ?>

<div class="users form content">
    <?= $this->Html->image('BootstrapUI.baked-with-cakephp.svg', ['class' => 'mb-4', 'width' => '250']) ?>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Register') ?></legend>
        <?php
        echo $this->Form->control('email');
        echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'w-100 btn btn-lg btn-primary']) ?>
    <p class="mt-5 mb-3 text-muted">© <?= date('Y') ?></p>
    <?= $this->Form->end() ?>
</div>
