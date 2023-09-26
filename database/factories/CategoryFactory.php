<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_tm' => $this->faker->word(),
            'name_ru' => $this->faker->word(),
            'name_en' => $this->faker->word(),
            'svg' => 'svg',
            'category_id' => null,
        ];
    }
}
