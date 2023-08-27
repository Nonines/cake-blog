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

<body class="d-flex flex-column min-vh-100 bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><?= $this->Html->link(__('Categories'), ['controller' => 'Categories', 'action' => 'list'], ["class" => "nav-link"]) ?></li>
                    <li class="nav-item"><a class="nav-link" href="">Tags</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <main role="main" class="px-3 d-flex justify-content-center">
            <?= $this->fetch('content') ?>
        </main>
        <?php $this->end(); ?>

        <?php $this->start('tb_body_end'); ?>
    </div>
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
