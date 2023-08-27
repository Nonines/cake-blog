<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Tag'), ['action' => 'edit', $tag->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink(__('Delete Tag'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Tags'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('New Tag'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="tags view large-9 medium-8 columns content">
    <h3><?= h($tag->title) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($tag->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($tag->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($tag->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($tag->modified) ?></td>
            </tr>
        </table>
    </div>
    <div class="related">
        <h4><?= __('Related Articles') ?></h4>
        <?php if (!empty($tag->articles)) : ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th scope="col"><?= __('Title') ?></th>
                        <th scope="col"><?= __('User') ?></th>
                        <th scope="col"><?= __('Slug') ?></th>
                        <th scope="col"><?= __('Excerpt') ?></th>
                        <th scope="col"><?= __('Created') ?></th>
                        <th scope="col"><?= __('Modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($tag->articles as $articles) : ?>
                        <tr>
                            <td><?= h($articles->title) ?></td>
                            <td><?= h($articles->user->email) ?></td>
                            <td><?= h($articles->slug) ?></td>
                            <td><?= h($articles->excerpt) ?></td>
                            <td><?= h($articles->created) ?></td>
                            <td><?= h($articles->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Articles', 'action' => 'view', $articles->id], ['class' => 'btn btn-secondary']) ?>

                                <?php if ($this->Identity->is($articles->user_id)) : ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $articles->id], ['class' => 'btn btn-secondary']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles', 'action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id), 'class' => 'btn btn-danger']) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
