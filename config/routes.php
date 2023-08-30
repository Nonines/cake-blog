<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;

return static function (RouteBuilder $routes) {

    $routes->scope('/', function (RouteBuilder $builder) {
        $builder->connect('/', 'Articles::index', ['_name' => 'home']);
    });

    $routes->scope('/admin', ['_namePrefix' => 'admin:'], function (RouteBuilder $builder) {
        $builder->connect('/', 'Users::view', ['_name' => 'home']);
        $builder->connect('/add', 'Users::add');
        $builder->connect('/edit', 'Users::edit', ['_name' => 'edit']);
        $builder->connect('/login', 'Users::login', ['_name' => 'login']);
        $builder->connect('/logout', 'Users::logout', ['_name' => 'logout']);
    });

    $routes->scope('/articles', ['_namePrefix' => 'articles:'], function (RouteBuilder $builder) {
        $builder->connect('/view/{id}', 'Articles::view', ['_name' => 'view'])->setPatterns(['id' => '[0-9]+']);

        $builder->scope('/admin', ['_namePrefix' => 'admin:'], function (RouteBuilder $builder) {
            $builder->connect('/add', 'Articles::add', ['_name' => 'add']);
            $builder->connect('/edit/{id}', 'Articles::edit', ['_name' => 'edit'])->setPatterns(['id' => '[0-9]+']);
            $builder->connect('/delete/{id}', 'Articles::delete', ['_name' => 'delete'])->setPatterns(['id' => '[0-9]+']);
        });
    });

    $routes->scope('/comments', ['_namePrefix' => 'comments:'], function (RouteBuilder $builder) {
        $builder->connect('/add', 'Comments::add');
        $builder->connect('/reply/{comment_id}/{article_id}', 'Comments::reply')->setPatterns(['comment_id' => '[0-9]+', 'article_id' => '[0-9]+']);
    });

    $routes->scope('/categories', ['_namePrefix' => 'categories:'], function (RouteBuilder $builder) {
        $builder->connect("/", "Categories::list", ['_name' => 'list']);
        $builder->connect("/view/{id}", "Categories::show", ['_name' => 'show'])->setPatterns(['id' => '[0-9]+']);

        $builder->scope('/admin', ['_namePrefix' => 'admin:'], function (RouteBuilder $builder) {
            $builder->connect('/', 'Categories::index', ['_name' => 'index']);
            $builder->connect('/add', 'Categories::add');
            $builder->connect('/view/{id}', 'Categories::view', ['_name' => 'view'])->setPatterns(['id' => '[0-9]+']);
            $builder->connect('/edit/{id}', 'Categories::edit', ['_name' => 'edit'])->setPatterns(['id' => '[0-9]+']);
            $builder->connect('/delete/{id}', 'Categories::delete', ['_name' => 'delete'])->setPatterns(['id' => '[0-9]+']);
        });
    });

    $routes->scope('/tags', ['_namePrefix' => 'tags:'], function (RouteBuilder $builder) {
        $builder->connect("/", "Tags::list", ['_name' => 'list']);
        $builder->connect("/view/{id}", "Tags::show", ['_name' => 'show'])->setPatterns(['id' => '[0-9]+']);

        $builder->scope('/admin', ['_namePrefix' => 'admin:'], function (RouteBuilder $builder) {
            $builder->connect('/', 'Tags::index', ['_name' => 'index']);
            $builder->connect('/add', 'Tags::add', ["_name" => "add"]);
            $builder->connect('/view/{id}', 'Tags::view', ['_name' => 'view'])->setPatterns(['id' => '[0-9]+']);
            $builder->connect('/edit/{id}', 'Tags::edit', ['_name' => 'edit'])->setPatterns(['id' => '[0-9]+']);
            $builder->connect('/delete/{id}', 'Tags::delete', ['_name' => 'delete'])->setPatterns(['id' => '[0-9]+']);
        });
    });
};
