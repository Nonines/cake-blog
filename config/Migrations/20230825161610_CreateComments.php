<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateComments extends AbstractMigration
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
        $table = $this->table('comments');

        $table->addColumn('article_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ])->addForeignKey('article_id', 'articles', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION']);

        $table->addColumn('parent_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ])->addForeignKey('parent_id', 'comments', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION']);

        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
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
