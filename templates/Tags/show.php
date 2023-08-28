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
                <h1 class="fw-bolder mb-1 text-light">Articles tagged with <?= h($tag->title) ?></h1>
            </header>

            <?php foreach ($tag->articles as $article) : ?>
                <?= $this->element('article-card', [
                    'article' => $article
                ]); ?>
            <?php endforeach ?>
        </div>
    </div>
</div>
