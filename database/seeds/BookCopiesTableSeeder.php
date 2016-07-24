<?php

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookCopiesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();
        $books = Book::all();

        foreach($books as $book) {
            $numCopies = $faker->randomDigitNotNull;
            for($i = 1; $i <= $numCopies; $i++){
                $book->copies()->create([
                ]);
            }
        }
    }
}
