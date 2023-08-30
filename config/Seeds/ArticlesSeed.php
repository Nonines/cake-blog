<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Articles seed.
 */
class ArticlesSeed extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'UsersSeed',
            'CategoriesSeed'
        ];
    }

    public function run(): void
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 15; $i++) {
            $data[] = [
                'user_id' => rand(1, 5),
                'category_id' => rand(1, 5),
                'title' => $faker->sentence(),
                'slug' => $faker->sentence(),
                'excerpt' => $faker->sentence(10),
                'content' => $faker->text(500),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ];
        }

        $table = $this->table('articles');
        $table->insert($data)->save();
    }
}
