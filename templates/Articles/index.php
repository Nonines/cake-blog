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
                <div class="card mb-4 text-dark">
                    <a href=""><img class="card-img-top" src="" alt="..." /></a>
                    <div class="card-body">
                        <div class="small text-muted"><?= h($article->created) ?></div>
                        <h2 class="card-title h4"><?= h($article->title) ?></h2>
                        <p class="card-text"><?= h($article->excerpt) ?></p>
                        <!-- <a class="btn btn-primary" href="">Read more </a> -->
                        <?= $this->Html->link(__('Read more →'), ['action' => 'view', $article->id], ["class" => "btn btn-primary"]) ?>
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
