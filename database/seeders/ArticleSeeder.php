<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::factory()->count(1)
            ->longerContent(20)
            ->slugFromTitle()
            ->create()
            ->each(function ($article) {
                ArticleComment::factory()
                    ->count(rand(10, 20))
                    ->create(['article_id' => $article->id]);
            });
    }
}
