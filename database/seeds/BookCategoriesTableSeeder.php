<?php

use Illuminate\Database\Seeder;

class BookCategoriesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        factory(App\Models\BookCategory::class)->times($faker->numberBetween(1,15))->create();
    }
}
