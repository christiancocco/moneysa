<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category' => $this->faker->text(100),
            'body' => $this->faker->paragraphs(15, true),
            'title' => $this->faker->sentence(15),
            'summary' => $this->faker->sentences(3, true),
            'published_date' => $this->faker->date(),
            'user_id' => 1,
        ];
    }

    /**
     * Indicates the post is published.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => true,
                'published_date' => now(),
            ];
        });
    }
}
