<div>
    <?= $this->Form->create(null, ['url' => [
        'controller' => 'Articles',
        'action' => 'tags'
    ]]) ?>
    <fieldset class="mb-1">
        <legend class="fs-5 text-light"><?= __('Find related articles') ?></legend>
        <select class="js-example-basic-multiple form-select text-dark" id="tags" name="tags[]" multiple="multiple">
            <?php foreach ($tags as $tag) : ?>
                <option value="<?= h($tag->title) ?>"><?= h($tag->title) ?></option>
            <?php endforeach ?>
        </select>
    </fieldset>
    <?= $this->Form->button(__('Search')) ?>
    <?= $this->Form->end() ?>
</div>
