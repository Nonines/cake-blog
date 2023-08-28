<div class="card mb-4 text-dark">
    <a href=""><img class="card-img-top" src="" alt="..." /></a>
    <div class="card-body">
        <div class="small text-muted"><?= h($article->created) ?></div>
        <h2 class="card-title h4"><?= h($article->title) ?></h2>
        <p class="card-text"><?= h($article->excerpt) ?></p>
        <!-- <a class="btn btn-primary" href="">Read more </a> -->
        <?= $this->Html->link(__('Read more →'), ['_name' => 'articles:view', "id" => $article->id], ["class" => "btn btn-primary"]) ?>
    </div>
</div>
