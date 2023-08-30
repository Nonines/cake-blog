<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Database seed.
 */
class DatabaseSeed extends AbstractSeed
{

    public function run(): void
    {
        $this->call('UsersSeed');
        $this->call('CategoriesSeed');
        $this->call('TagsSeed');
        $this->call('ArticlesSeed');
        $this->call('CommentsSeed');
        $this->call('ArticlesTagsSeed');
    }

    /**
     * The Faker plugin is no longer maintained, and there are 3 errors in
     * /vendor/fzaninotto/faker/src/Faker/Provider/Lorem.php where array
     * join args are incorrectly ordered. As in:

     * join($text, '');
     * instead of:
     * join('', $text);
     *
     * So gotta fix those lines (ln 95, 134, 208) to make the seeders work
     * properly.
     */
}
