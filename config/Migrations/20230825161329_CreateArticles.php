<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateArticles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('articles');

        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION']);

        $table->addColumn('category_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ])->addForeignKey('category_id', 'categories', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION']);

        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('excerpt', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('image', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);

        $table->addColumn('caption', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);

        $table->addColumn('content', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->create();
    }
}
