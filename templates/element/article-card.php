<div class="card mb-4 text-dark">
    <?php
    $image = $this->Html->image($article->image ? 'articles/' . h($article->image) : 'article.jpg', array('width' => '100%', 'alt' => 'image'));

    echo $this->Html->link($image, ['_name' => 'articles:view', "id" => $article->id], ["class" => "", "escape" => false]);
    ?>

    <div class="card-body">
        <div class="small text-muted"><?= h($article->created) ?></div>
        <h2 class="card-title h4"><?= h($article->title) ?></h2>
        <p class="card-text"><?= h($article->excerpt) ?></p>
        <!-- <a class="btn btn-primary" href="">Read more </a> -->
        <?= $this->Html->link(__('Read more →'), ['_name' => 'articles:view', "id" => $article->id], ["class" => "btn btn-primary"]) ?>
    </div>
</div>
