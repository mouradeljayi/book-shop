<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->sentence()),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'description' => $this->faker->paragraph(),
            'stock' => $this->faker->numberBetween($min = 1, $max = 10),
            'price' => $this->faker->numberBetween($min = 100, $max = 900),
            'old_price' => $this->faker->numberBetween($min = 100, $max = 900),
            'image' => $this->faker->imageURL($width = 640, $height = 480),
        ];
    }
}
