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
};
