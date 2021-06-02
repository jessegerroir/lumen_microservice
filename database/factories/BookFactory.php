<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
    	return [
            'title'      => $this->faker->words(4),
            'author'     => $this->faker->name(),
            'page_count' => $this->faker->randomNumber(3, false)
    	];
    }
}
