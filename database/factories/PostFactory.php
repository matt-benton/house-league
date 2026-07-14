<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var list<string> $paragraphs */
        $paragraphs = $this->faker->paragraphs(3);

        return [
            'title' => $this->faker->sentence,
            'text' => collect($paragraphs)
                ->map(fn ($paragraph) => "<p>{$paragraph}</p>")
                ->join(''),
        ];
    }
}
