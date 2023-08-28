<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/cover'); ?>

<div class="col-lg-8">
    <div class="row">
        <div class="">
            <?php foreach ($articles as $article) : ?>
                <?= $this->element('article-card', [
                    'article' => $article
                ]); ?>
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
