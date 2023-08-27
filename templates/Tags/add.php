<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('List Tags'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="tags form content">
    <?= $this->Form->create($tag) ?>
    <fieldset>
        <legend><?= __('Add Tag') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('articles._ids', ['options' => $articles]);
                ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
