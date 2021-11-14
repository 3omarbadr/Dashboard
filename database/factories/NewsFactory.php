<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $i = 0;
        $i++;
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(15),
            'img' => "products/$i.png"
        ];
    }
}
