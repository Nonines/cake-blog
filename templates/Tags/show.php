<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */
?>


<?php $this->extend('/layout/TwitterBootstrap/cover'); ?>

<div class="col-lg-8">
    <div class="row">
        <div class="">
            <header class="mb-4 pt-5">
                <!-- Post title-->
                <h1 class="fw-bolder mb-1 text-light"><?= h($tag->title) ?></h1>
            </header>

            <?php foreach ($tag->articles as $article) : ?>
                <div class="card mb-4 text-dark">
                    <a href=""><img class="card-img-top" src="" alt="..." /></a>
                    <div class="card-body">
                        <div class="small text-muted"><?= h($article->created) ?></div>
                        <h2 class="card-title h4"><?= h($article->title) ?></h2>
                        <p class="card-text"><?= h($article->excerpt) ?></p>
                        <!-- <a class="btn btn-primary" href="">Read more </a> -->
                        <?= $this->Html->link(__('Read more →'), ["controller" => "Articles", 'action' => 'view', $article->id], ["class" => "btn btn-primary"]) ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
