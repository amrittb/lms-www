<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Factory::create();
        
        factory(App\Models\Book::class)->times($faker->numberBetween(10,20))->create();
    }
}
