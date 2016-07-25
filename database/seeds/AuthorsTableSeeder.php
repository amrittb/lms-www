<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        $books = App\Models\Book::all();

        $authors = factory(App\Models\Author::class)->times($faker->numberBetween(1,15))->create();

        foreach($books as $book) {
            $book->authors()->attach($faker->randomElements($authors->lists('id')->toArray(),$faker->numberBetween(1,$authors->count())));
        }
    }
}
