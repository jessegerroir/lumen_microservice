<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::factory()
            ->count(50)
            ->create();

        // DB::table('books')->insert([
        //     'title' => Str::random(10),
        //     'author' => Str::random(10),
        //     'page_count' => 100,
        // ]);
    }
}
