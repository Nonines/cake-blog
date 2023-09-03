<?php

/**
 * @var \Cake\View\View $this
 */

use Cake\Core\Configure;

$this->start('html');
printf('<html lang="%s" class="h-100">', Configure::read('App.language'));
$this->end();

$this->Html->css('BootstrapUI.cover', ['block' => true]);

$this->prepend(
    'tb_body_attrs',
    'class="d-flex h-100 text-center text-white bg-dark ' .
        implode(' ', [h($this->request->getParam('controller')), h($this->request->getParam('action'))]) .
        '" '
);

$this->start('tb_body_start'); ?>

<?= $this->Html->css("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"); ?>
<?= $this->Html->script(["https://code.jquery.com/jquery-3.7.0.js", "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"]); ?>

<body class="d-flex flex-column min-vh-100 bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><?= $this->Html->link(__('Categories'), ['_name' => 'categories:list'], ["class" => "nav-link"]) ?></li>
                    <li class="nav-item"><?= $this->Html->link(__('Tags'), ['_name' => 'tags:list'], ["class" => "nav-link"]) ?></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex w-100 h-100 p-3 mx-auto flex-column">
        <main role="main" class="px-3 d-flex justify-content-center">
            <?= $this->fetch('content') ?>
        </main>
        <?php $this->end(); ?>

        <?php $this->start('tb_body_end'); ?>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

</body>
<?php $this->end(); ?>

<?php
$this->start('tb_footer');
printf(
    '<footer class="mt-auto text-white-50"><div class="inner"><p>&copy;%s %s</p></div></footer>',
    date('Y'),
    Configure::read('App.title')
);
$this->end();
