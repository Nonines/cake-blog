<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var \App\Model\Entity\Comment $comment
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/cover'); ?>

<div class="col-lg-8">
    <div class="row">
        <div class="text-light">
            <!-- Post header-->
            <header class="mb-4 pt-5">
                <!-- Post title-->
                <h1 class="fw-bolder mb-1"><?= h($article->title) ?></h1>
                <!-- Post meta content-->
                <div class="text-muted fst-italic mb-2">Posted on <?= h($article->created) ?> by <?= h($article->user->email) ?></div>
                <!-- Post categories-->
                <a class="badge bg-secondary text-decoration-none link-light" href=""><?= $article->category_id ? h($article->category->title) : "Article" ?></a>
            </header>
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-1">
                        <h2 class="fw-bolder mb-4 mt-5"><?= h($article->excerpt) ?></h2>
                        <p class="fs-5 mb-4"><?= h($article->content) ?></p>
                    </section>
                    <!-- Tags -->
                    <section class="mb-4">
                        Tags:
                        <?php foreach ($article->tags as $tag) : ?>
                            <span class="badge text-bg-secondary me-1"><a href="" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><?= h($tag->title) ?></a></span>
                        <?php endforeach ?>
                    </section>
                </article>

                <!-- comment section -->
                <section class="mb-5">
                    <div class="card bg-dark">
                        <div class="card-body">
                            <!-- Comment form-->
                            <?= $this->Form->create($comment, ['url' => [
                                'controller' => 'Comments',
                                'action' => 'add'
                            ]]); ?>
                            <fieldset>
                                <legend><?= __('Add comment') ?></legend>
                                <?php
                                echo $this->Form->hidden('article_id', ['default' => $article->id]);
                                echo $this->Form->control('name');
                                echo $this->Form->control('content');
                                ?>
                            </fieldset>
                            <?= $this->Form->button(__('Submit')) ?>
                            <?= $this->Form->end() ?>

                            <!-- comments -->
                            <h1 class="mt-3">Comments</h1>
                            <?= $this->element('comment', [
                                'comments' => $article->comments,
                            ]); ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
