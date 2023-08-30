<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * ArticlesTags seed.
 */
class ArticlesTagsSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'ArticlesSeed',
            'TagsSeed'
        ];
    }
    public function run(): void
    {
        $faker = Faker\Factory::create();
        $data = [
            [
                'article_id'    => 1,
                'tag_id' => 1,
            ], [
                'article_id'    => 1,
                'tag_id' => 2,
            ],
            [
                'article_id'    => 1,
                'tag_id' => 3,
            ], [
                'article_id'    => 2,
                'tag_id' => 1,
            ], [
                'article_id'    => 2,
                'tag_id' => 2,
            ],
            [
                'article_id'    => 3,
                'tag_id' => 3,
            ]
        ];
        $table = $this->table('articles_tags');
        $table->insert($data)->save();
    }
}
