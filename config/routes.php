<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;

return static function (RouteBuilder $routes) {

    $routes->scope('/', function (RouteBuilder $builder) {
        //
    });

    $routes->scope('/admin', ['_namePrefix' => 'admin:'], function (RouteBuilder $builder) {
        $builder->connect('/', 'Users::index');

        $builder->connect('/add', 'Users::add');

        $builder->connect('/view/{id}', 'Users::view')
            ->setPatterns(['id' => '[0-9]+']);

        $builder->connect('/edit/{id}', 'Users::edit')
            ->setPatterns(['id' => '[0-9]+']);

        $builder->connect('/delete/{id}', 'Users::delete')
            ->setPatterns(['id' => '[0-9]+']);

        $builder->connect('/login', 'Users::login');

        $builder->connect('/logout', 'Users::logout');
    });

    $routes->scope('/articles', ['_namePrefix' => 'articles:'], function (RouteBuilder $builder) {
        $builder->connect('/', 'Articles::index');

        $builder->connect('/add', 'Articles::add');

        $builder->connect('/view/*', 'Articles::view');

        $builder->connect('/edit/*', 'Articles::edit');

        $builder->connect('/delete/*', 'Articles::delete');
    });

    $routes->scope('/categories', ['_namePrefix' => 'categories:'], function (RouteBuilder $builder) {
        $builder->connect('/', 'Categories::index');

        $builder->connect('/add', 'Categories::add');

        $builder->connect('/view/*', 'Categories::view');

        $builder->connect('/edit/*', 'Categories::edit');

        $builder->connect('/delete/*', 'Categories::delete');
    });

    $routes->scope('/tags', ['_namePrefix' => 'tags:'], function (RouteBuilder $builder) {
        $builder->connect('/', 'Tags::index');

        $builder->connect('/add', 'Tags::add');

        $builder->connect('/view/*', 'Tags::view');

        $builder->connect('/edit/*', 'Tags::edit');

        $builder->connect('/delete/*', 'Tags::delete');
    });
};
