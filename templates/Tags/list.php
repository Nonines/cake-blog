<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag[]|\Cake\Collection\CollectionInterface $tags
 */
$cell = $this->cell('TagsSearch');
?>

<?php $this->extend('/layout/TwitterBootstrap/cover'); ?>

<div class="col-lg-8">
    <div class="row">
        <div class="">
            <header class="mb-4 pt-5">
                <h1 class="fw-bolder mb-1 text-light">Tags</h1>
            </header>

            <div class="mb-5"><?= $cell->render() ?></div>

            <?php foreach ($tags as $tag) : ?>
                <div class="card mb-4 text-dark">
                    <div class="card-body">
                        <h2 class="card-title h4"><?= $this->Html->link(__(h($tag->title)), ['_name' => 'tags:show', "id" => $tag->id], ["class" => ""]) ?></h2>
                    </div>
                </div>
            <?php endforeach ?>

            <div class="paginator text-light">
                <ul class="pagination">
                    <?= $this->Paginator->first('«', ['label' => __('First')]) ?>
                    <?= $this->Paginator->prev('‹', ['label' => __('Previous')]) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('›', ['label' => __('Next')]) ?>
                    <?= $this->Paginator->last('»', ['label' => __('Last')]) ?>
                </ul>
                <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
            </div>
        </div>
    </div>
</div>
