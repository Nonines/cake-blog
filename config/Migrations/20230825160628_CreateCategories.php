<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCategories extends AbstractMigration
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
        $table = $this->table('categories');
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 24,
            'null' => false,
        ]);

        $table->addColumn('description', 'string', [
            'default' => null,
            'limit' => 100,
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

        $table->addIndex([
            'title',

        ], [
            'name' => 'UNIQUE_TITLE',
            'unique' => true,
        ]);

        $table->create();
    }
}
