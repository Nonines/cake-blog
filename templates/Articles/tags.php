<?php
$this->extend('/layout/TwitterBootstrap/cover');
$cell = $this->cell('TagsSearch');
?>

<div class="col-lg-8">
    <div class="row">
        <div class="">
            <header class="mb-4 pt-5">
                <!-- title-->
                <h1 class="fw-bolder mb-1 text-light">Articles tagged with
                    <?= $this->Text->toList(h($tags), 'or') ?></h1>
            </header>

            <?php foreach ($articles as $article) : ?>
                <?= $this->element('article-card', [
                    'article' => $article
                ]); ?>
            <?php endforeach ?>
        </div>
        <div class="mb-5"><?= $cell->render() ?></div>
    </div>
</div>
