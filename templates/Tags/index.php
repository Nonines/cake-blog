<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag[]|\Cake\Collection\CollectionInterface $tags
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('New Tag'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('title') ?></th>
        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($tags as $tag) : ?>
        <tr>
            <td><?= $this->Number->format($tag->id) ?></td>
            <td><?= h($tag->title) ?></td>
            <td><?= h($tag->created) ?></td>
            <td><?= h($tag->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $tag->id], ['title' => __('View'), 'class' => 'btn btn-secondary']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tag->id], ['title' => __('Edit'), 'class' => 'btn btn-secondary']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id), 'title' => __('Delete'), 'class' => 'btn btn-danger']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('«', ['label' => __('First')]) ?>
        <?= $this->Paginator->prev('‹', ['label' => __('Previous')]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('›', ['label' => __('Next')]) ?>
        <?= $this->Paginator->last('»', ['label' => __('Last')]) ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div>
