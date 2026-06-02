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
        Article::factory()->count(5)
            ->longerContent(20)
            ->slugFromTitle()
            // ->has(ArticleComment::factory()->count(10), 'comments')
            ->hasComments(20)
            ->create();
    }
}
