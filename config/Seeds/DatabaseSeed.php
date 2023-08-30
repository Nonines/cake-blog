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
     * bin/cake migrations seed --seed DatabaseSeed
     */
}
