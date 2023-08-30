<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Comments seed.
 */
class CommentsSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'ArticlesSeed'
        ];
    }

    public function run(): void
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'article_id' => rand(1, 10),
                'name' => $faker->name,
                'content' => $faker->sentence(10),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ];
        }

        $table = $this->table('comments');
        $table->insert($data)->save();
    }
}
