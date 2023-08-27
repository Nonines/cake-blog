<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;

return static function (RouteBuilder $routes) {

    $routes->scope('/', function (RouteBuilder $builder) {
        $builder->connect('/', 'Articles::index');
    });

    $routes->scope('/admin', ['_namePrefix' => 'admin:'], function (RouteBuilder $builder) {
        $builder->connect('/', 'Users::view');

        $builder->connect('/add', 'Users::add');

        $builder->connect('/edit', 'Users::edit');

        $builder->connect('/login', 'Users::login');

        $builder->connect('/logout', 'Users::logout');
    });

    $routes->scope('/articles', ['_namePrefix' => 'articles:'], function (RouteBuilder $builder) {
        $builder->connect('/view/*', 'Articles::view');

        $builder->scope('/admin', ['_namePrefix' => 'admin:'], function (RouteBuilder $builder) {
            $builder->connect('/add', 'Articles::add');
            $builder->connect('/edit/*', 'Articles::edit');
            $builder->connect('/delete/*', 'Articles::delete');
        });
    });

    $routes->scope('/categories', ['_namePrefix' => 'categories:'], function (RouteBuilder $builder) {
        $builder->connect("/", "Categories::list");
        $builder->connect("/view/{id}", "Categories::show")->setPatterns(['id' => '[0-9]+']);

        $builder->scope('/admin', ['_namePrefix' => 'admin:'], function (RouteBuilder $builder) {
            $builder->connect('/', 'Categories::index');
            $builder->connect('/add', 'Categories::add');
            $builder->connect('/view/*', 'Categories::view');
            $builder->connect('/edit/*', 'Categories::edit');
            $builder->connect('/delete/*', 'Categories::delete');
        });
    });

    $routes->scope('/tags', ['_namePrefix' => 'tags:'], function (RouteBuilder $builder) {
        $builder->connect('/', 'Tags::index');

        $builder->connect('/add', 'Tags::add');

        $builder->connect('/view/*', 'Tags::view');

        $builder->connect('/edit/*', 'Tags::edit');

        $builder->connect('/delete/*', 'Tags::delete');
    });
};
