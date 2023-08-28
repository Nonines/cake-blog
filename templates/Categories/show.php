<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/cover'); ?>

<div class="col-lg-8">
    <div class="row">
        <div class="">
            <header class="mb-4 pt-5">
                <!-- Post title-->
                <h1 class="fw-bolder mb-1 text-light"><?= h($category->title) ?></h1>
            </header>

            <?php foreach ($category->articles as $article) : ?>
                <?= $this->element('article-card', [
                    'article' => $article
                ]); ?>
            <?php endforeach ?>


        </div>
    </div>
</div>
