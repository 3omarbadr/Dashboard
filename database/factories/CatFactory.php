<?php

namespace Database\Factories;

use App\Models\Cat;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cat::class;

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
            'name' => json_encode([
                'en' =>  $this->faker->word(),
                'ar' => $this->faker->word(),
            ]),
            'img' => "cats/$i.png"
            
        ];
    }
}
