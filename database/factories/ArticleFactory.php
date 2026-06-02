<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'content' => fake()->paragraph(),
            'slug' => fake()->slug(),
            'article_category_id' => ArticleCategory::inRandomOrder()->first()->id,
        ];
    }

    public function longerContent($count = 10): static
    {
        return $this->state(fn(array $attributes) => [
            'content' => fake()->paragraph($count),
        ]);
    }
    public function slugFromTitle(): static
    {
        return $this->state(fn(array $attributes) => [
            'slug' => Str::slug($attributes['title']),
        ]);
    }
}
