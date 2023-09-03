<div>
    <?= $this->Form->create(null, ['url' => [
        'controller' => 'Articles',
        'action' => 'tags'
    ]]) ?>
    <fieldset class="mb-1">
        <legend class="fs-5 text-light"><?= __('Find related articles') ?></legend>


        <?= $this->Form->select("tags", $tags, [
            "id" => "tags", "multiple" => true, "class" => "js-example-basic-multiple form-select text-dark"
        ]); ?>
    </fieldset>
    <?= $this->Form->button(__('Search')) ?>
    <?= $this->Form->end() ?>
</div>
